<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use App\Models\TvArchived;

class NewsController extends Controller
{
    public function index()
    {
        $datas = NewsCategory::paginate(10);

        $datas->each(function ($item) {
            $this->setPicture($item);
        });    

        return view('pages.news', compact('datas'));
    }

    public function search()
    {
        $newsName = request('newsName');
        $datas = NewsCategory::whereHas('news', function ($query) use ($newsName) {
            $query->where('news_title', 'like', '%' . $newsName . '%');
        })->paginate(10);

        $datas->each(function ($item) {
            $this->setPicture($item);
        });

        return view('pages.news', compact('datas'));
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

        $datas->news->news_content = $this->htmlEntity($datas->news->news_content);

        return view('pages.news-detail', compact('datas'));
    }

    private function htmlEntity($html){
        return strip_tags(html_entity_decode($html, ENT_QUOTES));
    }
}
