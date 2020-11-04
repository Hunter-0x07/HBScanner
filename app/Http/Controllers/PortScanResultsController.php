<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PortScanResult;

class PortScanResultsController extends Controller
{
    /**
     * 获取指定扫描任务的结果
     *
     */
    public function show(Request $request, $task_id)
    {
        $task_results = PortScanResult::where('task_id', $task_id)->get();

        $target_ip = PortScanResult::where('task_id', $task_id)->first()->target_ip;

        $result_num = PortScanResult::where('task_id', $task_id)->count();

        return view('port_scan_results.show', [
            'task_results' => $task_results,
            'result_num' => $result_num,
            'target_ip' => $target_ip
        ]);
    }
}
