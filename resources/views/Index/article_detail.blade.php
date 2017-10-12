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
                        <li><a href="{{url('article')}}">新闻资讯</a></li>
                        <li class="active">{{$art['title']}}</li>
                    </ol>
                </div> <!-- / .row -->
            </div> <!-- / .container -->
        </div> <!-- / .Topic Header -->

        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <!-- Blog Post #1 -->
                    <div class="blog">

                        <div class="blog-desc">
                            <h3>
                                <a>{{$art['title']}}</a>
                            </h3>
                            <hr>
                            <p class="text-muted">创作时间：{{date('Y-m-d',$art['create_at'])}}</p>
                            <img class="img-responsive" src="{{$art['pics']['true_path']}}" alt="...">
                            <p>
                                {!!$art['content']!!}
                            </p>
                        </div>
                    </div>

                    <!-- Pagination -->
                    {{--<ul class="pager pull-right">--}}
                    {{--<li><a href="#">Previous</a></li>--}}
                    {{--<li><a href="#">Next</a></li>--}}
                    {{--</ul>--}}
                    <div class="clearfix"></div>

                    <div class="comments">
                        <!-- New comment form -->
                        <div class="row">
                            <div class="cmt">
                                {{--<img src="/img/ntps/avatar.jpg" alt="...">--}}
                                <div class="cmt-block">
                                    <strong>发表评论</strong>
                                    <form role="form" class="cmt-body" enctype="multipart/form-data" id="form">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="art_id" value="{{$art['id']}}"/>
                                        <div class="form-group">
                                            <textarea class="form-control" name="ct" rows="3" placeholder="请输入"></textarea>
                                        </div>
                                        <a href="javascript:void(0)" onclick="comment(this)" type="submit" class="btn btn-red">提交</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- List of comments -->
                        <h4 class="text-right">{{count($comment)}}条评论</h4>
                        <hr>

                        @foreach($comment as $k=>$v)
                            <div class="cmt">
                                @if(get_user_info($v['user']['uid'])['head_img'])
                                    <img src="{{get_pic_path(get_user_info($v['user']['uid'])['head_img'])}}" alt="{{$v['user']['name']}}">
                                   @else
                                    <img src="/img/ntps/head_default.png" alt="{{$v['user']['name']}}">
                                @endif

                                <div class="cmt-block">
                                    <a href="#" class="profile-link">{{$v['user']['name']}}</a>
                                    <span class="text-muted time">{{date('Y-m-d',$v['create_at'])}}</span>
                  <span class="rating pull-right">
                    <span class="up">{{$v['praise']}}</span>
                    <i class="fa fa-thumbs-up" onclick="upvote(this)" m_id="{{$v['id']}}"></i>
                      <i class="fa fa-thumbs-down" onclick="downvote(this)" m_id="{{$v['id']}}"></i>
                    <span class="down">{{$v['tread']}}</span>
                  </span>
                                    <p class="cmt-body">
                                        {{$v['content']}}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                        @if(count($comment)==0)还没有评论，期待你的评论。。。@endif
                    </div>
                </div>
                <div class="col-sm-3">
                    <!-- Search -->
                    <form role="form" method="get" action="{{url('art/search')}}">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="Search">
                      <span class="input-group-btn">
                        <button class="btn btn-danger" type="submit"><i class="fa fa-search"></i></button>
                      </span>
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->
                    </form><br /><br />
                    <div class="panel-heading">
                        <strong>分类</strong>
                    </div>
                    <div class="panel">
                        <div class="panel-body bg-darkblue">
                            <ul>

                                @foreach($art_cate as $k=>$v)

                                    <li><a href="{{url('article/'.$v['id'])}}">{{$v['title']}}</a></li>

                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->

    </div> <!-- / .wrapper -->
@stop
@section('script')
    <script type="text/javascript">

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
