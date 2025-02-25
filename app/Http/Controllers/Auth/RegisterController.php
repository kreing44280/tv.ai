<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;

use function Laravel\Prompts\error;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'user_name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        if ($user) {
            session()->flash('success', 'User created successfully');
        }

        return redirect()->route('login');    
    }
}
