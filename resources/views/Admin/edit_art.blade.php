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

    <div class="page-head">
        <h2><a href="{{url('admin/article')}}" id="tt">文章列表</a> | <a href="{{url('admin/edit_art')}}">添加文章</a></h2>

    </div>
    <div class="cl-mcont">
        <div class="col-sm-6 col-md-12">
            <div class="block-flat">
                <div class="content">
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

                    </div>
                    <form  enctype="multipart/form-data" role="form" onsubmit="return false"  id="form" class="form-horizontal">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$art['id']}}"/>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">标题</label>
                            <div class="col-sm-8">
                                <input required="" name="title"  value="{{$art['title']}}" class="form-control"><ul class="parsley-errors-list" id="parsley-id-0525"></ul>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">描述</label>
                            <div class="col-sm-8">
                                <input required="" name="des"  value="{{$art['des']}}" class="form-control"><ul class="parsley-errors-list" id="parsley-id-0525"></ul>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label">关键字</label>
                            <div class="col-sm-8">
                                <input name="keywords" class="tags" type="hidden" value="{{$art['keywords']}}" />
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label">所属分类</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="cate_id">
                                    @foreach($cate as $k=>$v)
                                    <option value="{{$v['id']}}" @if($v['id']==$art['cate_id']) selected="selected" @endif>{{$v['title']}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label">品牌</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="brand_id">
                                    <option value="0">无</option>
                                    @foreach($brand as $k=>$v)
                                        <option value="{{$v['id']}}">{{$v['title']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">封面图片</label>

                            <div class="col-sm-8">

                                @if($art['pics']['true_path'])
                                    <div class="file-preview" id="picview">
                                        <div class="close fileinput-remove">×</div>
                                        <div class="">
                                            <div class="file-preview-thumbnails">
                                                <div class="file-preview-frame" id="preview-1503452667787-0" data-fileindex="0">
                                                    <img src="{{$art['pics']['true_path']}}" class="file-preview-image" title="{{$art['pics']['true_path']}}" alt="{{$art['pics']['true_path']}}" style="width:auto;height:160px;">
                                                    <div class="file-thumbnail-footer">
                                                        <div class="file-caption-name" style="width: 170px;" title="{{$art['pics']['true_path']}}">{{$art['pics']['true_path']}}</div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>    <div class="file-preview-status text-center text-success"></div>
                                            <div class="kv-fileinput-error file-error-message" style="display: none;"></div>
                                        </div>
                                    </div>
                                @endif




                                <input id="img" class="file"  type="file" name="cover" placeholder="添加图片"><ul class="parsley-errors-list" id="parsley-id-0525"></ul>
                            </div>
                        </div>

                        <input type="hidden" name="file" value="{{$art['cover_id']}}"/>
                        <div class="form-group">

                            <label for="inputEmail3"class="col-sm-3 control-label">内容</label>

                            <div class="col-sm-8">
                                <div class="content">
                                    <div id="summernote"></div>
                                </div>
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



                $("#summernote").summernote({
                    lang : 'zh-CN',
                    minHeight : 300,
                    height:500,
                    dialogsFade : true,// Add fade effect on dialogs
                    dialogsInBody : true,// Dialogs can be placed in body, not in
                    // summernote.
                    disableDragAndDrop : false,// default false You can disable drag
                    onImageUpload:function(files, editor, editable){
                        sendFile(files, editor, editable)

                    }
                    // and drop

                });


            //图片上传
            function sendFile(files, editor, editable) {


                var $files = $(files);


                    var data = new FormData();
                    data.append("file", $files[0]);
                    data.append("_token", '{{ csrf_token() }}');

                $.ajax({
                    data : data,
                    type : "post",
                    url : "{{url('admin/text_pic')}}", //图片上传出来的url，返回的是图片上传后的路径，http格式
                    cache : false,
                    contentType : false,
                    processData : false,
                    dataType : "json",
                    success: function(data) {

                        editor.insertImage(editable, data.msg);

                    },
                    error:function(){
                        alert("上传失败")
                    }
                });

            }


            $("#bttn").on('click',function(){

                var content=$('#summernote').code();

                var fd = new FormData(document.querySelector("#form"));
                var url='{{url('admin/add_art')}}';
                fd.append('content',content);

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
                        if(d.msg=='操作成功'){
                            window.location.href='{{url("admin/article")}}';
                        }
                    },
                    error:function(){
                        alert('添加失败');
                    }
                });


            });




            $('#summernote').code('{!! $art["content"] !!}');

            $('#img').click(function(){
                $("#picview").css('display','none');
                $("input[name=file]").val('');
            });


        });


    </script>
@stop



