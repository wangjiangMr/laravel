<!-- Navigation -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><img src="{{get_cfg_item('logo',true)}}"></a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">

                {{--导航--}}
                @foreach($nav as $nk=>$nv)

                    <li class="dropdown">

                        @if(count($nv['child'])!=0)
                            <a href="{{$nv['url']}}" class="dropdown-toggle" data-toggle="dropdown">{{ $nv['title'] }} <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                @foreach($nv['child'] as $ck=>$cv)
                                    <li><a href="{{$cv['url']}}">{{$cv['title']}}</a></li>
                                @endforeach

                            </ul>
                        @else
                            <a href="{{$nv['url']}}">{{ $nv['title'] }}</a>
                        @endif
                    </li>
                @endforeach

                @if(session('user'))
                    <li>
                        <a href="javascript:void(0)">欢迎您，{{session('user')['name']}}</a>
                    </li>
                    <li>
                        <a href="{{url('sign_out')}}">退出登录</a>
                    </li>
                  @else
                    <li>
                        <a href="{{url('sign_in')}}">登录</a>
                    </li>

                    <li>
                        <a href="{{url('sign_up')}}">注册</a>
                    </li>
                @endif



            </ul>
            <!-- Mobile Search -->
            {{--<form class="navbar-form navbar-right visible-xs" role="search">--}}
            {{--<div class="input-group">--}}
            {{--<input type="text" class="form-control" placeholder="Search">--}}
            {{--<span class="input-group-btn">--}}
            {{--<button class="btn btn-danger" type="button">Search!</button>--}}
            {{--</span>--}}
            {{--</div>--}}
            {{--</form>--}}
        </div>
        <!--/.nav-collapse -->
    </div>
</div>
<!--/.navigation -->