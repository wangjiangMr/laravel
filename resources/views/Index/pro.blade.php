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
                        <li class="active">图世界</li>
                    </ol>
                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div> <!-- / .Topic Header -->

        <div class="container">
            <div class="row">
                <!-- Categories -->
                <ul class="project-filter" id="filters">
                    <li><a href="#" data-filter="*">全部</a></li>
                    @foreach($cate as $k=>$v)
                    <li><a href="{{url('pics/'.$v['id'])}}" data-filter="*">{{$v['title']}}</a></li>
                    @endforeach
                </ul>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
        <div class="container">
            <div class="row" id="isotope-container">

                @foreach($pics as $pk=>$pv)
                <div class="col-md-3 isotope-item animation">
                    <div class="portfolio-item">
                        <div class="portfolio-thumbnail">
                            <img class="img-responsive" src="{{$pv['pics']['true_path']}}" alt="...">
                            <div class="mask">
                                <p>
                                    <a href="{{$pv['pics']['true_path']}}" data-lightbox="template_showcase"><i class="fa fa-search fa-2x"></i></a>

                                </p>
                            </div>
                        </div>
                    </div> <!-- / .portfolio-item -->
                </div>
                @endforeach


            </div> <!-- / .row -->


            <div class="pager">
                {{ $pics->links() }}
            </div>

        </div> <!-- / .container -->
    </div> <!-- / .wrapper -->
@stop
