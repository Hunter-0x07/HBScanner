<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        // 未登录用户权限限制
        $this->middleware('auth', [
            'except' => ['create', 'store']
        ]);
    }

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

    /**
     * 注册用户逻辑
     *
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users|max:50',
            'email' => 'required|unique:users|max:50',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

//        session()->flash('success', '注册成功！');
        return redirect()->route('login');
    }

    /**
     * 返回用户编辑页面
     *
     */
    public function edit(User $user)
    {
        // 登录用户权限限制
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    /**
     * 更新用户信息
     *
     */
    public function update(User $user, Request $request)
    {
        // 登录用户权限限制
        $this->authorize('update', $user);

        // 验证表单数据
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'required|confirmed|min:6'
        ]);

        // 更新数据
        $user->update([
            'name' => $request->name,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('users.edit', $user->id);
    }
}
