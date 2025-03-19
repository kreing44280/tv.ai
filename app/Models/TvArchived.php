<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TvCategory;

class TvArchived extends Model
{
    
    protected $table = 'archived_news';

    protected $fillable = [
        'news_id',
        'cate_id',
        'title',
        'intro',
        'description',
        'picture',
        'ondate',
        'added',
        'active',
        'homepage',
        'feature',
        'sort_order',
        'view',
        'tags',
    ];

    const NEWS_ID = 'news_id';
    const CATE_ID = 'cate_id';
    const TITLE = 'title';
    const INTRO = 'intro';
    const DESCRIPTION = 'description';
    const PICTURE = 'picture';
    const ONDATE = 'ondate';
    const ADDED = 'added';
    const ACTIVE = 'active';
    const HOMEPAGE = 'homepage';
    const FEATURE = 'feature';
    const SORT_ORDER = 'sort_order';
    const VIEW = 'view';
    const TAGS = 'tags';

    public $casts = [
        'news_id' => 'integer',
        'cate_id' => 'integer',
        'title' => 'string',
        'intro' => 'string',
        'description' => 'string',
        'picture' => 'string',
        'ondate' => 'date',
        'added' => 'datetime',
        'active' => 'boolean',
        'sort_order' => 'integer',
        'view' => 'integer',
        'tags' => 'string',
    ];

    protected $with = [
        'category',
    ];
    public function category()
    {
        return $this->belongsTo(TvCategory::class, self::CATE_ID);
    }
}
