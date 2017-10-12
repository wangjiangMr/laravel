@extends('layouts.master')


@section('body')
    <span id="header_shadow" style="width: 100%; top: 30px;"></span>

    <!-- Wrapper -->
    <div class="wrapper">

        <!-- Topic Header -->
        <div class="topic">
            <div class="container">
                <div class="row">
                    <ol class="breadcrumb hidden-xs">
                        <li><a href="/">首页</a></li>
                        <li><a href="{{url('question')}}">问答</a></li>
                        <li class="active">问答详情</li>
                    </ol>
                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div> <!-- / .Topic Header -->

        <div class="container">
            <div class="row">

                <div class="col-sm-12">

                    <!-- Filters 分类-->
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active"><a  href="#detail" data-toggle="tab">详情</a></li>
                        <li><a  href="#qus" data-toggle="tab">提问</a></li>
                    </ul>

                    <div class="row">
                        <div class="tab-content">

                                <!-- Promo-->
                            <div class="tab-pane fade in active" id="detail">
                                <div class="col-sm-12">
                                    <!-- Blog Post #1 -->
                                    <div class="blog">

                                        <div class="blog-desc" style="text-align: center;">
                                            <h3>
                                                <a>{{$qus['title']}}</a>
                                            </h3>
                                            <hr>
                                            <p class="text-muted">创建时间：{{date('Y-m-d',$qus['create_at'])}}</p>
                                            <p>
                                                简介：{!!$qus['qus_des']!!}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="comments">
                                        <!-- New comment form -->
                                        <div class="row">
                                            <div class="cmt">
                                                {{--<img src="/img/ntps/avatar.jpg" alt="...">--}}
                                                <div class="cmt-block">
                                                    <strong>我来回答</strong>
                                                    <form role="form" class="cmt-body" onsubmit="return false" enctype="multipart/form-data" id="form">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="q_id" value="{{$qus['id']}}"/>
                                                        <div class="form-group">
                                                            <textarea class="form-control" name="asw" rows="3" placeholder="请输入"></textarea>
                                                        </div>
                                                        <a href="javascript:void(0)" onclick="qus(this)" type="submit" class="btn btn-red">提交</a>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- List of comments -->
                                        <h4 class="text-right">{{count($asw)}}条回复</h4>
                                        <hr>

                                        @foreach($asw as $k=>$v)
                                            <div class="cmt">

                                                @if(get_pic_path(get_user_info($v['uid'])['head_img']))
                                                    <img src="{{get_pic_path(get_user_info($v['uid'])['head_img'])}}">
                                                @else
                                                    <img src="/img/ntps/head_default.png">
                                                @endif

                                                <div class="cmt-block">
                                                    <a href="#" class="profile-link">{{$v['user']['name']}}</a>
                                                    <span class="text-muted time">{{date('Y-m-d',$v['create_at'])}}</span>

                                                    <p class="cmt-body">
                                                        {{$v['answer']}}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                        @if(count($asw)==0)还没有回复，期待你的回复。。。@endif
                                        <div class="pager">
                                            {{ $asw->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Promo-->
                            <div class="tab-pane fade" id="qus">
                                <div class="col-sm-12">
                                    <div>
                                        <form id="formone" onsubmit="return false"  role="formone">
                                            <br/>
                                            {{csrf_field()}}
                                            <input type="hidden" name="cate_id" value="{{$qus['cate_id']}}"/>
                                            <div class="input-group input-group-lg col-sm-8" style="margin: 0px auto;">
                                                <span class="input-group-addon">问题标题</span>
                                                <input type="text" value="" class="form-control" name="title" placeholder="问题标题">
                                            </div>

                                            <br/>
                                            <br/>
                                            <div class="input-group input-group-lg col-sm-8" style="margin: 0px auto;">
                                                <span class="input-group-addon">问题内容</span>
                                                <textarea  class="form-control" style="width: 652px; height: 203px;" name="des" placeholder="问题内容"></textarea>
                                            </div>
                                            <br/>
                                            <br/>
                                            <br/>
                                            <br/>
                                            <div class="input-group input-group-lg col-sm-8" style="margin: 0px auto;text-align: center;">
                                                <button type="submit" class="btn btn-primary btn-lg col-sm-3" style="background-color: #f07057;border-color: #f07057;">提交</button>
                                            </div>
                                        </form>


                                    </div>

                                </div>
                            </div>



                        </div> <!-- /.tab-content -->
                    </div> <!-- / .row -->




                    <!-- / .row -->

                </div> <!-- / .col-sm-8 -->
            </div> <!-- / .row -->
        </div> <!-- / .container -->

    </div> <!-- / .wrapper -->
@stop
@section('script')
    <script type="text/javascript">


        var sta=1;
        var qus=function(){
            if(sta==0){
                alert('您已经提交过了哦')
                return;
            }
            var data=$("#form").serialize();
            $.ajax({
                data : data,
                type : "post",
                url : "{{url('add_asw')}}",
                dataType : "json",
                success: function(d) {
                    alert(d.msg);
                    if(d.sta==1){
                        sta=0;
                    }
                }
            });
        };


        $().ready(function() {
// 在键盘按下并释放及提交后验证提交表单
            $("#formone").validate({
                rules: {
                    title: {
                        required: true,
                        maxlength: 100
                    },
                    des: {
                        required: true,
                        maxlength: 250
                    }
                },
                messages: {
                    title: {
                        required: "请输入标题",
                        maxlength: '标题长度过长'

                    },
                    des: {
                        required: "请输入内容",
                        maxlength: '内容长度不能超过250个字符'

                    }
                },
                submitHandler: function () {
                    if(sta==0){
                        alert('您已经提交过了哦')
                        return;
                    }
                    var data = $("#formone").serialize();
                    $.ajax({
                        data: data,
                        type: "post",
                        url: "{{url('add_qus')}}", //图片上传出来的url，返回的是图片上传后的路径，http格式
                        dataType: "json",
                        success: function (d) {
                            if (d.sta == 1) {
                                alert(d.msg);
                                sta=0;
//                                window.location.reload();
                            }else{
                                alert(d.msg);
                            }
                        },
                        error: function () {
                            alert('提交失败')
                        }
                    });

                }

            });


        });


    </script>
@stop

