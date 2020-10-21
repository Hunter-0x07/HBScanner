<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create()
    {
        /**
         * 返回用户登录表单
         *
         */
        return view('session.create');
    }

    public function store(Request $request)
    {
        /**
         * 验证用户登录信息
         *
         */

        // 验证输入格式
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        // 将用户数据与数据库核对
        if (Auth::attempt($credentials)) {
            session()->flash('success', '欢迎回来！');
            return redirect()->route('users.show', [Auth::user()]);
        } else {
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配！');
            return redirect()->back()->withInput();
        }
    }
}
