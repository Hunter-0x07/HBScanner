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
                <form method="POST" action="{{ route('login') }}" class="no-margin">
                    <h3 class="form-title">用户登录</h3>
                    {{ csrf_field() }}

                    <fieldset>
                        <div class="form-group no-margin">
                            <label for="name">邮箱：</label>

                            <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <i class="icon-user"></i>
                                </span>
                                <input type="email" name="email" placeholder="你的邮箱" value="{{ old('email') }}"
                                       class="form-control input-lg">
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="password">密码：</label>

                            <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <i class="icon-lock"></i>
                                </span>
                                <input type="password" name="password" placeholder="你的密码" value="{{ old('password') }}"
                                       class="form-control input-lg">
                            </div>

                        </div>

                    </fieldset>
                    <div class="form-actions">
                        <label class="checkbox">
                            <div class="checker"><span><input type="checkbox" value="1" name="remember"></span></div>
                            记住我
                        </label>
                        <button class="btn btn-warning pull-right" type="submit">
                            登录 <i class="m-icon-swapright m-icon-white"></i>
                        </button>
                        <div class="forgot"><a href="{{ route('signup') }}" class="forgot">还没帐号？现在注册！</a></div>
                    </div>


                </form>


            </div>
        </div>
    </div>
@stop

