@extends('layouts.default')
@section('content')
    <div class="login-logo">
        <h3>HBScanner</h3>
    </div>

    <div class="widget">
        <div class="login-content">
            <div class="widget-content" style="padding-bottom:0;">
                <form method="POST" action="{{ route('users.store') }}" class="no-margin">
                    {{ csrf_field() }}
                    <h3 class="form-title">用户注册</h3>

                    <fieldset>
                        <div class="form-group no-margin">
                            <label for="name">名称：</label>

                            <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <i class="icon-user"></i>
                                </span>
                                <input type="text" name="name" placeholder="你的名称" value="{{ old('name') }}" class="form-control input-lg">
                            </div>

                        </div>

                        <div class="form-group no-margin">
                            <label for="email">邮箱：</label>

                            <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <i class="icon-user"></i>
                                </span>
                                <input type="email" name="email" placeholder="你的邮箱" value="{{ old('email') }}" class="form-control input-lg">
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="password">密码：</label>

                            <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <i class="icon-lock"></i>
                                </span>
                                <input type="password" name="password" placeholder="你的密码" value="{{ old('password') }}" class="form-control input-lg">
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="password">确认密码：</label>

                            <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <i class="icon-lock"></i>
                                </span>
                                <input type="password" name="password_confirmation" placeholder="再次确认一下密码" value="{{ old('password_confirmation') }}" class="form-control input-lg">
                            </div>

                        </div>
                    </fieldset>
                    <div class="form-actions">
                        <button class="btn btn-warning pull-right" type="submit">
                            注册 <i class="m-icon-swapright m-icon-white"></i>
                        </button>
                        <div class="forgot"></div>
                    </div>


                </form>


            </div>
        </div>
    </div>
@stop
