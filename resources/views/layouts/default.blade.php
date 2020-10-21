<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>HBScanner</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet" media="screen">
    <link href="{{ URL::asset('css/thin-admin.css') }}" rel="stylesheet" media="screen">
    <link href="{{ URL::asset('css/font-awesome.css') }}" rel="stylesheet" media="screen">
    <link href="{{ URL::asset('style/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('style/dashboard.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css') }}" rel="stylesheet"
          type="text/css"
          media="screen"/>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="{{ URL::asset('assets/js/html5shiv.js') }}"></script>
    <script src="{{ URL::asset('assets/js/respond.min.js') }}"></script>
    <![endif]-->

</head>
<body>
<!-- session信息提示 -->
@include('shared._message')

@include('layouts._header')

<div class="wrapper">
    @include('layouts._left')

    @yield('content')
</div>

@include('layouts._footer')

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ URL::asset('js/jquery.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/smooth-sliding-menu.js') }}"></script>
<script class="include" type="text/javascript" src="{{ URL::asset('javascript/jquery191.min.js') }}"></script>
<script class="include" type="text/javascript" src="{{ URL::asset('javascript/jquery.jqplot.min.js') }}"></script>
<script src="{{ URL::asset('assets/sparkline/jquery.sparkline.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/sparkline/jquery.customSelect.min.js') }}"></script>
<script src="{{ URL::asset('assets/sparkline/sparkline-chart.js') }}"></script>
<script src="{{ URL::asset('assets/sparkline/easy-pie-chart.js') }}"></script>
<script src="{{ URL::asset('js/select-checkbox.js') }}"></script>
<script src="{{ URL::asset('js/to-do-admin.js') }}"></script>

{{--<!--switcher html start-->--}}
{{--<div class="demo_changer active" style="right: 0px;">--}}
{{--    <div class="demo-icon"></div>--}}
{{--    <div class="form_holder">--}}
{{--        <div class="predefined_styles">--}}
{{--            <a class="styleswitch" rel="a" href=""><img alt="" src="{{ URL::asset('images/a.jpg') }}"></a>--}}
{{--            <a class="styleswitch" rel="b" href=""><img alt="" src="{{ URL::asset('images/b.jpg') }}"></a>--}}
{{--            <a class="styleswitch" rel="c" href=""><img alt="" src="{{ URL::asset('images/c.jpg') }}"></a>--}}
{{--            <a class="styleswitch" rel="d" href=""><img alt="" src="{{ URL::asset('images/d.jpg') }}"></a>--}}
{{--            <a class="styleswitch" rel="e" href=""><img alt="" src="{{ URL::asset('images/e.jpg') }}"></a>--}}
{{--            <a class="styleswitch" rel="f" href=""><img alt="" src="{{ URL::asset('images/f.jpg') }}"></a>--}}
{{--            <a class="styleswitch" rel="g" href=""><img alt="" src="{{ URL::asset('images/g.jpg') }}"></a>--}}
{{--            <a class="styleswitch" rel="h" href=""><img alt="" src="{{ URL::asset('images/h.jpg') }}"></a>--}}
{{--            <a class="styleswitch" rel="i" href=""><img alt="" src="{{ URL::asset('images/i.jpg') }}"></a>--}}
{{--            <a class="styleswitch" rel="j" href=""><img alt="" src="{{ URL::asset('images/j.jpg') }}"></a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<!--switcher html end-->--}}
{{--<script src="{{ URL::asset('assets/switcher/switcher.js') }}"></script>--}}
{{--<script src="{{ URL::asset('assets/switcher/moderziner.custom.js') }}"></script>--}}
{{--<link href="{{ URL::asset('assets/switcher/switcher.css') }}" rel="stylesheet">--}}
{{--<link href="{{ URL::asset('assets/switcher/switcher-defult.css') }}" rel="stylesheet">--}}
{{--<link rel="alternate stylesheet" type="text/css" href="{{ URL::asset('assets/switcher/a.css') }}" title="a"--}}
{{--      media="all"/>--}}
{{--<link rel="alternate stylesheet" type="text/css" href="{{ URL::asset('assets/switcher/b.css') }}" title="b"--}}
{{--      media="all"/>--}}
{{--<link rel="alternate stylesheet" type="text/css" href="{{ URL::asset('assets/switcher/c.css') }}" title="c"--}}
{{--      media="all"/>--}}
{{--<link rel="alternate stylesheet" type="text/css" href="{{ URL::asset('assets/switcher/d.css') }}" title="d"--}}
{{--      media="all"/>--}}
{{--<link rel="alternate stylesheet" type="text/css" href="{{ URL::asset('assets/switcher/e.css') }}" title="e"--}}
{{--      media="all"/>--}}
{{--<link rel="alternate stylesheet" type="text/css" href="{{ URL::asset('assets/switcher/f.css') }}" title="f"--}}
{{--      media="all"/>--}}
{{--<link rel="alternate stylesheet" type="text/css" href="{{ URL::asset('assets/switcher/g.css') }}" title="g"--}}
{{--      media="all"/>--}}
{{--<link rel="alternate stylesheet" type="text/css" href="{{ URL::asset('assets/switcher/h.css') }}" title="h"--}}
{{--      media="all"/>--}}
{{--<link rel="alternate stylesheet" type="text/css" href="{{ URL::asset('assets/switcher/i.css') }}" title="i"--}}
{{--      media="all"/>--}}
{{--<link rel="alternate stylesheet" type="text/css" href="{{ URL::asset('assets/switcher/j.css') }}" title="j"--}}
{{--      media="all"/>--}}

</body>
</html>
