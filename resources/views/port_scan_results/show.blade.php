@extends('layouts.default')
@section('content')
    <div class="page-content">
        <div class="content container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="widget">
                        <div class="widget-header"><i class="icon-columns"></i>
                            <h3>任务结果</h3>
                        </div>
                        <div class="widget-content">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>目标IP</th>
                                    <th>开放端口</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td rowspan="{{ $result_num+1 }}">{{ $target_ip }}</td>
                                </tr>
                                @foreach($task_results as $result)
                                    <tr>
                                        <td>{{ $result->open_port }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

