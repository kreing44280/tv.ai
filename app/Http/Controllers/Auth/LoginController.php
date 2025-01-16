<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }   

    public function store(LoginRequest $request)
    {
    
        if (auth()->attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        }

        return back()->with('status', 'Invalid credentials');
    }

    public function destroy()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
