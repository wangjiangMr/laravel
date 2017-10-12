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
                        <li class="active">注册</li>
                    </ol>
                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div> <!-- / .Topic Header -->

        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="sign-form">
                        <div class="sign-inner">
                            <h3 class="first-child">创建用户</h3>
                            <hr>
                            <form role="form" onsubmit="return false" id="form">

                               {{csrf_field()}}
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" id="username" placeholder="用户名" data-toggle="popover" data-placement="left" data-trigger="focus" data-content="Enter your nickname here." data-original-title="Username">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="mail" placeholder="邮箱" data-toggle="popover" data-placement="left" data-trigger="focus" data-content="Enter a valid email here." data-original-title="Email">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control margin-bottom-xs" name="pwd" id="password" placeholder="密码" data-toggle="popover" data-placement="left" data-trigger="focus" data-content="Enter a good password here." data-original-title="Password">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control" name="repwd" id="repeat-password" placeholder="请再次确认密码" data-toggle="popover" data-trigger="focus" data-content="Confirm your password here." data-original-title="Repeat Password">
                                        </div>
                                    </div>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="is_log" type="checkbox">是否自动登录
                                    </label>
                                </div>

                                <button type="submit" class="btn btn-red"> 提 交 </button>
                            </form>
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
                    name:{
                        required: true,
                        minlength: 4,
                        maxlength: 20,
                        remote:{                                          //验证用户名是否存在
                            type:"POST",
                            url:"{{url('reg_val')}}",             //servlet
                            data:{
                                name:function(){return $("#username").val();},
                                _token:'{{ csrf_token() }}'
                            }
                        }
                    },
                    mail: {
                        required: true,
                        minlength: 10,
                        maxlength: 50,
                        email: true,
                        remote:{                                          //验证用户名是否存在
                            type:"POST",
                            url:"{{url('mail_val')}}",             //servlet
                            data:{
                                mail:function(){return $("#email").val();},
                                _token:'{{ csrf_token() }}'
                            }
                        }

                    },
                    pwd: {
                        required: true,
                        minlength: 6,
                        maxlength: 20

                    },
                    repwd: {
                        required: true,
                        minlength: 6,
                        maxlength: 20,
                        equalTo: "#password"

                    }
                },
                messages: {
                    name:{
                        required: "请输入用户名",
                        minlength: "用户名长度不能小于 4 个字母",
                        maxlength: '用户名长度不能太长',
                        remote:'用户名已存在'
                    },
                    mail: {
                        required: "请输入邮箱",
                        minlength: "邮箱长度不能小于 10 个字母",
                        maxlength: '邮箱长度不能太长',
                        remote:'邮箱已被注册'
                    },
                    pwd: {
                        required: "请输入内容",
                        minlength: "密码长度不能小于 6 个字母",
                        maxlength: '密码长度不能超过50个字符'

                    },
                    repwd: {
                        required: "请输入内容",
                        minlength: "密码长度不能小于 6 个字母",
                        maxlength: '密码长度不能超过50个字符',
                        equalTo:'两次密码不同'

                    }
                },
                submitHandler: function()
                {
                    var data = $("#form").serialize();
                    $.ajax({
                        data : data,
                        type : "post",
                        url : "{{url('reg')}}", //图片上传出来的url，返回的是图片上传后的路径，http格式
                        dataType : "json",
                        success: function(d) {
                            alert(d.msg);
                            if(d.sta==1){
                                window.location.href="{{ url('/')}}";
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