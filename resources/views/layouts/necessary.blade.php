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
@include('shared._message')

@yield('content')

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

</body>
</html>
