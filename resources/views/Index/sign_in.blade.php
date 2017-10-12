@extends('layouts.master')


@section('body')
    <style>
        .error{color: indianred;}
    </style>
    <span id="header_shadow" style="width: 100%; top: 30px;"></span>

    <!-- Wrapper -->
    <div class="wrapper">

        <!-- Topic Header -->
        <div class="topic">
            <div class="container">
                <div class="row">
                    <ol class="breadcrumb hidden-xs">
                        <li><a href="/">首页</a></li>
                        <li class="active">登录</li>
                    </ol>
                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div> <!-- / .Topic Header -->

        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="sign-form">
                        <div class="sign-inner">
                            <h3 class="first-child">登 录</h3>
                            <hr>
                            <form role="form" onsubmit="return false" id="form">
                                {{csrf_field()}}
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="email" class="form-control" name="mail" id="email" placeholder="请输入邮箱地址" data-original-title="" title="">
                                </div>
                                <br />
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" class="form-control" name="pwd" id="password" placeholder="密码" data-original-title="" title="">
                                </div>
                                {{--<div class="checkbox">--}}
                                    {{--<label>--}}
                                        {{--<input type="checkbox"> Remember me--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                                <br/>
                                <br/>
                                <button type="submit" class="btn btn-red"> 登 录</button>
                                <hr>
                            </form>
                            <p>还没注册? <a href="{{url('sign_up')}}">去注册.</a></p>

                            {{--找回密码--}}
                            {{--<div class="pwd-lost">--}}
                                {{--<div class="pwd-lost-q show">Lost your password? <a href="#">Click here to recover.</a></div>--}}
                                {{--<div class="pwd-lost-f hidden">--}}
                                    {{--<p class="text-muted">Enter your email address below and we will send you a link to reset your password.</p>--}}
                                    {{--<form class="form-inline" role="form">--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="col-xs-8">--}}
                                                {{--<div class="input-group">--}}
                                                    {{--<label class="sr-only" for="email-pwd">Email address</label>--}}
                                                    {{--<input type="email" class="form-control" id="email-pwd" placeholder="Enter your email">--}}
							{{--<span class="input-group-btn">--}}
							  {{--<button type="submit" class="btn btn-danger">Send</button>--}}
							{{--</span>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</form>--}}
                                {{--</div>--}}
                            {{--</div> <!-- / .pwd-lost -->--}}


                        </div>
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
            $("#form").validate({
                rules: {
                    mail: {
                        required: true,
                        minlength: 10,
                        maxlength: 50,
                        email: true
                    },
                    pwd: {
                        required: true,
                        minlength: 6,
                        maxlength: 50

                    }
                },
                messages: {

                    mail: {
                        required: "请输入邮箱",
                        minlength: "邮箱长度不能小于 10 个字母",
                        maxlength: '邮箱长度不能太长'

                    },
                    pwd: {
                        required: "请输入内容",
                        minlength: "密码长度不能小于 6 个字母",
                        maxlength: '密码长度不能超过50个字符'
                    }
                },
                submitHandler: function()
                {

                    var data = $("#form").serialize();
                    $.ajax({
                        data : data,
                        type : "post",
                        url : "{{url('user_log')}}", //图片上传出来的url，返回的是图片上传后的路径，http格式
                        dataType : "json",
                        success: function(d) {

                            if(d.sta==1){
                                window.location.href="{{ url('/')}}";
                            }else{
                                alert(d.msg);
                            }

                        },
                        error:function(){
                            alert('登录失败')
                        }
                    });

                }

            })
        });
    </script>
    @stop