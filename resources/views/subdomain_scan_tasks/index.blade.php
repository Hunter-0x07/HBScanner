@extends('layouts.default')
@section('content')
    <div class="page-content">
        <div class="content container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget">
                        <div class="widget-header"><i class="icon-table"></i>
                            <h3>子域名枚举任务列表</h3>
                        </div>
                        <div class="widget-content">
                            <div class="body">
                                <table class="table table-striped table-images">
                                    <thead>
                                    <tr>
                                        <th>任务名称</th>
                                        <th>任务状态</th>
                                        <th>创建时间</th>
                                        <th>修改时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tasks as $task)
                                        <tr>
                                            <td>{{ $task->task_name }}</td>
                                            <td>
                                                <div class="doc-buttons">
                                                    @if($task->status == "waiting")
                                                        <a class="btn btn-s-md btn-warning btn-rounded" href="#">等待中</a>
                                                    @elseif($task->status == "running")
                                                        <a class="btn btn-s-md btn-info btn-rounded" href="#">正在运行</a>
                                                    @elseif($task->status == "failed")
                                                        <a class="btn btn-s-md btn-danger btn-rounded" href="#">失败请重试</a>
                                                    @else($task->status == "completed")
                                                        <a class="btn btn-s-md btn-success btn-rounded" href="#">已完成</a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{ $task->created_at }}</td>
                                            <td>{{ $task->updated_at }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button data-toggle="dropdown"
                                                            class="btn btn-success dropdown-toggle">Action <span
                                                            class="caret"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#">导出报告</a></li>
                                                        <li><a href="#">任务结果</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('subdomain_task.delete', $task->id) }}">删除任务</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        {{--                                        <input id="task_show_url" type="hidden"--}}
                                        {{--                                               value="{{ route("port_task.show", ["task_id" => $task->id]) }}">--}}
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="clearfix">
                                    <div class="pull-right">
                                        <div class="btn-group">
                                            <button data-toggle="dropdown"
                                                    class="btn btn-sm btn-inverse dropdown-toggle"> &nbsp; Clear &nbsp;
                                                <i class="icon-caret-down"></i></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">Clear</a></li>
                                                <li><a href="#">Move ...</a></li>
                                                <li><a href="#">Something else here</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">Separated link</a></li>
                                            </ul>
                                        </div>
                                        <button class="btn btn-default btn-sm"> Send to ...</button>
                                    </div>
                                    <ul class="pagination no-margin">
                                        <li class="disabled"><a href="#">Prev</a></li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">Next</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

