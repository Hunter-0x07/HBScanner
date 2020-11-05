<?php

namespace App\Http\Controllers;

use App\Models\SubdomainScanResults;
use Illuminate\Http\Request;

class SubdomainScanResultsController extends Controller
{
    /**
     * 获取指定任务的结果
     *
     */
    public function show(Request $request, $task_id)
    {
        $task_results = SubdomainScanResults::where('task_id', $task_id)->get();

        $target_domain = SubdomainScanResults::where('task_id', $task_id)->first()->target_domain;

        $result_num = SubdomainScanResults::where('task_id', $task_id)->count();

        return view("subdomain_scan_results.show", [
            'task_results' => $task_results,
            'result_num' => $result_num,
            'target_domain' => $target_domain,
        ]);
    }
}
