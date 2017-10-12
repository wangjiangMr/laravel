@extends('admin_layouts.master_nohead')


@section('body')
    <div id="cl-wrapper" class="login-container">

        <div class="middle-login">
            <div class="block-flat">
                <div class="header">
                    <h3 class="text-center"><img class="logo-img" src="images/logo.png" alt="logo"/>欢迎登录</h3>
                </div>
                <div>

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
                    </div>

                    <form style="margin-bottom: 0px !important;" method="post" class="form-horizontal" action="/backpage/login">
                        {{ method_field('PUT') }}
                        <?php echo csrf_field(); ?>
                        <div class="content">
                            <h4 class="title">请输入</h4>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" placeholder="Username" name="username" id="username" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input type="password" placeholder="Password" name="pwd" id="password" class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="foot">
                            <button class="btn btn-primary" data-dismiss="modal" type="submit">登录</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center out-links"><a href="#">&copy; 2017 say yes</a></div>
        </div>

    </div>
@stop
