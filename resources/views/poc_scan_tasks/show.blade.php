@extends('layouts.default')
@section('content')
    <div class="page-content">
        <div class="content container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="widget">
                        <div class="widget-header"><i class="icon-columns"></i>
                            <h3>漏洞详情信息</h3>
                        </div>
                        <div class="widget-content">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>漏洞名称</th>
                                    <th>相关厂商</th>
                                    <th>漏洞类型</th>
                                    <th>危害等级</th>
                                    <th>参考链接</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--                                <tr>--}}
                                {{--                                    <td rowspan="{{ $result_num+1 }}">{{ $target_ip }}</td>--}}
                                {{--                                </tr>--}}
                                {{--                                @foreach($task_results as $result)--}}
                                {{--                                    <tr>--}}
                                {{--                                        <td>{{ $result->open_port }}</td>--}}
                                {{--                                    </tr>--}}
                                {{--                                @endforeach--}}
                                <tr>
                                    <td>{{ $poc->poc_name }}</td>
                                    <td>{{ $poc->manufacturer }}</td>
                                    <td>{{ $poc->type }}</td>
                                    @if($poc->level == "high")
                                        <td>高</td>
                                    @elseif($poc->level == "medium")
                                        <td>中</td>
                                    @else($poc->level == "low")
                                        <td>低</td>
                                    @endif
                                    <td><a href="{{ $poc->href }}">{{ $poc->href }}</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

