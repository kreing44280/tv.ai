<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\TvCategory;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $newsCount = NewsCategory::whereHas('news', function ($query) {
            $query->whereIn(News::NEWS_TYPE_ID, [1, 7])
                ->where(News::PUBLISH_STATUS, 1)
                ->where(News::ACTIVE, 1);
        })->count();

        $successCount = 0;
        $pendingCount = 0;
        $userCount = User::count();
        $aiNewsCount = NewsCategory::whereHas('news', function ($query) {
            $query->whereIn(News::NEWS_TYPE_ID, [1, 7])
                ->where(News::PUBLISH_STATUS, 1)
                ->where(News::ACTIVE, 1)
                ->whereNotNull(News::REF_NEWS_ID);
        })->count();

        $aiNewsPendingCount = NewsCategory::whereHas('news', function ($query) {
            $query->whereIn(News::NEWS_TYPE_ID, [1, 7])
                ->where(News::PUBLISH_STATUS, 1)
                ->where(News::ACTIVE, 1)
                ->whereNull(News::REF_NEWS_ID);
        })->count();

        $populars = $this->popular();
        $categoryCountViews = $this->categoryCountView();

        $categoryNames = $categoryCountViews->pluck('category_name')->toArray();
        $categoryViews = $categoryCountViews->pluck('total_news_count')->toArray();

        $populars->each(fn($item) => $this->setPicture($item));

        return view('pages.dashboard', compact(
            'newsCount',
            'successCount',
            'pendingCount',
            'userCount',
            'populars',
            'categoryNames',
            'categoryViews',
            'aiNewsCount',
            'aiNewsPendingCount'
        ));
    }

    private function categoryCountView()
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

    public function popular()
    {
        return cache()->remember('popular', now()->addMinutes(10), function () {
            return NewsCategory::whereHas('news', function ($query) {
                $query->whereIn(News::NEWS_TYPE_ID, [1, 7])
                    ->where(News::PUBLISH_STATUS, 1)
                    ->where(News::ACTIVE, 1);
            })->withCount('news')->orderByDesc('news_count')->limit(10)->get();
        });
    }

    private function setPicture(NewsCategory $item)
    {
        $image = $item->news->news_pic;
        $imagePath = 'https://backend.teroasia.com/uploads/pic_news/mid_' . $image;

        $item->news->news_pic = (!empty($image) && @get_headers($imagePath)[0] !== 'HTTP/1.1 404 Not Found')
            ? asset($imagePath)
            : asset('https://cdn4.vectorstock.com/i/1000x1000/55/63/error-404-file-not-found-web-icon-vector-21745563.jpg');
    }
}
