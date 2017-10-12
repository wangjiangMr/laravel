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
                        <li class="active">品牌列表</li>
                    </ol>
                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div> <!-- / .Topic Header -->

        <div class="container">
            <div class="row">
                <!-- Categories -->
                <ul class="project-filter" id="filters">
                    <li><a href="{{url('brand')}}" data-filter="*">全部</a></li>
                    @foreach($cate as $k=>$v)
                    <li><a href="{{url('brand/'.$v['id'])}}" data-filter="*">{{$v['title']}}</a></li>
                    @endforeach
                </ul>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
        <div class="container">
            <div class="row" id="isotope-container">

                @foreach($brands as $bk=>$bv)
                <div class="col-md-3 isotope-item animation">
                    <div class="portfolio-item">
                        <div class="portfolio-thumbnail">
                            <h4 class="white" style="text-align: center;">{{$bv['title']}}</h4>
                            <img class="img-responsive" style="width: 450px;height: 150px;" src="{{$bv['pics']['true_path']}}" alt="{{$bv['title']}}">
                            <p style="text-align: center;">{{$bv['brand_des']}}</p>
                        </div>
                    </div> <!-- / .portfolio-item -->
                </div>
                @endforeach
            </div> <!-- / .row -->


            <div class="pager">
                {{ $brands->links() }}
            </div>

        </div> <!-- / .container -->
    </div> <!-- / .wrapper -->
@stop
