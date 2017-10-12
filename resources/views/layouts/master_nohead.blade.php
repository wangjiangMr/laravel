<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" ng-app="AntVel">
<head>

    {{--meta--}}
    @section('metaLabels')
        <meta charset="utf-8">
        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="ico/favicon.ico">
    @show

    {{--图标--}}
    <link rel="icon" href="favicon.ico">

    {{--title--}}
    <title>@section('title'){{ $tdk['title']}} @show</title>


    <script type="text/javascript">
        FileAPI = {
            debug: true
        };
    </script>


    @section('css')
    {{-- CSS files --}}
    <link href="/css/ntps/bxslider.css" rel="stylesheet">
    <link href="/css/ntps/style.css" rel="stylesheet">
    <link href="/css/ntps/font-awesome.min.css" rel="stylesheet">
    <link href="/css/ntps/animate.css" rel="stylesheet">
    <link href="/css/ntps/lightbox.css" rel="stylesheet">
    <link href="/css/ntps/cubeportfolio.min.css" rel="stylesheet">
    {{--<link href='http://fonts.useso.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet' type='text/css'>--}}
    {{--<link href='http://fonts.useso.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>--}}
        <script type="text/javascript" src="/js/ntps/modernizr.custom.69142.js"></script>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="/js/ntps/3.7.0/html5shiv.js"></script>
        <script src="/js/ntps/respond.min.js"></script>
        <![endif]-->
    @show





</head>
<body>




{{--body部分--}}

@section('body')

@show






{{--js引入--}}
@section('js')
<script src="/js/ntps/jquery.min.js"></script>
<script src="/js/ntps/bootstrap.min.js"></script>
<script src="/js/ntps/scrolltopcontrol.js"></script>
<script src="/js/ntps/SmoothScroll.js"></script>
<script src="/js/ntps/lightbox-2.6.min.js"></script>
<script src="/js/ntps/jquery.cubeportfolio.min.js"></script>
<script src="/js/ntps/jquery.bxslider.min.js"></script>
<script src="/js/ntps/custom.js"></script>
<script src="/js/ntps/index.js"></script>

@show

{{--添加的js--}}
@section('script')
@show

</body>
</html>
