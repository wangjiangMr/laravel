@extends('admin_layouts.master')

@section('body')



    <div class="page-head">
        <h2><a href="{{url('admin/answer_list/'.$qus_id)}}">回复列表</a> | <a href="#">添加回复</a></h2>

    </div>
    <div class="cl-mcont">
        <div class="col-sm-6 col-md-12">
            <div class="block-flat">
                <div class="content">

                    <form  enctype="multipart/form-data" role="form" onsubmit="return false"  id="form" class="form-horizontal">
                        {{csrf_field()}}


                        <input type="hidden" name="id" value="{{ $list['id'] }}"/>
                        <input type="hidden" name="q_id" value="{{ $qus_id }}"/>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">回复用户名</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="uid">
                                    @foreach($users as $uk=>$uv)
                                        <option value="{{$uv->uid}}" @if($list['uid']==$uv['uid']) selected="selected" @endif>{{$uv->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-sm-3 control-label">回复内容</label>
                            <div class="col-sm-8">
                                <textarea required=""  name="answer"  class="form-control" rows="6">{{$list['answer']}}</textarea><ul class="parsley-errors-list" id="parsley-id-0525"></ul>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label">审核状态</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="is_check" autocomplete="off">
                                    <option value="1" @if($list['is_check']== 1) selected="selected" @endif >审核通过</option>
                                    <option value="-1" @if($list['is_check']== -1) selected="selected" @endif >审核未通过</option>
                                    <option value="0" @if($list['is_check']== 0) selected="selected" @endif >未审核</option>

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
//            App.init();
            $("#bttn").on('click',function(){
                var fd = new FormData(document.querySelector("#form"));
                var url='{{url('admin/answer_handle')}}';
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
                        window.location.href="{{url('admin/answer_list/'.$qus_id)}}";

                    },
                    error:function(){
                        alert('操作失败')
                    }
                });


            });





        });


    </script>
@stop



