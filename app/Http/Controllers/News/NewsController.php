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
            return NewsCategory::paginate(10); // Fetch directly with pagination
        });

        $tv_programs = $this->getTvProgram();
        $categories = $this->getCategories();

        // Apply the setPicture logic
        $datas->each(function ($item) {
            $this->setPicture($item);
        });

        $news_count = NewsCategory::count();

        return view('pages.news', compact('datas', 'tv_programs', 'categories', 'news_count'));
    }

    private function getTvProgram()
    {
        return cache()->remember('tvProgram', now()->addMinutes(10), fn() => TvProgram::all());
    }

    private function getCategories()
    {
        return cache()->remember('category', now()->addMinutes(10), fn() => TvCategory::all());
    }

    public function search()
    {
        $newsName = request('newsName');
        $startDate = request('startDate');
        $endDate = request('endDate');
        $category_id = request('category');
        $tv_programs_id = request('tv_program');

        $datas = NewsCategory::whereHas('news', function ($query) use ($newsName, $startDate, $endDate, $category_id, $tv_programs_id) {
            if (is_numeric($newsName)) {
                $query->where(News::NEWS_ID, $newsName);
            } else {
                $query->where(function ($q) use ($newsName) {
                    $q->where(News::NEWS_ID, $newsName)
                        ->OrWhere('news_title', 'like', '%' . $newsName . '%')
                        ->OrWhere('news_permalink', 'like', '%' . $newsName . '%')
                        ->OrWhere('news_content', 'like', '%' . $newsName . '%');
                });
            }
            if ($startDate && $endDate) {
                $query->whereBetween(News::NEWS_DATE, [$startDate, $endDate]);
            }
            if ($category_id) {
                $query->where(NewsCategory::CATEGORY_ID, $category_id);
            }
            if ($tv_programs_id) {
                $query->where(News::PROGRAM_ID, $tv_programs_id);
            }
        })->paginate(10);

        $datas->each(function ($item) {
            $this->setPicture($item);
        });

        $tv_programs = $this->getTvProgram();
        $categories = $this->getCategories();
        $news_count = NewsCategory::count();


        return view('pages.news', compact('datas', 'tv_programs', 'categories', 'news_count'));
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
        $videoUrl = "https://vdoplayer.teroasia.com/archiving/$folder/media/$news_date/$news_id" . "_720.mp4";

        $videoUrl_new = file_exists(public_path($videoUrl))
            ? $videoUrl
            : "https://vdoplayer.teroasia.com/archiving/$folder/media/$news_date/$news_id" . ".mp4";

        $datas->news->video_url = $videoUrl_new;        

        return view('pages.news-detail', compact('datas'));
    }
}
