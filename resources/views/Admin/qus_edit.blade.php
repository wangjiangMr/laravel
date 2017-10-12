@extends('admin_layouts.master')

@section('body')



    <div class="page-head">
        <h2><a href="{{ url('admin/qus_list') }}">问题列表</a> | <a href="{{url('admin/qus_edit')}}">添加问题</a></h2>

    </div>
    <div class="cl-mcont">
        <div class="col-sm-6 col-md-12">
            <div class="block-flat">
                <div class="content">

                    <form  enctype="multipart/form-data" role="form" onsubmit="return false"  id="form" class="form-horizontal">
                        {{csrf_field()}}

                        <input type="hidden" name="id" value="{{$list['id']}}"/>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">问题名称</label>
                            <div class="col-sm-8">
                                <input required="" name="title"  value="{{$list['title']}}" class="form-control"><ul class="parsley-errors-list" id="parsley-id-0525"></ul>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">描述</label>
                            <div class="col-sm-8">
                                <textarea required=""  name="qus_des"  class="form-control" rows="3">{{$list['qus_des']}}</textarea><ul class="parsley-errors-list" id="parsley-id-0525"></ul>
                            </div>
                        </div>




                            <div class="form-group">
                                <label class="col-sm-3 control-label">分类</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="cate_id">
                                        @foreach($cate as $k=>$v)
                                            <option value="{{$v->id}}" @if($list['cate_id']==$v['id']) selected="selected" @endif>{{$v->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>




                        @if($list['asws'])
                        <div class="form-group">
                            <label class="col-sm-3 control-label">默认推荐回答</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="default_asw">

                                    @if(count($list['asws'])==0)
                                            <option value="0" >暂无回复</option>
                                        @else
                                        @foreach($list['asws'] as $k=>$v)
                                            <option value="{{$v->id}}" @if($list['default_asw']==$v['id']) selected="selected" @endif>{{$v->answer}}</option>
                                        @endforeach
                                    @endif

                                </select>
                                <ul class="parsley-errors-list" id="parsley-id-0525"></ul>
                            </div>
                        </div>
                        @endif


                        <div class="form-group">
                            <label class="col-sm-3 control-label">提问用户</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="uid">
                                    @foreach($users as $uk=>$uv)
                                        <option value="{{$uv->uid}}" @if($list['uid']==$uv['uid']) selected="selected" @endif>{{$uv->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>




                            <div class="form-group">
                                <label class="col-sm-3 control-label">审核状态</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="is_check" autocomplete="off">
                                        <option value="0" @if($list['is_check']==0) selected="selected" @endif >未审核</option>
                                        <option value="1" @if($list['is_check']==1) selected="selected" @endif >审核通过</option>
                                        <option value="-1" @if($list['is_check']==-1) selected="selected" @endif >审核未通过</option>
                                    </select>
                                </div>
                            </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label">是否显示</label>
                            <div class="col-sm-6">
                                <label class="radio-inline"> <input type="radio" @if($list['is_show']==1) checked="checked" @endif name="is_show" value="1" class="icheck"> 是</label>
                                <label class="radio-inline"> <input type="radio" @if($list['is_show']===0) checked="checked" @endif   name="is_show" value="0" class="icheck"> 否</label>


                            </div>
                        </div>




                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button id='bttn' type="submit" class="col-md-1 btn btn-primary" style="margin: 50px 10%;width: 200px;">提交</button>
                            </div>
                        </div>


                    </form>

                </div>
            </div>
        </div>

    </div>


@stop



@section('script')
    <script type="text/javascript">

        $(document).ready(function(){
            //initialize the javascript
            App.init();
            $("#bttn").on('click',function(){
                var fd = new FormData(document.querySelector("#form"));
                var url='{{url('admin/qus_handle')}}';
                fd.append('type','');

                $.ajax({
                    data : fd,
                    type : "post",
                    url : url, //图片上传出来的url，返回的是图片上传后的路径，http格式
                    cache : false,
                    contentType : false,
                    processData : false,
                    dataType : "json",
                    success: function(d) {

                        alert(d.msg);
                        window.location.href="{{url('admin/qus_list')}}";

                    },
                    error:function(){
                        alert('操作失败')
                    }
                });


            });









        });


    </script>
@stop



