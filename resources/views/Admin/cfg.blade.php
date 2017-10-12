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
        <h2><a href="{{ url('admin/cfg') }}">配置列表</a> | <a href="{{url('admin/cfg_edit')}}">添加配置</a></h2>

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
                                    <th>名称</th>
                                    <th>标题</th>
                                    <th>key</th>
                                    <th>value</th>
                                    <th>图片</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tabledata as $k=>$v)
                                <tr>

                                    <td>{{$v->id}}</td>
                                    <td>{{$v->name}}</td>
                                    <td>
                                        @if($v->title)
                                            {{$v->title}}
                                        @else
                                            无数据
                                        @endif
                                    </td>
                                    <td>{{$v->key}}</td>
                                    <td>
                                        @if($v->value)
                                            {{$v->value}}
                                        @else
                                            无数据
                                        @endif
                                    </td>
                                    <td>
                                        @if(get_pic_path($v->pic_id))
                                            <img width="100px" height="100px" src="{{ get_pic_path($v->pic_id)}}">
                                        @else
                                            无数据
                                        @endif
                                    </td>
                                    <td>{{ date("Y-m-d H:i",$v->create_at)  }}</td>

                                    <td>

                                        <a class="btn btn-primary btn-xs" href="{{url('admin/cfg_edit/'.$v->id)}}" >
                                            编辑
                                        </a>

                                        <a class="btn btn-danger btn-xs dele" list_id="{{$v->id}}" type="dele" data-original-title="Remove" data-toggle="tooltip">
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
                var url='{{url("admin/cfg_handle")}}';
                $.get(url,{id:id,type:type},function(d){
                    d=JSON.parse(d);
                    alert(d.msg);
                    window.location.reload();
                });

            });
        });
    </script>
@stop



