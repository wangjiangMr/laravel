@extends('admin_layouts.master')
@section('head_css_js')
    @parent
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/jquery.datatables/bootstrap-adapter/css/datatables.css" />
@stop
@section('foot_css_js')
    @parent
    <script type="text/javascript" src="/js/ntps/admin/jquery.datatables/jquery.datatables.min.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/jquery.datatables/bootstrap-adapter/js/datatables.js"></script>

@stop
@section('body')

    <div class="page-head">
        <h2><a href="{{ url('admin/user') }}">用户列表</a> | <a href="{{url('admin/user_edit')}}">添加用户</a></h2>

    </div>
    <div class="cl-mcont">

        <div class="row">
            <div class="col-md-12">
                <div class="block-flat">

                    <div class="content">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable-icons" >

                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>昵称</th>
                                    <th>真实姓名</th>
                                    <th>邮箱</th>
                                    <th>电话</th>
                                    <th>头像</th>
                                    <th>创建时间</th>
                                    <th>用户状态</th>
                                    <th>是否为管理员账号</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tabledata as $k=>$v)

                                    <tr>

                                        <td>{{$v->uid}}</td>
                                        <td>{{$v->name}}</td>
                                        <td>{{$v->truename}}</td>
                                        <td>{{$v->mail}}</td>
                                        <td>{{$v->mobile}}</td>
                                        <td>
                                            @if(get_pic_path($v->head_img))
                                                <img width="50px" height="50px" src="{{ get_pic_path($v->head_img)}}">
                                            @else
                                                无数据
                                            @endif
                                        </td>
                                        <td>{{ date("Y-m-d H:i",$v->create_at)  }}</td>
                                        <td>

                                            @if($v['status']==0)
                                                禁用
                                            @elseif($v['status']==-1)
                                                已删除
                                            @elseif($v['status']==1)
                                                正常
                                            @endif
                                        </td>
                                        <td>
                                            @if($v['is_admin']==0)
                                                否
                                            @elseif($v['is_admin']==1)
                                                是
                                            @endif
                                        </td>



                                        <td>

                                            <a class="btn btn-primary btn-xs" href="{{url('admin/user_edit/'.$v->uid)}}" >
                                                编辑
                                            </a>

                                            <a class="btn btn-danger btn-xs dele" list_id="{{$v->uid}}" type="dele" data-original-title="Remove" data-toggle="tooltip">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>

@stop
@section('script')
    <script type="text/javascript">

        $(document).ready(function(){
            $('#datatable-icons').DataTable();

            App.init();


            //操作处理
            $(".dele").click(function(){
                var id=$(this).attr('list_id');
                var type=$(this).attr('type');
                var url='{{url("admin/user_handle")}}';
                $.get(url,{id:id,type:type},function(d){
                    d=JSON.parse(d);
                    alert(d.msg);
                    window.location.reload();
                });

            });
        });
    </script>
@stop



