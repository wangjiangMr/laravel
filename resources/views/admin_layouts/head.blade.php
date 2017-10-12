<!-- Fixed navbar -->
<div id="head-nav" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="fa fa-gear"></span>
            </button>
            <a class="navbar-brand" href="#"><span>造作港</span></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">

                @if(!empty($top))
                    @foreach($top as $k=>$v)


                        @if(isset($v['child']))
                            <li class="dropdown">
                            <a href="{{$v->link}}" class="dropdown-toggle" data-toggle="dropdown">{{$v->title}} <b class="caret"></b></a>
                            <ul class="dropdown-menu">

                                @foreach($v['child'] as $item)

                                <li><a href="{{$item->link}}">{{$item->title}}</a></li>

                                @endforeach


                            </ul>
                            </li>
                        @else
                            <li class="dropdown"><a href="{{$v->link}}">{{$v->title}}</a></li>
                        @endif
                    @endforeach
                @endif



            </ul>
            <ul class="nav navbar-nav navbar-right user-nav">
                <li class="dropdown profile_menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img alt="Avatar" src="/img/ntps/admin//avatar2.jpg" /><span>{{session('auth')['name']}}</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        {{--<li><a href="#">My Account</a></li>--}}
                        {{--<li class="divider"></li>--}}
                        <li><a href="/admin/login_out">Sign Out</a></li>
                    </ul>
                </li>
            </ul>


        </div><!--/.nav-collapse animate-collapse -->
    </div>
</div>