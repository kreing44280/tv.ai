<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $newsCount = NewsCategory::getPublishedNewsCount(); 
        $aiNewsCount = NewsCategory::getAINewsCount();
        $pendingCount = NewsCategory::getAINewsPendingCount();      
        $userCount = User::count();           
        $populars = NewsCategory::getPopular();
        $categoryCountViews = NewsCategory::categoryCountView();
        $cateAll = NewsCategory::categoryCountNews();
        $categoryNames = $categoryCountViews->pluck('category_name')->toArray();
        $categoryViews = $categoryCountViews->pluck('total_news_count')->toArray();
        
        foreach ($populars as $item) {
            $this->setPicture($item);
        }

        return view('pages.dashboard', compact(
            'newsCount',
            'pendingCount',
            'userCount',
            'populars',
            'categoryNames',
            'categoryViews',
            'aiNewsCount',
            'cateAll'
        ));
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
