<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    /**
     * 返回首页
     *
     */
    public function home()
    {
        return view("static_pages/home");
    }
}
