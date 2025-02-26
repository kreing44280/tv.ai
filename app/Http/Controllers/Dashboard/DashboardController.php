<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {      
        // $populars = News::getPopular();      
        // $categoryCountViews = NewsCategory::categoryCountView();            
        $cateAll = NewsCategory::categoryCountNews();
        dd($cateAll);
        $userCount = User::count();
        $newsCount = News::getPublishedNewsCount();         
        $aiNewsCount = News::getAINewsCount();
        $pendingCount = News::getAINewsPendingCount();             
        $categoryNames = $categoryCountViews->pluck('category_name')->toArray();
        $categoryViews = $categoryCountViews->pluck('total_news_count')->toArray();
            
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
    
}
