<?php

namespace App\Console;

use App\Models\News;
use App\Models\NewsCategory;
use App\Models\TeroNews;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $this->dashboard();
            $this->sumNewsContent();
            $this->newsCount();
            $this->videoDuration();
        })->everyMinute();
    }

    public function dashboard()
    {
        cache()->remember('dashboardData', now()->addMinutes(20), function () {
            $array = $this->getPublishedNewsCount();
            return [
                'categoryCountViews' => NewsCategory::categoryCountView(),
                'newsCount' => $array['total'],
                'archivedNewsCount' => $array['archived_news'],
                'teroNewsCount' => $array['tero_news'],
                'aiNewsCount' => $this->getAINewsCount(),
                'pendingCount' => $this->getAINewsPendingCount(),
                'categoryNewsCount' => NewsCategory::categoryCountNews()
            ];
        });
    }

    public function getPublishedNewsCount()
    {
        $archived_news = News::join('news_category', 'news.news_id', '=', 'news_category.news_id')
            ->whereIn(News::NEWS_TYPE_ID, [1, 7])
            ->where('news.publish_status', 1)
            ->where('news.active', 1)
            ->where('news.is_video_exist', 1)
            ->count();

        $tero_news = TeroNews::whereIn(TeroNews::NEWS_TYPE_ID, [1, 7])->where(TeroNews::PUBLISH_STATUS, 1)->where(TeroNews::ACTIVE, 1)->count();

        return array('archived_news' => $archived_news, 'tero_news' =>  $tero_news, 'total' => $archived_news + $tero_news);
    }

    public function getAINewsCount()
    {
        return News::join('news_category', 'news.news_id', '=', 'news_category.news_id')
            ->whereIn('news.news_type_id', [1, 7])
            ->where('news.publish_status', 1)
            ->where('news.active', 1)
            ->where('news.is_video_exist', 1)
            ->whereNotNull('news.ref_news_id')
            ->count();
    }

    public function getAINewsPendingCount()
    {
        return News::join('news_category', 'news.news_id', '=', 'news_category.news_id')
            ->whereIn('news.news_type_id', [1, 7])
            ->where('news.publish_status', 1)
            ->where('news.active', 1)
            ->where('news.is_video_exist', 1)
            ->whereNull('news.ref_news_id')
            ->count();
    }

    public function sumNewsContent()
    {
        cache()->remember('sumNewsContent', now()->addMinutes(20), function () {
            return News::whereIn(News::NEWS_TYPE_ID, [1, 7])->where('publish_status', 1)->where('active', 1)->where('news.is_video_exist', 1)->sum('news_content_count');
        });
    }

    public function newsCount()
    {
        cache()->remember('newsCount', now()->addMinutes(20), function () {
            return News::join('news_category', 'news.news_id', '=', 'news_category.news_id')
                ->whereIn('news.news_type_id', [1, 7])
                ->where('news.publish_status', 1)
                ->where('news.active', 1)
                ->where('news.is_video_exist', 1)
                ->count();
        });
    }

    public function videoDuration()
    {
        cache()->remember('videoDuration', now()->addMinutes(20), function () {
            $sum = News::where('news.publish_status', 1)
                ->whereIn('news.news_type_id', [1, 7])
                ->where('news.is_video_exist', 1)
                ->where('news.active', 1)
                ->sum('news_duration');

            $seconds = $sum;
            $hours = floor($seconds / 3600);
            $minutes = floor(($seconds % 3600) / 60);

            $h = number_format($hours);
            $m = number_format($minutes);

            return $h . " ชม. " . $m . " น.";
        });
    }
}
