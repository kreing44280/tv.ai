<?php

namespace App\Console;

use App\Models\News;
use App\Models\NewsCategory;
use App\Models\TeroNews;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as BaseKernel;
use Illuminate\Support\Facades\Cache;

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
        Cache::put('dashboardData', [
            'categoryCountViews' => NewsCategory::categoryCountView(),
            'newsCount' => $this->getPublishedNewsCount()['total'],
            'archivedNewsCount' => $this->getPublishedNewsCount()['archived_news'],
            'teroNewsCount' => $this->getPublishedNewsCount()['tero_news'],
            'aiNewsCount' => $this->getAINewsCount(),
            'pendingCount' => $this->getAINewsPendingCount(),
            'categoryNewsCount' => NewsCategory::categoryCountNews()
        ], now()->addMinutes(20));
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
        Cache::put('sumNewsContent', News::whereIn(News::NEWS_TYPE_ID, [1, 7])
            ->where('publish_status', 1)
            ->where('active', 1)
            ->where('news.is_video_exist', 1)
            ->sum('news_content_count'), now()->addMinutes(20));
    }

    public function newsCount()
    {
        Cache::put('newsCount', News::join('news_category', 'news.news_id', '=', 'news_category.news_id')
            ->whereIn('news.news_type_id', [1, 7])
            ->where('news.publish_status', 1)
            ->where('news.active', 1)
            ->where('news.is_video_exist', 1)
            ->count(), now()->addMinutes(20));
    }

    public function videoDuration()
    {
        Cache::put('videoDuration', function () {
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
        }, now()->addMinutes(20));
    }

    public function archiveNews()
    {
        Cache::put('news_data_page_' . request('page', 1), News::selectRaw('news.news_id, news.news_title, news.news_date, news.news_permalink,
            category.category_name, news.news_pic, news.news_type_id, news.program_id,
            TIME_FORMAT(SEC_TO_TIME(news.news_duration), "%H:%i:%s") as video_duration')
            ->with('tvProgram', 'newsType')
            ->join('news_category', 'news.news_id', '=', 'news_category.news_id')
            ->join('category', 'news_category.category_id', '=', 'category.category_id')
            ->where('news.publish_status', 1)
            ->where('news.active', 1)
            ->where('news.is_video_exist', 1)
            ->whereIn('news.news_type_id', [1, 7])
            ->paginate(30), now()->addMinutes(20));
    }

    public function teroNews()
    {
        Cache::put('teroNewsPaginated_' . request('page', 1), TeroNews::selectRaw('news_tero.news_id, news_tero.news_title, news_tero.news_date, news_tero.news_permalink,
                news_tero.news_pic, news_tero.news_type_id, news_tero.program_id, news_tero.news_line_category')
            ->with('tvProgram', 'newsType')
            ->where('news_tero.publish_status', 1)
            ->where('news_tero.active', 1)
            ->whereIn('news_tero.news_type_id', [1, 7])
            ->paginate(30), now()->addMinutes(20));
    }
}
