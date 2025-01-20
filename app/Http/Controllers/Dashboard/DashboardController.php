<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\FootageNews;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $count = FootageNews::count();         
        return view('pages.dashboard', compact('count'));
    }
}
