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
                        <li class="active">帮助中心</li>
                    </ol>
                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div> <!-- / .Topic Header -->

        <div class="help-center">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <!-- Search 搜索-->
                        <form role="form" method="get" action="{{url('help_search')}}" >
                            <div class="well">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <input type="text" name="keyword" class="form-control" placeholder="Search Question">
                      <span class="input-group-btn">
                        <button class="btn btn-danger" type="button"><i class="fa fa-search"></i></button>
                      </span>
                                        </div><!-- /input-group -->
                                    </div><!-- /.col-lg-6 -->
                                </div><!-- /.row -->
                            </div>
                        </form>

                        <!-- Categories -->
                        <div class="panel-group" id="help-nav">

                            @foreach($foot_nav['help'] as $k=>$v)
                                <div class="panel">
                                    <div class="panel-heading bg-darkblue">
                                        <a data-toggle="collapse" data-parent="#help-nav" href="#help-nav-{{$k}}">
                                            {{$v['title']}}
                                        </a>
                                    </div>
                                    @if(!empty($v['art']['art'][0]))
                                        <div id="help-nav-{{$k}}" class="panel-collapse collapse in">
                                            <div class="panel-body bg-red">
                                                <ul>

                                                    @foreach($v['art']['art'] as $ak=>$av)
                                                        <li><a href="{{url('help/'.$av['id'])}}" class="art">{{$av['title']}}</a></li>
                                                    @endforeach

                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach


                        </div>
                    </div>



                    <div class="col-sm-8">
                        <h3><span>搜索列表</span></h3>
                        <ol class="help-questions">
                            @foreach($arts as $k=>$v)
                            <li><a href="{{url('help/'.$v['id'])}}">{{$v['title']}}</a></li>
                            @endforeach
                            @if(empty($arts))暂无数据@endif
                        </ol>
                        <!-- Paggination -->
                        {{ $arts->appends(['keyword' => $keyword])->links() }}
                        <div class="clearfix"></div>
                    </div>
                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div> <!-- / .Help Center -->

    </div> <!-- / .wrapper -->
@stop
