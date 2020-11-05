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

/**
 * 子域名枚举任务路由
 *
 */
// 新建子域名枚举任务路由
Route::get('subdomain_task/create', 'SubdomainScanTasksController@create')->name('subdomain_task.create');
// 子域名表单处理提交的路由
Route::post('subdomain_task', 'SubdomainScanTasksController@store')->name('subdomain_task.store');
// 返回任务列表
Route::get('subdomain_task', 'SubdomainScanTasksController@index')->name('subdomain_task.index');
// 删除指定任务
Route::get('subdomain_task/delete/{task_id}', 'SubdomainScanTasksController@delete')->name('subdomain_task.delete');

/**
 * 子域名枚举结果路由
 *
 */
// 获取指定任务结果路由
Route::get('subdomain_result/{task_id}', 'SubdomainScanResultsController@show')->name('subdomain_result.show');



