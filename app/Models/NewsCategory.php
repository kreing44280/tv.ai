<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    protected $connection;

    public function __construct()
    {
        $this->connection = env('APP_ENV') === 'local' ? 'mysql2' : 'mysql';
    }
    protected $table = 'news_category';

    protected $fillable = [
        'category_id',
        'news_id',
        'is_feature',
        'active'
    ];

    const CATEGORY_ID = 'category_id';
    const NEWS_ID = 'news_id';
    const IS_FEATURE = 'is_feature';
    const ACTIVE = 'active';

    public function news()
    {
        return $this->belongsTo(News::class, self::NEWS_ID, 'news_id');
    }

    public function TvCategory()
    {
        return $this->belongsTo(TvCategory::class, self::CATEGORY_ID)
            ->select('category_name', 'category_id');
    }
    public static function categoryCountView()
    {
        return TvCategory::selectRaw('category.category_id, category.category_name, COALESCE(SUM(b.news_count), 0) AS total_news_count')
            ->join('news_category as c', 'category.category_id', '=', 'c.category_id')
            ->join('news as b', function ($join) {
                $join->on('c.news_id', '=', 'b.news_id')
                    ->whereIn('b.news_type_id', [1, 7])
                    ->where('b.publish_status', 1)
                    ->where('b.is_video_exist', 1)
                    ->where('b.active', 1);                    
            })
            ->groupBy('category.category_id', 'category.category_name')
            ->orderByDesc('total_news_count')
            ->limit(10)
            ->having('total_news_count', '>', 0)
            ->get();
    }

    public static function categoryCountNews()
    {
        return TvCategory::selectRaw('category.category_id, category.category_name, COUNT(b.news_id) AS total_news_count')
            ->join('news_category as c', 'category.category_id', '=', 'c.category_id')
            ->join('news as b', function ($join) {
                $join->on('c.news_id', '=', 'b.news_id')
                    ->whereIn('b.news_type_id', [1, 7])
                    ->where('b.publish_status', 1) 
                    ->where('b.is_video_exist', 1)            
                    ->where('b.active', 1);
            })
            ->groupBy('category.category_id', 'category.category_name')
            ->orderByDesc('total_news_count')                        
            ->limit(10)
            ->having('total_news_count', '>', 0)
            ->get();
    }
}
