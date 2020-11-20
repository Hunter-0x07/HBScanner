<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PocList;
use App\Models\PocScanTask;
use App\Models\TaskPoc;
use Illuminate\Support\Facades\DB;

class PocScanTasksController extends Controller
{
    /**
     * 返回新建POC检测任务表单
     *
     */
    public function create()
    {
        $poc_list = PocList::all();
        return view('poc_scan_tasks.create', [
            'poc_list' => $poc_list
        ]);
    }

    /**
     * 处理POC检测任务表单
     *
     */
    public function store(Request $request)
    {
        // 验证表单数据
        $this->validate($request, [
            'task_name' => 'required|max:50',
            'target' => 'required|max:50',
            'poc_id' => 'required|max:100',
        ]);

        // 将新扫描任务存放到poc_scan_task数据库
        $task = PocScanTask::create([
            'task_name' => $request->task_name,
            'task_target' => $request->target,
            'task_status' => "waiting",
        ]);

        // 将POC和任务的关联存放到task_poc数据库
        $task_poc = TaskPoc::create([
            'task_id' => $task->task_id,
            'poc_id' => $request->poc_id,
        ]);

        $poc = PocList::find($request->poc_id);

        $script_path = '/home/vagrant/code/' . $poc->poc_path;

        // 调用相应poc进行扫描
        shell_exec("python3 $script_path $task->task_target $task->task_id $request->poc_id");

        // 跳转到任务列表页
        return redirect()->route('poc_scan_task.index');
    }

    /**
     * 获取所有扫描任务并返回扫描任务列表
     *
     */
    public function index()
    {
        // 从扫描任务表中获取所有数据
        $tasks = PocScanTask::all();

        return view('poc_scan_tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * 删除指定任务
     *
     */
    public function delete(Request $request, $task_id)
    {
        // 从数据库中获取指定task_id的任务数据
        $task = PocScanTask::find($task_id);

        // 删除任务数据
        $task->delete();

        // 刷新页面
        return back();
    }

    /**
     * 返回漏洞列表
     *
     */
    public function vul()
    {
        // 获取所有已发现漏洞:漏洞名称，对应任务名称，任务创建时间, 危害等级, poc_id
        $vul_list = DB::select('SELECT poc_name, task_name, t.created_at, level, poc_list.poc_id
                                FROM poc_list
                                INNER JOIN poc_scan_results
                                USING (poc_id)
                                INNER JOIN poc_scan_tasks
                                AS t
                                USING (task_id)');

        // 返回漏洞列表
        return view('poc_scan_tasks.vul', [
            'vul_list' => $vul_list,
        ]);
    }

    /**
     * 返回单个漏洞详情
     *
     */
    public function vul_detail(Request $request, $poc_id)
    {
        $poc = PocList::find($poc_id);

        return view('poc_scan_tasks.show', [
            'poc' => $poc,
        ]);
    }
}
