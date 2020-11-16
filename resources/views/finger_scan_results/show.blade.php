@extends('layouts.default')
@section('content')
    <div class="page-content">
        <div class="content container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="widget">
                        <div class="widget-header"><i class="icon-columns"></i>
                            <h3>应用指纹识别结果</h3>
                        </div>
                        <div class="widget-content">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>目标域名</th>
                                    <th>相关指纹</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td rowspan="{{ $result_num+1 }}">{{ $target_domain }}</td>
                                </tr>
                                @foreach($task_results as $result)
                                    <tr>
                                        <td>{{ $result->target_app }}</td>
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


