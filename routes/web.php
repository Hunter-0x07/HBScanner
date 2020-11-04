<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/**
 * 主页路由
 *
 **/
Route::get('/', 'StaticPagesController@home')->name('home');

/**
 * 用户注册及管理路由
 *
 **/
Route::get('signup', 'UsersController@create')->name('signup');
Route::resource('users', 'UsersController');

/**
 * 会话管理路由
 *
 **/
Route::get('login', 'SessionController@create')->name('login');
Route::post('login', 'SessionController@store')->name('login');
Route::delete('logout', 'SessionController@destroy')->name('logout');

/**
 * 端口扫描任务路由
 *
 **/
Route::resource('port_task', 'PortScanTasksController');
// 删除指定任务
Route::get('port_task/delete/{task_id}', 'PortScanTasksController@delete')->name('port_task.delete');

/**
 * 端口扫描任务结果路由
 *
 */
// 获取指定扫描任务的结果
Route::get('port_task_result/{task_id}', 'PortScanResultsController@show')->name('port_task_result.show');



