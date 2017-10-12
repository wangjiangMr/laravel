@extends('admin_layouts.master')

@section('body')




    <div class="page-head">
        <h2><a href="{{ url('admin/frendlink') }}">列表</a> | <a href="{{url('admin/frendlink_edit')}}">添加链接</a></h2>

    </div>
    <div class="cl-mcont">
        <div class="col-sm-6 col-md-12">
            <div class="block-flat">
                <div class="content">

                    <form  enctype="multipart/form-data" role="form" onsubmit="return false"  id="form" class="form-horizontal">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$list['id']}}"/>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">名称</label>
                            <div class="col-sm-8">
                                <input required="" name="title"  value="{{$list['title']}}" class="form-control"><ul class="parsley-errors-list" id="parsley-id-0525"></ul>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">链接</label>
                            <div class="col-sm-8">
                                <input required="" name="link"  value="{{$list['link']}}" class="form-control"><ul class="parsley-errors-list" id="parsley-id-0525"></ul>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-3 control-label">是否显示</label>
                            <div class="col-sm-6">
                                <label class="radio-inline"> <input type="radio"  @if($list['is_show'] ==1) checked="checked" @endif  name="is_show" value="1" class="icheck"> 是</label>
                                <label class="radio-inline"> <input type="radio"  @if($list['is_show'] ==0) checked="checked" @endif name="is_show" value="0" class="icheck"> 否</label>

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
                var url='{{url('admin/frendlink_handle')}}';
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
                        window.location.href="{{url('admin/frendlink')}}";

                    },
                    error:function(){
                        alert('操作失败')
                    }
                });


            });




        });


    </script>
@stop



