<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    
    public function index()
    {
        return view('auth.reset-password');
    }

    public function update()
    {
        return view('auth.reset-password');
    }
}
