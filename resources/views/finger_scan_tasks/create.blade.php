@extends('layouts.default')
@section('content')
    <div class="page-content">
        <div class="content container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="widget">
                        <div class="widget-header"><i class="icon-anchor"></i>
                            <h3>web指纹识别任务</h3>
                        </div>
                        <div class="widget-content">
                            <div class="body">
                                <form action="{{ route('finger_scan_task.store') }}" data-validate="parsley"
                                      method="post" novalidate
                                      class="form-horizontal label-left" id="user-form">
                                    {{ csrf_field() }}

                                    <fieldset>
                                        <legend class="section">任务新建</legend>
                                        <div class="control-group">
                                            <div class="col-md-3">
                                                <label for="prefix" class="control-label">任务名称</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <input type="text" placeholder="输入任务名称" class="col-sm-6 col-xs-12"
                                                           name="task_name"
                                                           id="prefix">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="col-md-3">
                                                <label for="first-name" class="control-label">任务目标</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <input type="text" placeholder="如：vulnweb.com"
                                                           class="col-xs-12 parsley-validated"
                                                           name="target" id="first-name">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="form-actions">
                                        <button class="btn btn-primary" type="submit">提交任务</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


