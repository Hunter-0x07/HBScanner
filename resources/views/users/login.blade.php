@extends('layouts.default')

@section('content')
    <div class="login-logo">
        <h3>HBScanner</h3>
    </div>

    <div class="widget">
        <div class="login-content">

            <!-- 错误信息提示 -->
            @include('shared._errors')

            <div class="widget-content" style="padding-bottom:0;">
                <form method="POST" action="{{ route('users.store') }}" class="no-margin">
                    <h3 class="form-title">用户登录</h3>
                    {{ csrf_field() }}

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

                        <div class="form-group">
                            <label for="password">密码：</label>

                            <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <i class="icon-lock"></i>
                                </span>
                                <input type="password" name="password" placeholder="你的密码" value="{{ old('password') }}" class="form-control input-lg">
                            </div>

                        </div>

                    </fieldset>
                    <div class="form-actions">
                        <button class="btn btn-warning pull-right" type="submit">
                            登录 <i class="m-icon-swapright m-icon-white"></i>
                        </button>
                        <div class="forgot"></div>
                    </div>


                </form>


            </div>
        </div>
    </div>
@stop
