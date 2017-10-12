@extends('admin_layouts.master')

@section('body')

    <div class="page-head">
        <h2><a href="{{ url('admin/navigation') }}">导航列表</a> | <a href="{{url('admin/edit_nav')}}">添加导航</a></h2>

    </div>
    <div class="cl-mcont">
        <div class="col-sm-6 col-md-12">
            <div class="block-flat">
                <div class="content">

                    <form  enctype="multipart/form-data" role="form" onsubmit="return false"  id="form" class="form-horizontal">
                        {{csrf_field()}}

                        <input type="hidden" name="id" value="{{$list['id']}}"/>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">标题</label>
                            <div class="col-sm-8">
                                <input required="" name="title"  value="{{$list['title']}}" class="form-control"><ul class="parsley-errors-list" id="parsley-id-0525"></ul>
                            </div>
                        </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label">上级</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="pid">
                                        @if(!empty($parent))
                                            <option value="0">顶级</option>
                                            @foreach($parent as $k=>$v)
                                                <option @if($list['pid']==$v['id']) selected="selected" @endif value="{{$v->id}}">{{$v->title}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>



                        <div class="form-group">
                            <label class="col-sm-3 control-label">链接</label>
                            <div class="col-sm-8">
                                <input required="" name="url"  value="{{$list['url']}}" class="form-control"><ul class="parsley-errors-list" id="parsley-id-0525"></ul>
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-sm-3 control-label">排序</label>
                            <div class="col-sm-8">
                                <input required="" name="weight"  value="{{$list['weight']}}" class="form-control"><ul class="parsley-errors-list" id="parsley-id-0525"></ul>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">是否显示</label>
                            <div class="col-sm-6">
                                <label class="radio-inline"> <input type="radio" @if($list['is_show']==1 || empty($list)) checked="checked" @endif name="is_show" value="1" class="icheck"> 是</label>
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
                var url='{{url('admin/nav_handle')}}';
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
                        if(d.msg=='操作成功'){
                            window.location.href="{{url('admin/navigation')}}";
                        }else{
                            alert(d.msg);
                        }



                    },
                    error:function(){
                        alert('添加失败')
                    }
                });


            });

        });


    </script>
@stop



