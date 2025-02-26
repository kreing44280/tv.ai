<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\TvCategory;
use App\Models\TvProgram;

class NewsController extends Controller
{
    public function index()
    {
        $datas = cache()->remember('news_page_' . request('page', 1), now()->addMinutes(10), function () {
            return NewsCategory::with(['TvCategory', 'news'])->whereHas('news', function ($query) {
                $query->whereIn(News::NEWS_TYPE_ID, [1, 7]);
                $query->where(News::PUBLISH_STATUS, 1);
                $query->where(News::ACTIVE, 1);
            })->paginate(10); // Fetch directly with pagination
        });

        $tv_programs = $this->getTvProgram();
        $categories = $this->getCategories();
        $sumNewsContent = $this->sumNewsContent();
        $news_count = $this->newsCount();

        // Apply the setPicture logic
        $datas->each(function ($item) {
            $this->setPicture($item);
        });        

        return view('pages.news', compact('datas', 'tv_programs', 'categories', 'news_count', 'sumNewsContent'));
    }   

    public function search()
    {
        // รับค่าจาก request
        $queryParams = [
            'newsName' => request('newsName'),
            'startDate' => request('startDate'),
            'endDate' => request('endDate'),
            'category' => request('category'),
            'tv_program' => request('tv_program'),
            'page' => request('page', 1),
        ];

        // ลบค่าที่เป็น null หรือว่าง
        $filteredParams = array_filter($queryParams, function ($value) {
            return !is_null($value) && $value !== '';
        });

        // ถ้า URL ปัจจุบันยังมีค่าที่ว่าง ให้ Redirect ไปยัง URL ใหม่ที่สะอาดขึ้น
        if (request()->query() !== $filteredParams) {
            return redirect()->to(url('/news/search') . '?' . http_build_query($filteredParams));
        }

        // ถ้า URL ถูกต้องแล้ว ให้ดำเนินการค้นหาต่อ
        $datas = NewsCategory::whereHas('news', function ($query) use ($filteredParams) {
            if (!empty($filteredParams['newsName'])) {
                if (is_numeric($filteredParams['newsName'])) {
                    $query->where(News::NEWS_ID, $filteredParams['newsName']);
                } else {
                    $query->where(function ($q) use ($filteredParams) {
                        $q->where(News::NEWS_ID, $filteredParams['newsName'])
                            ->orWhere('news_title', 'like', '%' . $filteredParams['newsName'] . '%')
                            ->orWhere('news_permalink', 'like', '%' . $filteredParams['newsName'] . '%')
                            ->orWhere('news_content', 'like', '%' . $filteredParams['newsName'] . '%');
                    });
                }
            }

            if (!empty($filteredParams['startDate']) && !empty($filteredParams['endDate'])) {
                $query->whereBetween(News::NEWS_DATE, [$filteredParams['startDate'], $filteredParams['endDate']]);
            }

            if (!empty($filteredParams['category'])) {
                $query->where(NewsCategory::CATEGORY_ID, $filteredParams['category']);
            }

            if (!empty($filteredParams['tv_program'])) {
                $query->where(News::PROGRAM_ID, $filteredParams['tv_program']);
            }

            $query->whereIn(News::NEWS_TYPE_ID, [1, 7]);
        })->paginate(10, ['*'], 'page', $queryParams['page'])
        ->appends(request()->query());

        $datas->each(function ($item) {
            $this->setPicture($item);
        });

        $tv_programs = $this->getTvProgram();
        $categories = $this->getCategories();
        $sumNewsContent = $this->sumNewsContent();
        $news_count = $this->newsCount();

        return view('pages.news', compact('datas', 'tv_programs', 'categories', 'news_count', 'sumNewsContent'));
    }



    private function setPicture(NewsCategory $item)
    {
        $image = $item->news->news_pic;
        $imagePath = 'https://backend.teroasia.com/uploads/pic_news/mid_' . $image;

        $item->news->news_pic = (!empty($image) && @get_headers($imagePath)[0] !== 'HTTP/1.1 404 Not Found')
            ? asset($imagePath)
            : asset('https://cdn4.vectorstock.com/i/1000x1000/55/63/error-404-file-not-found-web-icon-vector-21745563.jpg');
    }

    public function show($id)
    {
        $datas = NewsCategory::whereHas('news', function ($query) use ($id) {
            $query->where('news_id', $id);
        })->first();

        $this->setPicture($datas);

        $folder = $datas->news->tvProgram->program_permalink;
        $news_id = $datas->news->news_id;
        $news_type_id = $datas->news->news_type_id;

        if ($news_type_id == 1) {
            $news_date = $datas->news->videoMaster->video_date;
        } else {
            $news_date = $datas->news->news_date->format('Y-m-d');
        }

        //480
        $videoUrl = "https://vdoplayer.teroasia.com/archiving/$folder/media/$news_date/$news_id" . "_480.mp4";

        $videoUrl_720 = "https://vdoplayer.teroasia.com/archiving/$folder/media/$news_date/$news_id" . "_720.mp4";

        $videoUrl_new = file_exists(public_path($videoUrl))
            ? $videoUrl
            : (file_exists(public_path($videoUrl_720))
                ? $videoUrl_720
                : "https://vdoplayer.teroasia.com/archiving/$folder/media/$news_date/$news_id" . ".mp4");

        $datas->news->video_url = $videoUrl_new;

        $datas->news->news_content = strip_tags(html_entity_decode($datas->news->news_content));

        return view('pages.news-detail', compact('datas'));
    }

    private function newsCount() {
        return cache()->remember('newsCount', now()->addMinutes(10), fn() => NewsCategory::whereHas('news', function ($query) {
            $query->whereIn(News::NEWS_TYPE_ID, [1, 7]);
            $query->where(News::PUBLISH_STATUS, 1);
            $query->where(News::ACTIVE, 1);
        })->count());
    }

    private function sumNewsContent() {        
        return cache()->remember('sumNewsContent', now()->addMinutes(10), fn() => News::whereIn(News::NEWS_TYPE_ID, [1, 7])->where('publish_status', 1)->where('active', 1)->sum('news_content_count'));
    }

    private function getTvProgram()
    {
        return cache()->remember('tvProgram', now()->addMinutes(10), fn() => TvProgram::all());
    }

    private function getCategories()
    {
        return cache()->remember('category', now()->addMinutes(10), fn() => TvCategory::all());
    }
}
