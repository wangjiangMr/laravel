@extends('admin_layouts.master')

@section('head_css_js')
    @parent
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/mansory/htmleaf-demo.css">
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/mansory/style.css">
    <script src="/js/ntps/admin/mansory/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/mansory/mp.mansory.js"></script>
@stop


@section('body')


    <div class="page-head">
        <h2><a href="{{url('admin/picture')}}">上传图片</a> | <a href="{{url('admin/pic')}}">查看全部</a>
            @foreach($cate as $k=>$v)
                | <a href="{{url('admin/pic/'.$v['id'])}}">{{$v['title']}}</a>
            @endforeach
        </h2>

    </div>
    <div class="col-sm-6 col-md-12">
        <div class="" id="my-gallery-container">

            <div class="col-lg-3 col-sm-6 col-xs-12 padding">

                @foreach($lists as $lk=>$lv)

                    @if($lk%4 ==0 )
                        <div class="item" data-order="0">
                            <img src="{{ $lv['pics']['true_path']}}" class="img-responsive"  alt="">
                            <p>{{ $lv['title'] }}</p>
                            <p>
                                <button type="button" list_type="update" list_id="{{ $lv['id'] }}" class="btn btn-primary btn-rad">修改</button>
                                <button type="button" list_type="dele" list_id="{{ $lv['id'] }}" class="btn btn-primary btn-rad">删除</button>
                            </p>
                        </div>
                    @endif



                @endforeach


            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 padding">
                @foreach($lists as $lk=>$lv)

                    @if($lk%4 ==1 )
                        <div class="item" data-order="0">
                            <img src="{{ $lv['pics']['true_path']}}" class="img-responsive"  alt="">
                            <p>{{ $lv['title'] }}</p>
                            <p>
                                <button type="button" list_type="update" list_id="{{ $lv['id'] }}" class="btn btn-primary btn-rad">修改</button>
                                <button type="button" list_type="dele" list_id="{{ $lv['id'] }}" class="btn btn-primary btn-rad">删除</button>
                            </p>
                        </div>

                    @endif



                @endforeach

            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 padding">
                @foreach($lists as $lk=>$lv)

                    @if($lk%4 ==2 )
                        <div class="item" data-order="0">
                            <img src="{{ $lv['pics']['true_path']}}" class="img-responsive"  alt="">
                            <p>{{ $lv['title'] }}</p>
                            <p>
                                <button type="button" list_type="update" list_id="{{ $lv['id'] }}" class="btn btn-primary btn-rad">修改</button>
                                <button type="button" list_type="dele" list_id="{{ $lv['id'] }}" class="btn btn-primary btn-rad">删除</button>
                            </p>
                        </div>

                    @endif



                @endforeach

            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 padding">
                @foreach($lists as $lk=>$lv)

                    @if($lk%4 ==3 )
                        <div class="item" data-order="0">
                            <img src="{{ $lv['pics']['true_path']}}" class="img-responsive"  alt="">
                            <p>{{ $lv['title'] }}</p>
                            <p>
                                <button type="button" list_type="update" list_id="{{ $lv['id'] }}" class="btn btn-primary btn-rad">修改</button>
                                <button type="button" list_type="dele" list_id="{{ $lv['id'] }}" class="btn btn-primary btn-rad">删除</button>
                            </p>
                        </div>

                    @endif



                @endforeach

            </div>


        </div>

        <div style="position: fixed;bottom: 20px;left: 45%;" class="col-md-12">{{ $lists->links()}}</div>



    </div>






@stop


@section('script')

    <script type="text/javascript">
        $(function(){
//            修改和删除
            $(".btn").click(function(){
                var type=$(this).attr('list_type');
                var id=$(this).attr('list_id');
                if(type=='update'){
                    window.location.href="{{url('admin/picture')}}/"+id;
                }
                var url='{{url('admin/pic/handle')}}';

                $.get(url,{type:type,id:id},function(d){
                    alert(JSON.parse(d).info);
                    setTimeout(function(){
                        window.location.reload();
                    },1000);
                })
            });


            $("#my-gallery-container").mpmansory(
                    {
                        childrenClass: 'item', // default is a div
                        columnClasses: 'padding', //add classes to items
                        breakpoints:{
                            lg: 3,
                            md: 4,
                            sm: 6,
                            xs: 12
                        },
                        distributeBy: { order: false, height: false, attr: 'data-order', attrOrder: 'asc' }, //default distribute by order, options => order: true/false, height: true/false, attr => 'data-order', attrOrder=> 'asc'/'desc'
                        onload: function (items) {

                        }
                    }
            );





        });
    </script>
@stop




