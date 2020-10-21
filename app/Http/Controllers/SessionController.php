<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function __construct()
    {
        // 未登录用户权限限制
        $this->middleware('auth', [
            'except' => ['create', 'store']
        ]);
    }

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
        if (Auth::attempt($credentials, $request->has('remember'))) {
//            session()->flash('success', '欢迎回来！');
            return redirect()->route('users.edit', [Auth::user()]);
        } else {
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配！');
            return redirect()->back()->withInput();
        }
    }

    public function destroy()
    {
        /**
         * 用户退出登录，销毁会话
         *
         */
        Auth::logout();
//        session()->flash('success', '您成功退出！');
        return redirect('login');
    }
}
