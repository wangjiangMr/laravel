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

    @section('link_js')
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" type="text/css" href="http://www.jq22.com/jquery/bootstrap-3.3.4.css">
        <link rel="stylesheet" type="text/css" href="http://www.jq22.com/jquery/font-awesome.4.6.0.css">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <![endif]-->
    @show


    <script type="text/javascript">
        FileAPI = {
            debug: true
        };
    </script>


    @section('head_css_js')
    {{-- CSS files --}}
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" type="text/css" href="http://www.jq22.com/jquery/bootstrap-3.3.4.css">
        <link rel="stylesheet" type="text/css" href="http://www.jq22.com/jquery/font-awesome.4.6.0.css">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="/js/ntps/admin/jquery.gritter/css/jquery.gritter.css" />

        <link rel="stylesheet" type="text/css" href="/js/ntps/admin/jquery.nanoscroller/nanoscroller.css" />
        <link rel="stylesheet" type="text/css" href="/js/ntps/admin/jquery.easypiechart/jquery.easy-pie-chart.css" />
        <link rel="stylesheet" type="text/css" href="/js/ntps/admin/bootstrap.switch/bootstrap-switch.css" />
        <link rel="stylesheet" type="text/css" href="/js/ntps/admin/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css" />
        <link rel="stylesheet" type="text/css" href="/js/ntps/admin/jquery.select2/select2.css" />
        <link rel="stylesheet" type="text/css" href="/js/ntps/admin/bootstrap.slider/css/slider.css" />
        <link rel="stylesheet" type="text/css" href="/js/ntps/admin/intro.js/introjs.css" />
        <!-- Custom styles for this template -->
        <link href="/css/ntps/admin/style.css" rel="stylesheet" />
    @show

    {{--添加的css--}}
    @section('css')
    @show


</head>
<body>

{{--头部--}}
@section('head')

    @include('admin_layouts/head')

@show


{{--body部分--}}

 @section('body')
 @show


@section('foot_css_js')
    <script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/jquery.gritter/js/jquery.gritter.js"></script>

    <script type="text/javascript" src="/js/ntps/admin/jquery.nanoscroller/jquery.nanoscroller.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/behaviour/general.js"></script>
    <script src="/js/ntps/admin/jquery.ui/jquery-ui.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/ntps/admin/jquery.sparkline/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/jquery.easypiechart/jquery.easy-pie-chart.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/jquery.nestable/jquery.nestable.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/bootstrap.switch/bootstrap-switch.min.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/js/ntps/admin/jquery.select2/select2.min.js" type="text/javascript"></script>
    <script src="/js/ntps/admin/skycons/skycons.js" type="text/javascript"></script>
    <script src="/js/ntps/admin/bootstrap.slider/js/bootstrap-slider.js" type="text/javascript"></script>
    <script src="/js/ntps/admin/intro.js/intro.js" type="text/javascript"></script>



    <!-- Bootstrap core JavaScript
      ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/js/ntps/admin/behaviour/voice-commands.js"></script>
    <script src="/js/ntps/admin/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/jquery.flot/jquery.flot.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/jquery.flot/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/jquery.flot/jquery.flot.resize.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/jquery.flot/jquery.flot.labels.js"></script>
@show



{{--添加的js--}}
@section('script')
@show

</body>
</html>
