<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'news_category';

    protected $fillable = [
        'category_id', 'news_id', 'is_feature', 'active'
    ];

    const CATEGORY_ID = 'category_id';
    const NEWS_ID = 'news_id';
    const IS_FEATURE = 'is_feature';
    const ACTIVE = 'active';

    public $with = ['TvCategory', 'news'];

    public function news() {
        return $this->belongsTo(News::class, self::NEWS_ID, 'news_id');
    }

    public function TvCategory() {
        return $this->belongsTo(TvCategory::class, self::CATEGORY_ID);
    }   
}
