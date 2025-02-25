<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.user-profile');
    }

    public function members(){
        $users = User::paginate(10);
        dd($users);
        return view('pages.user-management', compact('users'));
    }
}
