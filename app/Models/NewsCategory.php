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

    public $with = ['TvCategory', 'news'];

    public function news()
    {
        return $this->belongsTo(News::class, self::NEWS_ID, 'news_id');
    }

    public function TvCategory()
    {
        return $this->belongsTo(TvCategory::class, self::CATEGORY_ID);
    }

    public static function getPublishedNewsCount()
    {
        return self::whereHas('news', function ($query) {
            $query->whereIn(News::NEWS_TYPE_ID, [1, 7])
                ->where(News::PUBLISH_STATUS, 1)
                ->where(News::ACTIVE, 1);
        })->count();
    }

    public static function getAINewsCount()
    {
        return self::whereHas('news', function ($query) {
            $query->whereIn(News::NEWS_TYPE_ID, [1, 7])
                ->where(News::PUBLISH_STATUS, 1)
                ->where(News::ACTIVE, 1)
                ->whereNotNull(News::REF_NEWS_ID);
        })->count();
    }

    public static function getAINewsPendingCount()
    {
        return self::whereHas('news', function ($query) {
            $query->whereIn(News::NEWS_TYPE_ID, [1, 7])
                ->where(News::PUBLISH_STATUS, 1)
                ->where(News::ACTIVE, 1)
                ->whereNull(News::REF_NEWS_ID);
        })->count();
    }

    
    public static function getPopular()
    {
        return cache()->remember('popular', now()->addMinutes(10), function () {
            return NewsCategory::whereHas('news', function ($query) {
                $query->whereIn(News::NEWS_TYPE_ID, [1, 7])
                    ->where(News::PUBLISH_STATUS, 1)
                    ->where(News::ACTIVE, 1);
            })->withCount('news')->orderByDesc('news_count')->limit(10)->get();
        });
    }

    
    public static function categoryCountView()
    {
        return cache()->remember('categoryCountView', now()->addMinutes(10), function () {
            return TvCategory::join('news_category as c', 'category.category_id', '=', 'c.category_id')
                ->join('news as b', function ($join) {
                    $join->on('c.news_id', '=', 'b.news_id')
                        ->whereIn('b.news_type_id', [1, 7])
                        ->where('b.publish_status', 1)
                        ->where('b.active', 1);
                })
                ->select(
                    'category.category_id',
                    'category.category_name',
                    DB::raw('COALESCE(SUM(b.news_count), 0) AS total_news_count')
                )
                ->groupBy('category.category_id', 'category.category_name')
                ->orderByDesc('total_news_count')
                ->limit(10)
                ->get();
        });
    }

    public static function categoryCountNews()
    {
        return cache()->remember('categoryCountNews_' . request('page', 1), now()->addMinutes(10), function () {
            return TvCategory::join('news_category as c', 'category.category_id', '=', 'c.category_id')
                ->join('news as b', function ($join) {
                    $join->on('c.news_id', '=', 'b.news_id')
                        ->whereIn('b.news_type_id', [1, 7])
                        ->where('b.publish_status', 1)
                        ->where('b.active', 1);
                })
                ->select(
                    'category.category_id',
                    'category.category_name',
                    DB::raw('COUNT(b.news_id) AS total_news_count')
                )
                ->groupBy('category.category_id', 'category.category_name')
                ->orderByDesc('total_news_count')
                ->paginate(5);
        });
    }
}
