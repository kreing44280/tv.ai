<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {              
        $data = News::getData(); 
        $populars = $data['popular'];
        $categoryNames = $data['categoryCountViews']->pluck('category_name')->toArray();
        $categoryViews = $data['categoryCountViews']->pluck('total_news_count')->toArray();
        $userCount = User::count();
        $newsCount = $data['newsCount'];
        $aiNewsCount = $data['aiNewsCount'];
        $pendingCount = $data['pendingCount'];
            
        return view('pages.dashboard', compact(
            'newsCount',
            'pendingCount',
            'userCount',
            'populars',
            'categoryNames',
            'categoryViews',
            'aiNewsCount'
        ));
    }
    
}
