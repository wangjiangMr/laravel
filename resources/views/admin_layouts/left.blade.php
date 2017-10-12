<div class="cl-sidebar" data-position="right" data-step="1" data-intro="<strong>Fixed Sidebar</strong> <br/> It adjust to your needs." >
    <div class="cl-toggle"><i class="fa fa-bars"></i></div>
    <div class="cl-navblock">
        <div class="menu-space">
            <div class="content">
                <div class="side-user">
                    <div class="avatar"><img src="/img/ntps/admin/avatar1_50.jpg" alt="Avatar" /></div>
                    <div class="info">
                        <a href="#">{{session('auth')['name']}}</a>
                        <img src="/img/ntps/admin/state_online.png" alt="Status" /> <span>Online</span>
                    </div>
                </div>
                <ul class="cl-vnavigation">

                    @if(!empty($left))
                        @foreach($left as $k=>$v)
                        <li class="active">
                            <a href="{{$v->link}}">

                                <i class="fa fa-folder-o"></i>
                                <span>{{$v->title}}</span>
                            </a>

                                @if(isset($v['child']))

                                <ul class="sub-menu">

                                    @foreach($v['child'] as $item)

                                <li><a href="{{$item->link}}">{{$item->title}}</a></li>

                                    @endforeach

                                </ul>

                                @endif

                        </li>

                        @endforeach
                    @endif

                </ul>
            </div>
        </div>
        <div class="text-right collapse-button" style="padding:7px 9px;">
            <input type="text" class="form-control search" placeholder="Search..." />
            <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
        </div>
    </div>
</div>