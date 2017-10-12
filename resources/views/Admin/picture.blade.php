@extends('admin_layouts.master')


@section('head_css_js')
    {{--@parent--}}
    <!-- Bootstrap core CSS -->
    <link href="/js/ntps/admin/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/jquery.gritter/css/jquery.gritter.css" />

    <link rel="stylesheet" type="text/css" href="http://www.jq22.com/jquery/font-awesome.4.6.0.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="../../assets/js/html5shiv.js"></script>
    <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/jquery.nanoscroller/nanoscroller.css" />
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/jquery.easypiechart/jquery.easy-pie-chart.css" />
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/bootstrap.switch/bootstrap-switch.css" />
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/jquery.select2/select2.css" />
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/bootstrap.slider/css/slider.css" />
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/dropzone/css/dropzone.css" />
    <!-- Custom styles for this template -->
    <link href="/css/ntps/admin/style.css" rel="stylesheet" />
    {{--upload--}}
    {{--<link href="/css/ntps/admin/upload/bootstrap.min.css" rel="stylesheet">--}}
    <link href="/css/ntps/admin/upload/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <script src="/js/ntps/admin/upload/jquery-2.0.3.min.js"></script>
    <script src="/js/ntps/admin/upload/fileinput.js" type="text/javascript"></script>
    {{--<script src="/js/ntps/admin/upload/bootstrap.min.js" type="text/javascript"></script>--}}
    <script src="/js/ntps/admin/upload/fileinput_locale_zh.js"></script>

    <style>
        .kv-fileinput-upload{
            display: none;
        }
    </style>

@stop

@section('body')


    <div class="page-head">
        <h2><a href="{{url('admin/picture')}}">上传图片</a> | <a href="{{url('admin/pic')}}">查看全部</a></h2>
    </div>
    <div class="col-sm-6 col-md-12">
        <div class="block-flat">
            {{--错误提示--}}
            <div class="errors">
                @if(count($errors)>0)
                    <div class="box-body">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-ban"></i>错误：</h4>
                            {{$errors->all()[0]}}
                        </div>

                    </div>
                @endif
                @if(isset($tishi))
                    <div class="box-body">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-ban"></i>错误：</h4>
                            {{$tishi}}
                        </div>

                    </div>
                @endif
                @if (session('tishi'))

                    <div class="box-body">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-ban"></i>提示：</h4>
                            {{ session('tishi') }}
                        </div>

                    </div>

                @endif
            </div>
            <div class="content">
                <form class="form-horizontal" enctype="multipart/form-data" role="form" data-parsley-validate="" novalidate="" method="post" action="{{url('admin/pic/add_pic')}}">
                    {{csrf_field()}}


                    <input type="hidden" name="id" value="{{$pic['id']}}"/>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">标题</label>
                        <div class="col-sm-7">
                            <input required="" name="title" parsley-type="email" value="{{$pic['title']}}" class="form-control" id="inputEmail3" placeholder="标题" data-parsley-id="0525" type="email"><ul class="parsley-errors-list" id="parsley-id-0525"></ul>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">描述</label>
                        <div class="col-sm-7">
                            <input required="" name="des" parsley-type="email" value="{{$pic['des']}}" class="form-control" id="inputEmail3" placeholder="描述" data-parsley-id="0525" type="email"><ul class="parsley-errors-list" id="parsley-id-0525"></ul>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">分类</label>
                        <div class="col-sm-4">
                            <select id="select" name="cate_id" class="form-control">
                                @foreach($cate as $k=>$v)
                                    <option @if($pic['cate_id']==$v['id']) selected="selected" @endif value="{{$v['id']}}">{{$v['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">图片</label>

                        <div class="col-sm-7">

                            @if($pic)
                                <div class="file-preview" id="picview">
                                    <div class="close fileinput-remove">×</div>
                                    <div class="">
                                        <div class="file-preview-thumbnails">
                                            <div class="file-preview-frame" id="preview-1503452667787-0" data-fileindex="0">
                                                <img src="{{$pic['pics']['true_path']}}" class="file-preview-image" title="{{$pic['pics']['true_path']}}" alt="{{$pic['pics']['true_path']}}    " style="width:auto;height:160px;">
                                                <div class="file-thumbnail-footer">
                                                    <div class="file-caption-name" style="width: 170px;" title="{{$pic['pics']['true_path']}}">{{$pic['pics']['true_path']}}</div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>    <div class="file-preview-status text-center text-success"></div>
                                        <div class="kv-fileinput-error file-error-message" style="display: none;"></div>
                                    </div>
                                </div>
                            @endif


                            <input id="img" class="file" type="file" name="img" placeholder="添加图片"><ul class="parsley-errors-list" id="parsley-id-0525"></ul>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="col-md-1 btn btn-primary" style="margin: 0px 10%;">提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>









@stop


@section('foot_css_js')

    <script src="/js/ntps/admin/jquery.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/jquery.nanoscroller/jquery.nanoscroller.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/jquery.sparkline/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/jquery.easypiechart/jquery.easy-pie-chart.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/behaviour/general.js"></script>
    <script src="/js/ntps/admin/jquery.ui/jquery-ui.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/ntps/admin/jquery.nestable/jquery.nestable.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/bootstrap.switch/bootstrap-switch.min.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/js/ntps/admin/jquery.select2/select2.min.js" type="text/javascript"></script>
    <script src="/js/ntps/admin/bootstrap.slider/js/bootstrap-slider.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/ntps/admin/jquery.gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/dropzone/dropzone.js"></script>



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/js/ntps/admin/behaviour/voice-commands.js"></script>
    <script src="/js/ntps/admin/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/jquery.flot/jquery.flot.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/jquery.flot/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/jquery.flot/jquery.flot.resize.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/jquery.flot/jquery.flot.labels.js"></script>
@stop

@section('script')
    <script type="text/javascript">

        $('#img').click(function(){
            $("#picview").css('display','none');
        });
    </script>
@stop



