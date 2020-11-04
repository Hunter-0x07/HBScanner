<?php

namespace App\Http\Controllers;

use App\Models\PortScanTask;
use Illuminate\Http\Request;
use function Symfony\Component\String\s;

class PortScanTasksController extends Controller
{
    /**
     * 返回新建扫描任务表单
     *
     */
    public function create()
    {
        return view('port_scan_tasks.create');
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

        // 将新扫描任务存放到port_scan_task数据库
        $task = PortScanTask::create([
            'task_name' => $request->task_name,
            'target' => $request->target,
            'status' => 'waiting',
        ]);

        // 调用端口扫描器
//        shell_exec("python3 /home/vagrant/code/scanner/port_scan/port_scan.py $task->id");
        shell_exec("python3 /home/vagrant/code/scanner/port_scan_run.py $task->id");

        return redirect()->route('port_task.index');
    }

    /**
     * 获取所有扫描任务并返回扫描任务列表
     *
     */
    public function index()
    {
        // 从扫描任务表中获取所有数据
        $tasks = PortScanTask::all();

        return view('port_scan_tasks.index', compact('tasks'));
    }

    /**
     * 以json格式返回指定扫描任务的数据
     *
     */
    public function show(Request $request, $task_id)
    {
        // 从数据库中获取指定task_id的任务数据
        $task = PortScanTask::find($task_id);

        // 以json格式返回数据到前端
        return response()->json($task)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    /**
     * 删除指定扫描任务
     *
     */
    public function delete(Request $request, $task_id)
    {
        // 从数据库中获取指定task_id的任务数据
        $task = PortScanTask::find($task_id);

        // 删除任务数据
        $task->delete();

        // 刷新页面
        return back();
    }
}
