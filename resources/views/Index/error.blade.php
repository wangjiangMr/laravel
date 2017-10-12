@extends('layouts.master_nohead')


@section('body')
    <!-- Wrapper -->
    <div class="wrapper">

        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-md-offset-3">
                    <div class="error-page text-center">
                        <div class="not-found">

                            @if(session('tishi'))<h3>{{session('tishi')}}</h3>@else<h2> 404 </h2> @endif
                            <a>正在返回上一页。。。<span id="num">3</span></a><br/>
                            <a href="/">首页</a> <span class="divider">|</span> <a href="javascript:history.back(-1)">返回上一页</a>
                        </div>
                    </div>
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->

    </div> <!-- / .wrapper -->
@stop
@section('script')
    <script type="text/javascript">

        $(function(){

            var num=3;
            var t=setInterval(function(){
                num--;
                if(num==0 || num<0){
                    window.history.back();
                    clearTimeout(t);
                }else{
                    $("#num").html(num);
                }

            },1000)

        });

    </script>
@stop
