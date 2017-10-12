@extends('layouts.master')


@section('body')

    <span id="header_shadow" style="width: 100%; top: 30px;"></span>

    <!-- Wrapper -->
    <div class="wrapper" style=" background-image: url('/img/ntps/timg.jpg');background-repeat: no-repeat;background-size: 100% 100%;background-position: 0px 50px;">

        <!-- Topic Header -->
        <div class="topic">
            <div class="container">
                <div class="row">
                    <ol class="breadcrumb hidden-xs">
                        <li><a href="/">首页</a></li>
                        <li class="active">{{$art['title']}}</li>
                    </ol>
                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div> <!-- / .Topic Header -->

        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Blog Post #1 -->
                    <div class="blog">
                        <div class="blog-desc">
                            <h3 style="text-align: center;">
                                <a>{{$art['title']}}</a>
                            </h3>
                            <hr>
                            <p class="text-muted">创作时间：{{date('Y-m-d',$art['create_at'])}}</p>
                            <p id="ct" style="background-image:url('/img/ntps/back.png');padding:80px;background-repeat: no-repeat;background-color: #FFFFFF;background-size:100%;border-radius: 20px;"></p>
                        </div>
                    </div>
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </div> <!-- / .wrapper -->
@stop
@section('script')
    <script type="text/javascript">
        var ct='{!! $art["content"] !!}';
        $("#ct").html(ct);

        var comment=function(){
            var data=$("#form").serialize();
            $.ajax({
                data : data,
                type : "post",
                url : "{{url('add_comment')}}",
                dataType : "json",
                success: function(d) {
                    alert(d.msg);
                    if(d.sta==1){
                        window.location.reload();
                    }
                }
            });
        };

        status=1;
        var upvote=function(e){
            if(status==0){
                return;
            }
            var m_id=$(e).attr('m_id');
            var type='inc';
            var url='{{url("change_vote")}}';
            var token="{{ csrf_token() }}";

            $.ajax({
                data : {'id':m_id,'type':type,'_token':token},
                type : "post",
                url : url,
                dataType : "json",
                success: function() {
                    status=0;
                    var num=parseInt($(e).prev().text());
                    $(e).prev().text(num+1);
                }
            });
        };


        var downvote=function(e) {
            if (status == 0) {
                return;
            }
            var m_id = $(e).attr('m_id');
            var type = 'dec';
            var url = '{{url("change_vote")}}';
            var token = "{{ csrf_token() }}";

            $.ajax({
                data: {id: m_id, type: type, _token: token},
                type: "post",
                url: url,
                dataType: "json",
                success: function () {
                    status = 0;

                    var num = parseInt($(e).next().text());

                    $(e).next().text(num+1);
                }
            });
        }

    </script>
@stop
