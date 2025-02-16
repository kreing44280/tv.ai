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
        $count = NewsCategory::count();
        $count_success = 0;
        $count_pending = 0;
        $count_user = User::count();

        return view('pages.dashboard', compact('count', 'count_success', 'count_pending', 'count_user'));
    }
}
