<?php

namespace App\Http\Controllers;

use App\Models\SubdomainScanTask;
use Illuminate\Http\Request;

class SubdomainScanTasksController extends Controller
{
    /**
     * 返回新建扫描任务表单
     *
     */
    public function create()
    {
        return view('subdomain_scan_tasks.create');
    }

    /**
     * 处理任务提交表单
     *
     */
    public function store(Request $request)
    {
        // 验证表单数据
        $this->validate($request, [
            'task_name' => 'required|max:50',
            'target' => 'required|max:50',
        ]);

        // 将新任务存放到subdomain_scan_task数据库
        $task = SubdomainScanTask::create([
            'task_name' => $request->task_name,
            'target' => $request->target,
            'status' => 'waiting',
        ]);

        // 调用子域名扫描器
        shell_exec("python3 /home/vagrant/code/scanner/subdomain_scan_run.py $task->id");

        // 跳转到任务列表页
        return redirect()->route('subdomain_task.index');
    }

    /**
     * 返回任务列表
     *
     */
    public function index()
    {
        $tasks = SubdomainScanTask::all();

        return view('subdomain_scan_tasks.index', compact('tasks'));
    }
}
