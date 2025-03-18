<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.user-profile');
    }

    public function members()
    {
        $users = User::paginate(10);
        $roles = cache()->remember('roles', now()->addDay(), function () {
            return Role::all();
        });
        return view('pages.user-management', compact('users', 'roles'));
    }

    public function store()
    {
        $request = request();
        $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user_name',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required'
        ]);

        $user = User::create([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'publish_status' => 1
        ]);

        UserRole::create([
            'user_user_id' => $user->id,
            'role_role_id' => $request->role_id
        ]);


        return redirect()->route('members')->with('success', 'User registered successfully.');
    }

    public function show (){
        $new_arr = [];
        $user = User::with('UserRoles')->find(request()->user_id);       
        if ($user->UserRoles) {
            $new_arr = [
                'user_name' => $user->user_name,
                'email' => $user->email,
                'role_id' => $user->UserRoles->roles[0]->role_id
            ];
        }
        return $new_arr;
    }
}
