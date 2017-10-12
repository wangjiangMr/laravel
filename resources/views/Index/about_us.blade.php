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
              <li class="active">关于我们</li>
            </ol>
          </div> <!-- / .row -->
        </div> <!-- / .container -->
      </div> <!-- / .Topic Header -->



	  <div class="about">
      <div class="container">
        <div class="row">
          <div class="col-sm-7">
            <h1 class="first-child"><span>关于 <span class="text-red">我们</span></span></h1>
            <p>
			  {!!$about['content']!!}
            </p>

          </div>
          <div class="col-sm-5">
            <div id="portfolio-slideshow" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                  @foreach(get_adv_page('about_us','A') as $k=>$v)
                      <li data-target="#carousel-example-generic" data-slide-to="0" @if($k==0)class="active" @endif></li>
                  @endforeach
               
              </ol>
              <!-- Wrapper for slides -->
              <div class="carousel-inner">
                  @if(get_adv_page('about_us','A'))
                      @foreach(get_adv_page('about_us','A') as $k=>$v)

                          <div class="item @if($k==0)active @endif">
                              <img src="{{$v['pics']['true_path']}}" class="img-responsive" alt="...">
                          </div>
                      @endforeach
                  @else
                      缺少广告
                  @endif

              </div>
              <!-- Controls -->
              <a class="carousel-arrow carousel-arrow-prev" href="#portfolio-slideshow" data-slide="prev">
                <i class="fa fa-angle-left"></i>
              </a>
              <a class="carousel-arrow carousel-arrow-next" href="#portfolio-slideshow" data-slide="next">
                <i class="fa fa-angle-right"></i>
              </a>
            </div>
          </div>
        </div> <!-- / .row -->
	  </div> <!-- / .container -->
	  </div> <!-- / .About -->

	  <div class="clearfix divider-dashed1"></div>

	  <div class="team">
	  <div class="container">
        <div class="row our-team-p">
          <div class="col-sm-12">
            <h1 class="text-left">Our <span class="text-red">Team</span></h1>
            <div class="row">


                @foreach($team as $tk=>$tv)
              <div class="col-xs-12 col-sm-3 col-md-3">
                <div class="team-member text-center">
                  <img class="img-responsive center-block" src="{{$tv['head']['true_path']}}" alt="...">
                  <div class="info">
                    <h3><strong>{{$tv['name']}}</strong></h3>
                    <p class="text-muted">{{$tv['job_name']}}</p>
					<p>{{$tv['des']}}</p>
					{{--<ul class="list-inline text-muted">--}}
					  {{--<li><a href="#"><i class="fa fa-facebook"></i></a></li>--}}
					  {{--<li><a href="#"><i class="fa fa-linkedin"></i></a></li>--}}
					  {{--<li><a href="#"><i class="fa fa-google-plus"></i></a></li>--}}
					  {{--<li><a href="#"><i class="fa fa-skype"></i></a></li>--}}
					{{--</ul>--}}
                  </div>
                </div>
              </div>

                @endforeach


            </div> <!-- / .row -->
          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
	  </div> <!-- / .Team -->

	  <!-- Services Feature8 -->
	  <div class="service-feature8">
	    <div class="container">
	      <div class="row">

			<div class="col-xs-12 col-sm-12 col-md-12">
			  <h1>我们能为您 做什么?</h1>

			  <p>
                  {!!$doforyou['content']!!}
              </p>
			</div>



		  </div> <!-- / .row -->
        </div> <!-- / .container -->
	  </div><!-- / .Services Feature8 -->

	  <!-- Clients -->
	  <div class="clients">
	    <div class="container">
	      <div class="row">

			  <div class="col-sm-12">
				<h1>入驻<span class="text-red">品牌</span></h1>
			  </div>

			  <div class="col-sm-12">
				<ul class="bxslider">
                    @foreach($brand as $k=>$v)

					<li><img src="{{$v['pics']['true_path']}}" style="width: 300px;height: 100px;" /></li>

                    @endforeach

				</ul>
			  </div>

		   </div> <!-- / .row -->
        </div> <!-- / .container -->
	  </div><!-- / .Clients -->


    </div> <!-- / .wrapper -->

@stop
