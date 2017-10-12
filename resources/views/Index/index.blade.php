@extends('layouts.master')


@section('body')
    <span id="header_shadow" style="width: 100%; top: 30px;"></span>
    <!-- Wrapper -->
    <div class="wrapper">

        <!-- Home Slider baneer广告 -->
        <div class="home-slider">
            <!-- Carousel -->
            <div id="home-slider" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    @foreach(get_adv_page('index/index','A') as $k=>$v)
                        <li data-target="#home-slider" data-slide-to="{{$k}}" @if($k==0) class="active" @endif></li>
                    @endforeach

                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <!-- Slide #1 -->

                    @foreach(get_adv_page('index/index','A') as $k=>$v)


                        <div class="item @if($k==0) active @endif" id="item-{{$k+1}}" style='background-image: url("{{$v['pics']['true_path']}}");'>

                        </div> <!-- / .item -->
                    @endforeach

                </div>

                <!-- Controls -->
                <a class="carousel-arrow carousel-arrow-prev hidden-xs hidden-sm" href="#home-slider" data-slide="prev">
                    <i class="fa fa-angle-left fa-2x"></i>
                </a>
                <a class="carousel-arrow carousel-arrow-next hidden-xs hidden-sm" href="#home-slider" data-slide="next">
                    <i class="fa fa-angle-right fa-2x"></i>
                </a>
            </div>
        </div> <!-- / .home-slider -->




        <!-- Divider Shadow -->
        <div class="divider-shadow">
            <img src="/img/ntps/divider-shadow1.png" alt="devider" class="responsive-img"/>
        </div>
        <!-- /.Divider Shadow -->

        <!-- Browser Showcase -->
        <div class="browser-showcase">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="first-child text-center"><strong><span class="text-darkblue">{{ $good_point['cate']['title'] }}</span></strong></h1>
                        <h4 class="text-darkblue text-center"> {{ $good_point['cate']['des'] }}  </h4>
                    </div>
                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div> <!-- / .Browser Showcase -->

        <!-- Main Services -->
        <div class="main-services">
            <div class="container">
                <div class="row">

                    @foreach($good_point['art'] as $v)

                        <div class="col-sm-4">
                            <div class="services">
                                <div class="service-item">

                                    <i><img style="width: 70px;height: 70px;border-radius:50%;margin-bottom: 6px;" src="{{ $v['pics']['true_path'] }}" alt=""/></i>
                                    <div class="service-desc">
                                        <h4>{{ $v['title'] }}</h4>
                                        <p>{{ $v['des'] }}</p>
                                    </div>
                                </div>
                            </div> <!-- / .services -->
                        </div>
                    @endforeach

                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div> <!-- / .main-features -->



        <!-- Tag Banner -->
        <div class="responsive-tag-banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="text-center">
                            <img class="img-responsive" src="{{$strong['art'][0]['pics']['true_path']}}" alt="...">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <h2>{{$strong['art'][0]['title']}}! </h2>
                        <p class="lead text-muted">
                            {{$strong['art'][0]['des']}}
                        </p>
                        <ul class="lead text-muted">
                            {!!$strong['art'][0]['content']!!}

                        </ul>
                        {{--<a class="btn btn-lg btn-red" href="#">Learn more info</a> &nbsp;&nbsp;&nbsp;--}}
                        {{--<a class="btn btn-lg btn-darkblue" href="#">Purchase Now!</a>--}}
                    </div>
                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div> <!-- / .Tag Banner -->



        <!-- Services feature1 帮助中心-->
        <div class="services-feature1">
            <div class="container">
                <div class="row">

                    @foreach($foot_nav['help'] as $k=>$v)
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="service-feature1">
                                <a href="{{url('help')}}"><i class="fa fa-desktop"></i></a>
                                <h3>{{$v['title']}}</h3>
                                <div>
                                    <p>
                                        {{$v['des']}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div> <!-- / .Service Feature1 -->




        <!-- Services feature2 -->
        <div class="service-feature2">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-8">
                        <h1>发现美</h1>
                        <h4><em><strong>这里有你想要的一切。。。。。。。。。。。。。。。</strong></em></h4>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <a class="btn btn-lg btn-darkblue pull-right" href="{{URL('pics')}}">我们一起看!</a>
                    </div>
                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div><!-- / .Services feature2 -->

        <!-- Fresh Works1 -->
        <div class="fresh-works1">
            <div class="header text-center">
                <h1><span class="text-red">图片</span> <strong><span class="text-darkblue">展示</span></strong></h1>
                <h4>让我们去发现美、、、、、</h4>
            </div>
            <div class="container_full">
                <br /><br />
                <div id="grid-container" class="cbp-l-grid-fullScreen">
                    <ul>

                        @foreach($pics as $k=>$v)
                            <li class="cbp-item identity logo">
                                <a href="{{$v['pics']['true_path']}}" class="cbp-caption cbp-lightbox" data-title="Corporate">
                                    <div class="cbp-caption-defaultWrap">
                                        <img src="{{reszie_img($v['pics']['true_path'],500,500)}}" alt="" />

                                    </div>
                                    <div class="cbp-caption-activeWrap">
                                        <div class="cbp-l-caption-alignLeft">
                                            <div class="cbp-l-caption-body">
                                                <div class="cbp-l-caption-title">{{$v['title']}}</div>
                                                <div class="cbp-l-caption-desc">{{$v['des']}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </div>
                <div class="cbp-l-loadMore-text">
                    <div data-href="#" class="cbp-l-loadMore-text-link"></div>
                </div>
            </div><!-- / .container full -->
        </div><!-- / .Fresh Works1 -->



        <!-- Responsive Showcase3 -->
        <div class="responsive-showcase3">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <div class="text-center">
                            @foreach(get_adv_page('index/index','B') as $k=>$v)
                                <img class="img-responsive" src="{{$v['pics']['true_path']}}" alt="{{$v['pics']['title']}}">

                            @endforeach

                        </div>
                    </div>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <div class="text-left">
                            <h2> <strong><span class="text-red">{{$news['cate']['title']}}</span></strong></h2>
                            <p>{{$news['cate']['des']}}</p>
                            <br />
                            <div class="col-sm-6">
                                <ul class="list-1">
                                    @foreach($news['art'] as $k=>$v)
                                        @if($k<5)

                                            <li><i class="fa fa-chevron-circle-right"></i> {{$v['title']}}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul class="list-1">
                                    @foreach($news['art'] as $k=>$v)
                                        @if(4<$k && $k<10)

                                            <li><i class="fa fa-chevron-circle-right"></i> {{$v['title']}}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <br /><br />
                        <a href="{{url('article')}}" class="tn btn-lg btn-darkblue">查看更多>>></a>
                    </div>
                </div><!-- / .row -->
            </div><!-- / .container -->
        </div><!-- / .Responsive Showcase3 -->

        <!-- Services Feature5品牌 -->
        <div class="service-feature5">
            <div class="container">
                <div class="row">

                    @foreach($brand as $v)
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <h4 class="white">{{$v['title']}}</h4>
                            <div class="service-feature5-img">
                                <img class="img-responsive" style="width:450px;height: 150px;" src="{{$v['pics']['true_path']}}" />
                            </div>
                            <p>{{$v['brand_des']}}</p>
                        </div>
                    @endforeach

                           <a style="margin-left:100px;position: relative;top:100px;" href="{{url('brand')}}" class="tn btn-lg btn-darkblue">查看更多品牌信息>>></a>

                </div><!-- / .row -->
            </div><!-- / .container -->
        </div><!-- / .Services Feature5 -->

        <!-- Blog Posts -->
        <div class="blog-posts">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="text-center">问答  <span><a href="{{url('question')}}">查看更多>>></a></span></h2>
                    </div>
                </div> <!-- / .row -->
                <div class="row">

                    @foreach($ask as $v)
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="blog">
                                @if(get_user_info($v['uid'])['head_img'])
                                    <img src="{{get_pic_path(get_user_info($v['uid'])['head_img'])}}"  alt="...">
                                    @else
                                    <img src="/img/ntps/head_default.png" alt="{{$v['title']}}">
                                @endif

                                <div class="blog-desc">
                                    <h3>
                                        <a href="blog-post.html">{{$v['title']}}</a>
                                        <a class="btn btn-red" style="float: right;" href="{{url('qus/detail/'.$v['id'])}}">查看详情...</a>
                                    </h3>
                                    <hr>
                                    @if($v['default_asw'])
                                    <p class="text-muted">{{get_user_info(get_defualt_asw($v['default_asw'])['uid'])['name']}}回复：</p>
                                    <p>{{get_defualt_asw($v['default_asw'])['answer']}}</p>
                                        @else
                                        暂无回答
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div> <!-- / .blog posts -->

    </div> <!-- / .wrapper -->
@stop
