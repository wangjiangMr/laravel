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
                        <li class="active">问答</li>
                    </ol>
                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div> <!-- / .Topic Header -->

        <div class="container">
            <div class="row">

                <div class="col-sm-12">


                    <!-- Filters 分类-->
                    <ul class="nav nav-tabs nav-justified">
                        <li @if(empty($cateid)) class="active" @endif><a  href="{{ url('question')}}" >全部</a></li>
                        @foreach($cate as $k=>$v)
                            <li @if($cateid==$v['id']) class="active" @endif><a href="{{url('question/'.$v['id'])}}" >{{$v['title']}}</a></li>
                        @endforeach
                    </ul>

                    <div class="row">
                        <div class="tab-content">
                            @foreach($qus as $k=>$v)
                                <!-- Promo-->
                                <div class="tab-pane fade in active" id="promo">
                                    <div class="col-sm-12">
                                        <div class="shop-product">

                                            @if(get_pic_path(get_user_info($v['uid'])['head_img']))
                                                <img style="height: 50px;width: 50px;border-radius: 50px;line-height: 50px;text-align: center;float: left;margin: 0 10px 0 0;" src="{{get_pic_path(get_user_info($v['uid'])['head_img'])}}">
                                                @else
                                                <img style="height: 50px;width: 50px;border-radius: 50px;line-height: 50px;text-align: center;float: left;margin: 0 10px 0 0;" src="/img/ntps/head_default.png">
                                                @endif
                                            <div>
                                                <a href="{{url('qus/detail/'.$v['id'])}}" style="float: left;"><h5 class="primary-font">问题：<a href="{{url('qus/detail/'.$v['id'])}}">{{$v['title']}}</a></h5></a>
                                            </div>
                                            <div class="clearfix"></div>

                                            <p class="text-muted">
                                                @if($v['default_asw']!=0)
                                                {{get_user_info(get_defualt_asw($v['default_asw'])['uid'])['name']}} : {{get_defualt_asw($v['default_asw'])['answer']}}
                                                    @else
                                                    暂无回复
                                                @endif
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                            @if(count($qus)==0) 无数据 @endif

                        </div> <!-- /.tab-content -->
                    </div> <!-- / .row -->

                    <!-- Pagination分页 -->

                    <div class="pager">
                        {{ $qus->links() }}
                    </div>
                    <!-- / .row -->

                </div> <!-- / .col-sm-8 -->
            </div> <!-- / .row -->
        </div> <!-- / .container -->

    </div> <!-- / .wrapper -->
@stop

