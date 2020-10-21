<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    public function __construct()
    {
        // 未登录用户权限限制
        $this->middleware('auth');
    }

    /**
     * 返回首页
     *
     */
    public function home()
    {
        return view("static_pages/home");
    }
}
