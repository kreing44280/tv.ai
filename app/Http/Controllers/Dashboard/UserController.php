<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.user-profile');
    }

    public function members(){
        $users = User::paginate(10);
        return view('pages.user-management', compact('users'));
    }
}
