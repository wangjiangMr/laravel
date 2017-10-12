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
                        <li class="active">用户中心</li>
                    </ol>
                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div> <!-- / .Topic Header -->

        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="user-avatar text-center">
                        @if($user['pics'])
                            <img id="headimg" class="img-responsive center-block" src="{{$user['pics']['true_path']}}" alt="{{$user['name']}}">
                        @else
                            <img class="img-responsive center-block" src="/img/ntps/head_default.png" alt="{{$user['name']}}">
                        @endif
                        {{$user['name']}}

                    </div>
                    <div class="file-container" style="display:inline-block;position:relative;overflow: hidden;vertical-align:middle">
                        <button class="btn btn-success fileinput-button" style="background-color: #f07057;border-color:#f07057; " type="button">点击修改头像</button>
                        <input type="file" id="jobData" onchange="loadFile(this.files[0])" style="position:absolute;top:0;left:0;font-size:34px; opacity:0">
                    </div>
                    <ul class="user-info">
                        <li>邮箱: <span class="text-muted">{{$user['mail']}}</span></li>
                        <li>电话: <span class="text-muted">@if($user['mobile']){{$user['mobile']}}@else 无数据 @endif </span></li>
                        {{--<li>Last login: <span class="text-muted">2 hours ago</span></li>--}}
                    </ul>

                    <br />
                    <hr />
                    <div class="panel-group" id="help-nav">
                        <div class="panel">

                            <div id="help-nav-one" class="panel-collapse collapse in">
                                <div class="panel-body bg-red">
                                    <ul>
                                        <li><a href="javascript:void(0)"><i class="fa fa-user"></i> 修改个人信息</a></li>
                                        <li><a href="{{url('contact_us')}}"><i class="fa fa-envelope-o"></i> 留言</a></li>
                                        <li><a href="{{url('sign_out')}}"><i class="fa fa-sign-out"></i> 退出</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-sm-9">

                    <div class="col-sm-12">
                        <h1 class="text-muted">
                            修改信息 <span id="error"></span>
                        </h1>
                        <hr>
                    </div>

                    <div class="clearfix"></div>
                    <div>
                        <form id="formone" onsubmit="return false"  role="form">
                            <br/>
                            {{csrf_field()}}
                            <input type="hidden" name="uid" value="{{$user['uid']}}"/>

                            <div class="input-group input-group-lg col-sm-8" style="margin: 0px auto;">
                                <span class="input-group-addon">用户名</span>
                                <input type="text" value="{{$user['name']}}" class="form-control" name="name" placeholder="用户名">
                            </div>

                            <br/>
                            <br/>
                            <div class="input-group input-group-lg col-sm-8" style="margin: 0px auto;">
                                <span class="input-group-addon">真实姓名</span>
                                <input type="text" class="form-control" value="{{$user['truename']}}" name="truename" placeholder="真实姓名">
                            </div>

                            <br/>
                            <br/>
                            <div class="input-group input-group-lg col-sm-8" style="margin: 0px auto;">
                                <span class="input-group-addon">邮箱</span>
                                <input type="text" class="form-control" value="{{$user['mail']}}" name="mail" placeholder="邮箱">
                            </div>

                            <br/>
                            <br/>
                            <div class="input-group input-group-lg col-sm-8" style="margin: 0px auto;">
                                <span class="input-group-addon">电话</span>
                                <input type="text" class="form-control" name="mobile" value="{{$user['mobile']}}" placeholder="电话">
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
            </div> <!-- / .row -->
        </div> <!-- / .container -->

    </div> <!-- / .wrapper -->
@stop
@section('script')
    <script type="text/javascript">
        $().ready(function() {
// 在键盘按下并释放及提交后验证提交表单
            $("#formone").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 4,
                        maxlength: 20
                    },
                    truename: {
                        required: true,
                        minlength: 4,
                        maxlength: 20
                    },
                    mail: {
                        required: true,
                        minlength: 10,
                        maxlength: 50,
                        email: true

                    },
                    mobile: {
                        required: true,
                        minlength: 11,
                        maxlength: 11
                    }
                },
                messages: {
                    name: {
                        required: "请输入用户名",
                        minlength: "用户名长度不能小于 4 个字母",
                        maxlength: '用户名长度不能太长'

                    },
                    truename: {
                        required: "请输入真实姓名",
                        minlength: "用户名长度不能小于 4 个字母",
                        maxlength: '长度不能太长'

                    },
                    mail: {
                        required: "请输入邮箱",
                        minlength: "邮箱长度不能小于 10 个字母",
                        maxlength: '邮箱长度不能太长'

                    },
                    mobile: {
                        required: "请输入内容",
                        minlength: "长度不能小于 11 个长度",
                        maxlength: '长度不能大于 11 个长度'
                    }
                },
                submitHandler: function () {

                    var data = $("#formone").serialize();
                    $.ajax({
                        data: data,
                        type: "post",
                        url: "{{url('user/modify')}}", //图片上传出来的url，返回的是图片上传后的路径，http格式
                        dataType: "json",
                        success: function (d) {
                            if (d.sta == 1) {
                                alert(d.msg);
                                {{--window.location.href = "{{ url('/')}}";--}}
                            }else{
                                alert(d.msg);
                            }
                        },
                        error: function () {
                            alert('登录失败')
                        }
                    });

                }

            });


        });
        var loadFile = function (e) {
            var formData = new FormData();
            formData.append("head_img", e);
            formData.append("_token", "{{csrf_token()}}");
            formData.append("uid", "{{$user['uid']}}");
            $.ajax({
                data: formData,
                type: "post",
                url: "{{url('change_headimg')}}", //图片上传出来的url，返回的是图片上传后的路径，http格式
                /**
                 *必须false才会自动加上正确的Content-Type
                 */
                contentType: false,
                /**
                 * 必须false才会避开jQuery对 formdata 的默认处理
                 * XMLHttpRequest会对 formdata 进行正确的处理
                 */
                processData: false,
                dataType: "json",
                success: function (d) {
                    if (d.sta == 1) {
                        $("#headimg").attr('src', d.msg);
                    } else {
                        alert(d.msg);
                    }
                },
                error: function () {
                    alert('登录失败')
                }
            });
        };

    </script>
@stop
