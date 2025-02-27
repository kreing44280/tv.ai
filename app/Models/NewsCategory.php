<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NewsCategory extends Model
{
    protected $connection = 'mysql2';
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
        return $this->belongsTo(News::class, self::NEWS_ID, 'news_id')
            ->select('news_title', 'news_id', 'news_pic', 'news_date', 'news_type_id', 'program_id', 'video_id');
    }

    public function TvCategory()
    {
        return $this->belongsTo(TvCategory::class, self::CATEGORY_ID)
            ->select('category_name', 'category_id');
    }
    public static function categoryCountView()
    {
        return cache()->remember('categoryCountView', now()->addMinutes(10), function () {
            return TvCategory::selectRaw('category.category_id, category.category_name, COALESCE(SUM(b.news_count), 0) AS total_news_count')
                ->join('news_category as c', 'category.category_id', '=', 'c.category_id')
                ->join('news as b', function ($join) {
                    $join->on('c.news_id', '=', 'b.news_id')
                        ->whereIn('b.news_type_id', [1, 7])
                        ->where('b.publish_status', 1)
                        ->where('b.active', 1);
                })
                ->groupBy('category.category_id', 'category.category_name')
                ->orderByDesc('total_news_count')
                ->limit(10)
                ->get();
        });
    }

    public static function categoryCountNews()
    {
        return cache()->remember('categoryCountNews_' . request('page', 1), now()->addMinutes(10), function () {
            return TvCategory::selectRaw('category.category_id, category.category_name, COUNT(b.news_id) AS total_news_count')
                ->join('news_category as c', 'category.category_id', '=', 'c.category_id')
                ->join('news as b', function ($join) {
                    $join->on('c.news_id', '=', 'b.news_id')
                        ->whereIn('b.news_type_id', [1, 7])
                        ->where('b.publish_status', 1)
                        ->where('b.active', 1);
                })
                ->groupBy('category.category_id', 'category.category_name')
                ->orderByDesc('total_news_count')
                ->paginate(5);
        });
    }
}
