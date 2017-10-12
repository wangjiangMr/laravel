@extends('admin_layouts.master')
@section('head_css_js')
    <link href="/js/ntps/admin/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/bootstrap.switch/bootstrap-switch.css" />
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/jquery.select2/select2.css" />
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/bootstrap.slider/css/slider.css" />
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/bootstrap.wysihtml5/dist/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/bootstrap.summernote/dist/summernote.css" />
    <!-- Custom styles for this template -->
    <link href="/css/ntps/admin/style.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="http://www.jq22.com/jquery/font-awesome.4.6.0.css">
    <link rel="stylesheet" href="/css/ntps/admin/pygments.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/jquery.nanoscroller/nanoscroller.css" />
    <link href="/css/ntps/admin/upload/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <script src="/js/ntps/admin/upload/jquery-2.0.3.min.js"></script>
    <script src="/js/ntps/admin/upload/fileinput.js" type="text/javascript"></script>
    <script src="/js/ntps/admin/upload/fileinput_locale_zh.js"></script>
@stop
@section('foot_css_js')
    <script src="/js/ntps/admin/jquery.js"></script>
    <script src="/js/ntps/admin/jquery.select2/select2.min.js" type="text/javascript"></script>
    <script src="/js/ntps/admin/jquery.parsley/dist/parsley.js" type="text/javascript"></script>
    <script src="/js/ntps/admin/bootstrap.slider/js/bootstrap-slider.js" type="text/javascript"></script>

    <script type="text/javascript" src="/js/ntps/admin/bootstrap.summernote/dist/summernote.min.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/bootstrap.wysihtml5/dist/wysihtml5-0.3.0.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/bootstrap.wysihtml5/dist/bootstrap3-wysihtml5.all.min.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/jquery.nanoscroller/jquery.nanoscroller.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/jquery.nestable/jquery.nestable.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/behaviour/general.js"></script>
    <script src="/js/ntps/admin/jquery.ui/jquery-ui.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/ntps/admin/bootstrap.switch/bootstrap-switch.min.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/js/ntps/admin/behaviour/voice-commands.js"></script>
    <script src="/js/ntps/admin/bootstrap/dist/js/bootstrap.min.js"></script>
@stop
@section('body')

    <style>
        .fileinput-upload-button{display: none;}
    </style>


    <div class="page-head">
        <h2><a href="{{ url('admin/user') }}">用户列表</a> | <a href="{{url('admin/user_edit')}}">添加用户</a></h2>

    </div>
    <div class="cl-mcont">
        <div class="col-sm-6 col-md-12">
            <div class="block-flat">
                <div class="content">

                    <form  enctype="multipart/form-data" role="form" onsubmit="return false"  id="form" class="form-horizontal">
                        {{csrf_field()}}

                        <input type="hidden" name="uid" value="{{$list['uid']}}"/>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">昵称</label>
                            <div class="col-sm-8">
                                <input required="" name="name"  value="{{$list['name']}}" class="form-control"><ul class="parsley-errors-list" id="parsley-id-0525"></ul>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">真实姓名</label>
                            <div class="col-sm-8">
                                <input required="" name="truename"  value="{{$list['truename']}}" class="form-control"><ul class="parsley-errors-list" id="parsley-id-0525"></ul>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">邮箱</label>
                            <div class="col-sm-8">
                                <input required="" name="mail"  value="{{$list['mail']}}" class="form-control"><ul class="parsley-errors-list" id="parsley-id-0525"></ul>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">电话</label>
                            <div class="col-sm-8">
                                <input required="" name="mobile"  value="{{$list['mobile']}}" class="form-control"><ul class="parsley-errors-list" id="parsley-id-0525"></ul>
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">头像</label>

                            <div class="col-sm-8">

                                @if($list['head_img'])
                                    <div class="file-preview" id="picview">
                                        <div class="close fileinput-remove">×</div>
                                        <div class="">
                                            <div class="file-preview-thumbnails">
                                                <div class="file-preview-frame" id="preview-1503452667787-0" data-fileindex="0">
                                                    <img src="{{get_pic_path($list->head_img)}}" class="file-preview-image" title="{{get_pic_path($list->head_img)}}" alt="{{get_pic_path($list->head_img)}}" style="width:auto;height:160px;">
                                                    <div class="file-thumbnail-footer">
                                                        <div class="file-caption-name" style="width: 170px;" title="{{get_pic_path($list->head_img)}}">{{get_pic_path($list->head_img)}}</div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>    <div class="file-preview-status text-center text-success"></div>
                                            <div class="kv-fileinput-error file-error-message" style="display: none;"></div>
                                        </div>
                                    </div>
                                @endif

                                <input id="img" class="file" type="file" name="head_img" placeholder="添加图片"><ul class="parsley-errors-list" id="parsley-id-0525"></ul>
                            </div>
                        </div>




                        <div class="form-group">
                            <label class="col-sm-3 control-label">用户状态</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="status">


                                        <option value="0" @if($list['status']==0) selected="selected" @endif>禁用</option>
                                        <option value="1" @if($list['status']==1) selected="selected" @endif>正常</option>
                                        <option value="-1" @if($list['status']==-1) selected="selected" @endif>已删除</option>


                                </select>
                                <ul class="parsley-errors-list" id="parsley-id-0525"></ul>
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-sm-3 control-label">是否为管理员</label>
                            <div class="col-sm-6">
                                <label class="radio-inline"> <input type="radio" @if($list['is_admin']==1) checked="checked" @endif name="is_admin" value="1" class="icheck"> 是</label>
                                <label class="radio-inline"> <input type="radio" @if($list['is_admin']===0) checked="checked" @endif   name="is_admin" value="0" class="icheck"> 否</label>


                            </div>
                        </div>




                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button id='bttn' type="submit" class="col-md-1 btn btn-primary" style="margin: 50px 10%;width: 200px;">提交</button>
                            </div>
                        </div>


                    </form>

                </div>
            </div>
        </div>

    </div>


@stop



@section('script')
    <script type="text/javascript">

        $(document).ready(function(){
            //initialize the javascript
            App.init();
            $("#bttn").on('click',function(){
                var fd = new FormData(document.querySelector("#form"));
                var url='{{url('admin/user_handle')}}';
                fd.append('type','');
                var file=$("input[type=file]").val();
                fd.append('head_img',file);

                $.ajax({
                    data : fd,
                    type : "post",
                    url : url, //图片上传出来的url，返回的是图片上传后的路径，http格式
                    cache : false,
                    contentType : false,
                    processData : false,
                    dataType : "json",
                    success: function(d) {

                        alert(d.msg);
                        window.location.href="{{url('admin/user')}}";

                    },
                    error:function(){
                        alert('操作失败')
                    }
                });


            });





            $('#img').click(function(){
                $("#picview").css('display','none');
            });



        });


    </script>
@stop



