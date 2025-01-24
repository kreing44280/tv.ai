<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\FootageNews;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $count = FootageNews::count();
        $count_success = FootageNews::where(FootageNews::STATUS_TRANSCRIPT, 'success')->count();
        $count_pending = FootageNews::where(FootageNews::STATUS_TRANSCRIPT, 'pending')->count();
        $count_user = User::count();

        return view('pages.dashboard', compact('count', 'count_success', 'count_pending', 'count_user'));
    }
}
