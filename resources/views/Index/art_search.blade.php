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
                        <li><a href="{{url('article')}}">新闻资讯</a></li>
                        <li class="active">新闻资讯</li>
                    </ol>
                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div> <!-- / .Topic Header -->

        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <!-- Blog Post #1 -->

                    @foreach($arts as $k=>$v)
                    <div class="blog">

                        <div class="blog-desc">
                            <h3>
                                <a href="{{url('art/detail/'.$v['id'])}}">{{$v['title']}}</a>
                            </h3>
                            <hr>
                            <p class="text-muted">{{date('Y-m-d',$v['create_at'])}}</p>
                            <a href="{{url('art/detail/'.$v['id'])}}"><img class="img-responsive" src="{{$v['pics']['true_path']}}" alt="..."></a>
                            <p>
                               {!!mb_substr($v['content'],0,40,'utf-8')!!}<a href="{{url('art/detail/'.$v['id'])}}"><em>详情...</em></a>
                            </p>
                        </div>
                    </div>
                    @endforeach


                    <!-- Pagination -->
                        {{ $arts->appends(['keyword' => $keyword])->links() }}

                    <div class="clearfix"></div>
                </div>
                <div class="col-sm-3">
                    <!-- Search -->
                    <form role="form">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search">
                      <span class="input-group-btn">
                        <button class="btn btn-danger" type="button"><i class="fa fa-search"></i></button>
                      </span>
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->
                    </form><br /><br />
                    <!-- Categories -->
                    <div class="panel-heading">
                        <strong>分类</strong>
                    </div>
                    <div class="panel">
                        <div class="panel-body bg-darkblue">
                            <ul>

                                @foreach($art_cate as $k=>$v)

                                <li><a href="{{url('article/'.$v['id'])}}">{{$v['title']}}</a></li>

                                @endforeach

                            </ul>
                        </div>
                    </div>

                    </div>
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->

    </div> <!-- / .wrapper -->

@stop
