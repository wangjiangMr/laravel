@extends('admin_layouts.master')

{{--添加的css--}}
@section('css')
    <style type="text/css">
        .row{margin-left: 300px;}
        #sub{margin: 20px 20%;width: 100px;}
    </style>
@stop


@section('body')
    <div class="cl-mcont">
    {{--树区--}}
    <div class="page-aside app tree">
        <div class="fixed nano nscroller">
            <div class="content">
                <div class="header">
                    <button class="navbar-toggle" data-target=".treeview" data-toggle="collapse" type="button">
                        <span class="fa fa-chevron-down"></span>
                    </button>
                    <h2 class="page-title">所有菜单</h2>
                    <br/>
                    <p class="description">
                        <a href="{{ url('admin/menu/add') }}">添加>>></a>
                    </p>
                </div>

                <ul class="nav nav-list treeview collapse">

                    @if(!empty($left))
                        @foreach($left as $k=>$v)
                            <li class="open">
                                <label class="tree-toggler nav-header">
                                    <i class="fa fa-folder-o"></i>
                                    {{$v->title}}
                                    <a href="{{ url('admin/form_menu/dele/'.$v->id) }}">删除</a>
                                    <a href="{{ url('admin/menu/edit/'.$v->id) }}">修改</a>
                                </label>
                                @if(isset($v['child']))
                                    <ul class="nav nav-list tree">
                                        @foreach($v['child'] as $item)
                                            <li>
                                                <label class="nav-header">{{$item->title}}<a href="{{ url('admin/form_menu/dele/'.$item->id) }}">删除</a><a href="{{ url('admin/menu/edit/'.$item->id) }}">修改</a></label>
                                            </li>
                                        @endforeach

                                    </ul>

                                @endif
                            </li>
                        @endforeach
                    @endif

                </ul>


            </div>

        </div>
    </div>

    {{--编辑区--}}

    <div class="row">
        <div class="col-md-12">
            <div class="block-flat">
                <div class="header">
                    <h3>添加 & 修改</h3>
                </div>
                <div class="errors">
                    @if(count($errors)>0)
                        <div class="box-body">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-ban"></i>错误：</h4>
                                {{$errors->all()[0]}}
                            </div>

                        </div>
                    @endif
                    @if(isset($tishi))
                        <div class="box-body">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-ban"></i>错误：</h4>
                                {{$tishi}}
                            </div>

                        </div>
                    @endif
                </div>
                <div class="content">
                    <form class="form-horizontal group-border-dashed" method="get" action="{{ url($formuri) }}" style="border-radius: 0px;">
                        {{--{{ method_field('PUT') }}--}}
                        {{--{{csrf_field()}}--}}
                        <div class="form-group">
                            <label class="col-sm-3 control-label">名称</label>
                            <div class="col-sm-6">
                                <input class="form-control" value="{{$formdata['title']}}" name="title" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">链接</label>
                            <div class="col-sm-6">
                                <input class="form-control" id="uri" value="{{$formdata['link']}}" name="link" type="text">

                            </div>
                        </div>

                        @if($formdata['pid'] != 0 || empty($formdata))
                        <div class="form-group">
                            <label class="col-sm-3 control-label">上级</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="pid">
                                    <option value="0" slected="slected">顶级</option>
                                    @if(!empty($left))
                                        @foreach($left as $k=>$v)
                                            <option value="{{$v->id}}">{{$v->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        @endif


                        <div class="form-group">
                            <label class="col-sm-3 control-label">是否顶部显示</label>
                            <div class="col-sm-6">
                                <label class="radio-inline"> <input type="radio"  @if($formdata['is_top'] ==1) checked="checked" @endif  name="is_top" value="1" class="icheck"> 是</label>
                                <label class="radio-inline"> <input type="radio"  @if($formdata['is_top'] ==0) checked="checked" @endif name="is_top" value="0" class="icheck"> 否</label>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">是否隐藏</label>
                            <div class="col-sm-6">
                                <label class="radio-inline"> <input type="radio" @if($formdata['is_show'] ==0 && !empty($formdata['is_show'])) checked="checked" @endif name="is_show" value="0" class="icheck"> 是</label>
                                <label class="radio-inline"> <input type="radio" @if($formdata['is_show'] ==1 || empty($formdata['is_show'])) checked="checked" @endif name="is_show" value="1" class="icheck"> 否</label>


                            </div>
                        </div>
                        <button id="sub" type="submit" class="btn btn-primary">提交</button>
                    </form>
                </div>
            </div>




        </div>
    </div>

</div>

@stop
@section('script')
    <script type="text/javascript">

        $(function(){

            $("#uri").blur(function(){

                var val=$(this).val();
                var url="{{ url('') }}/"+val;
                $(this).val(url);
            });


        });


    </script>
@stop




