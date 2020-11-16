<?php

namespace App\Http\Controllers;

use App\Models\FingerScanResult;
use Illuminate\Http\Request;

class FingerScanResultsController extends Controller
{
    /**
     * 获取指定任务的结果
     *
     */
    public function show(Request $request, $task_id)
    {
        $task_results = FingerScanResult::where('task_id', $task_id)->get();

        $target_domain = FingerScanResult::where('task_id', $task_id)->first()->target_domain;

        $result_num = FingerScanResult::where('task_id', $task_id)->count();

        return view('finger_scan_results.show', [
            'task_results' => $task_results,
            'result_num' => $result_num,
            'target_domain' => $target_domain,
        ]);
    }
}
