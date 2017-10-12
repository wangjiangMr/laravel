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
                        <li class="active">联系我们</li>
                    </ol>
                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div> <!-- / .Topic Header -->

        <div class="container">
            <div class="row">

                <div class="col-sm-8">
                    <h1 class="first-child"><span class="text-red">留言</span>板板</h1>
                    <p>您有什么都可以给我们留言哦，不管什么问题，记住。。。不管什么问题！当然，回不回答，全看心情。。。。。</p>
                    <form role="form" id="form" enctype="multipart/form-data" onsubmit="return false">
                        {{csrf_field()}}
                        <input type="hidden" name="time" value="{{ time() }}"/>
                        <div class="form-group">
                            <label for="name">姓名</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name">
                        </div>
                        <div class="form-group">
                            <label for="email">邮箱</label>
                            <input type="email" class="form-control" name="mail" id="email" placeholder="Enter Your Mail">
                        </div>
                        <div class="form-group">
                            <label for="message">内容</label>
                            <textarea class="form-control" rows="3" name="cont" id="message" placeholder="Message"></textarea>
                        </div>

                        <p>
                            <input class="btn btn-lg btn-red" type="submit" value="提交">
                        </p>


                    </form>
                </div>

                <div class="col-sm-4">
                    <h1 class="second-child">其他 <span class="text-red">方式</span></h1>
                    <p>
                        周末不上班，请在工作日投递和电话联系<br />
                        Phone:{{get_cfg_item('phone')}}<br />
                        Email: {{get_cfg_item('mail')}}
                    </p>

                    <div class="maps">
                        <div id="google-maps" class="map"></div>
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
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 20
                    },
                    mail: {
                        required: true,
                        minlength: 10,
                        maxlength: 50,
                        email: true
                    },
                    cont: {
                        required: true,
                        minlength: 10,
                        maxlength: 255
                    }
                },
                messages: {
                    name: {
                        required: "请输入名称",
                        minlength: "姓名长度不能小于 3 个字母",
                        maxlength: '姓名长度不能太长'

                    },
                    mail: {
                        required: "请输入邮箱",
                        minlength: "邮箱长度不能小于 10 个字母",
                        maxlength: '邮箱长度不能太长'
                    },
                    cont: {
                        required: "请输入内容",
                        minlength: "内容长度不能小于 10 个字母",
                        maxlength: '内容长度不能超过250个字符'
                    }
                },
                submitHandler: function()
                {
                    var fd = new FormData(document.querySelector("#form"));
                    $.ajax({
                        data : fd,
                        type : "post",
                        url : "{{url('contact_handle')}}", //图片上传出来的url，返回的是图片上传后的路径，http格式
                        cache : false,
                        contentType : false,
                        processData : false,
                        dataType : "json",
                        success: function(d) {
                            if(d.status==1){

                                alert(d.info);
                                window.location.href="{{url('/')}}";
                            }else{
                                alert('提交失败');
                            }

                        },
                        error:function(){
                            alert('添加失败')
                        }
                    });

                }

            })
        });
    </script>
@stop
