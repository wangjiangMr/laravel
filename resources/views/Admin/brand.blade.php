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
        <h2><a href="{{ url('admin/brand') }}">品牌列表</a> | <a href="{{url('admin/edit_brand')}}">添加品牌</a></h2>

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
                                    <th>标题</th>
                                    <th>封面</th>
                                    <th>分类</th>
                                    <th>描述</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tabledata as $k=>$v)
                                <tr>

                                    <td>{{$v->id}}</td>
                                    <td>{{$v->title}}</td>

                                    <td>
                                        @if(get_pic_path($v->cover_id))
                                            <img width="100px" height="100px" src="{{ get_pic_path($v->cover_id)}}">
                                        @else
                                            无数据
                                        @endif
                                    </td>
                                    <td>{{get_cate_name($v->cate_id)}}</td>
                                    <td>{{$v->brand_des}}</td>


                                    <td>{{ date("Y-m-d H:i",$v->create_at)  }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-xs" href="{{url('admin/edit_brand',['id'=>$v['id']])}}"  data-original-title="Edit" data-toggle="tooltip">
                                            <i class="fa fa-pencil"></i>
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
                var url='{{url("admin/brand_handle")}}';
                $.get(url,{id:id,type:type},function(d){
                    d=JSON.parse(d);
                    alert(d.msg);
                    window.location.reload();
                });

            });
        });
    </script>
@stop



