@extends('layouts.default')
@section('content')
    <div class="page-content">
        <div class="content container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="widget">
                        <div class="widget-header"><i class="icon-user"></i>
                            <h3>个人资料</h3>
                        </div>
                        <div class="widget-content">
                            <div class="body">
                                <form action="{{ route('users.update', $user->id) }}" data-validate="parsley"
                                      method="post" novalidate
                                      class="form-horizontal label-left" id="user-form">
                                    {{ method_field('PATCH') }}
                                    {{ csrf_field() }}

                                    <fieldset>
                                        <legend class="section">基本资料</legend>
                                        <div class="control-group">
                                            <div class="col-md-3">
                                                <label for="prefix" class="control-label">昵称</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <input type="text" class="col-sm-6 col-xs-12" name="name"
                                                           id="prefix" value="{{ $user->name }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="col-md-3">
                                                <label for="first-name" class="control-label">邮箱</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <input type="text" class="col-xs-12 parsley-validated"
                                                           name="email" id="first-name" value="{{ $user->email }}"
                                                           disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="col-md-3">
                                                <label for="first-name" class="control-label">密码</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <input type="text" class="col-xs-12 parsley-validated"
                                                           name="password" id="first-name"
                                                           value="{{ old('password') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="col-md-3">
                                                <label for="first-name" class="control-label">确认密码</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <input type="text" class="col-xs-12 parsley-validated"
                                                           name="password_confirmation" id="first-name"
                                                           value="{{ old('password_confirmation') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="form-actions">
                                        <button class="btn btn-primary" type="submit">更新资料</button>
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


