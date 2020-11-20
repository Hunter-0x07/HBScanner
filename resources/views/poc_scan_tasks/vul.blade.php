@extends('layouts.default')
@section('content')
    <div class="page-content">
        <div class="content container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget">
                        <div class="widget-header"><i class="icon-table"></i>
                            <h3>漏洞列表</h3>
                        </div>
                        <div class="widget-content">
                            <div class="body">
                                <table class="table table-striped table-images">
                                    <thead>
                                    <tr>
                                        <th>漏洞名称</th>
                                        <th>漏洞等级</th>
                                        <th>对应任务</th>
                                        <th>发现时间</th>
                                        <th>漏洞详情</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($vul_list as $vul)
                                        <tr>
                                            <td>{{ $vul->task_name }}</td>
                                            <td>
                                                <div class="doc-buttons">
                                                    @if($vul->level == "high")
                                                        <a class="btn btn-s-md btn-danger btn-rounded" href="#">高危</a>
                                                    @elseif($vul->level == "medium")
                                                        <a class="btn btn-s-md btn-warning btn-rounded" href="#">中危</a>
                                                    @else($vul->level == "low")
                                                        <a class="btn btn-s-md btn-info btn-rounded" href="#">低危</a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{ $vul->task_name }}</td>
                                            <td>{{ $vul->created_at }}</td>
                                            <td>
                                                <div class="doc-buttons">
                                                    <a class="btn btn-success btn-rounded" href="{{ route('poc_scan_task.vul_detail', ['poc_id' => $vul->poc_id]) }}">点击查看漏洞详情</a>
                                                </div>
                                            </td>
                                        </tr>
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

