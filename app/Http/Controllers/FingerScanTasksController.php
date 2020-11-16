<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FingerScanTask;

class FingerScanTasksController extends Controller
{
    /**
     * 返回新建扫描任务表单
     *
     */
    public function create()
    {
        return view('finger_scan_tasks.create');
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

        // 将新任务存放到finger_scan_task数据库
        $task = FingerScanTask::create([
            'task_name' => $request->task_name,
            'target' => $request->target,
            'status' => 'waiting',
        ]);

        // 调用指纹识别扫描
        shell_exec("python3 /home/vagrant/code/scanner/finger_scan_run.py $task->id");

        // 跳转到任务列表页
        return redirect()->route('finger_scan_task.index');
    }

    /**
     * 返回任务列表
     *
     */
    public function index()
    {
        $tasks = FingerScanTask::all();

        return view('finger_scan_tasks.index', compact('tasks'));
    }

    /**
     * 从任务列表中删除指定任务
     *
     */
    public function delete(Request $request, $task_id)
    {
        // 从数据库中获取指定task_id的任务数据
        $task = FingerScanTask::find($task_id);

        // 删除任务数据
        $task->delete();

        // 刷新页面
        return back();
    }
}
