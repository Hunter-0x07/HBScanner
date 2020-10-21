<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * 返回用户注册页面
     *
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * 展示指定用户的信息页面
     *
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
}
