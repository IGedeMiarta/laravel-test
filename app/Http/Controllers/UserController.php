<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::has('projects')->get();
        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        // $user = User::with('comments')->where('username',$user)->get();
        $user->with('comments')->get();
        return view('users.show', compact('user'));
    }
}
