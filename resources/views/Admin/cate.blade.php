@extends('admin_layouts.master')
@section('head_css_js')
    <!-- Bootstrap core CSS -->
    <link href="/js/ntps/admin//bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://www.jq22.com/jquery/bootstrap-3.3.4.css">
    <link rel="stylesheet" type="text/css" href="http://www.jq22.com/jquery/font-awesome.4.6.0.css">
    <link rel="stylesheet" href="/css/ntps/admin/pygments.css">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>

    <![endif]-->



    <script type="text/javascript">
        FileAPI = {
            debug: true
        };
    </script>



    {{-- CSS files --}}
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>


    <!-- DateRange -->
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/bootstrap.daterangepicker/daterangepicker-bs3.css"/>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/jquery.gritter/css/jquery.gritter.css" />

    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/jquery.nanoscroller/nanoscroller.css" />
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/jquery.easypiechart/jquery.easy-pie-chart.css" />
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/bootstrap.switch/bootstrap-switch.css" />
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/jquery.select2/select2.css" />
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/bootstrap.slider/css/slider.css" />
    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/intro.js/introjs.css" />
    <script type="text/javascript" src="/js/ntps/admin/bootstrap.daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="/js/ntps/admin/bootstrap.daterangepicker/daterangepicker.js"></script>
    <!-- Custom styles for this template -->
    <link href="/js/ntps/admin/jquery.icheck/skins/square/blue.css" rel="stylesheet">
    <link href="/css/ntps/admin/style.css" rel="stylesheet" />
    <!--图标样式-->

    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/tree/css/bootstrap.min.css" />

    <!--主要样式-->

    <link rel="stylesheet" type="text/css" href="/js/ntps/admin/tree/css/style.css" />



@stop

@section('body')

    <div class="page-head">
        <h2>分类管理</h2>
    </div>
    <div class="col-sm-6 col-md-12">
        <div class="block-flat">

            <div class="tree well" style="width: 45%;min-height: 700px;" id="tree"></div>
            <div class="well" style="width: 45%;min-height: 700px;z-index:99;position: fixed;right: 50px;bottom: 0px;">
                <form class="form-horizontal group-border-dashed" id="form" onsubmit="return false" style="border-radius: 0px;">

                    <input type="hidden" name="id"/>

                    <div class="form-group" style="margin-top: 10%">
                        <label class="col-sm-3 control-label">名称</label>
                        <div class="col-sm-6">
                            <input type="text" name="title" style="height:35px;" value="" class="form-control">
                        </div>
                    </div>


                    <div class="form-group" style="margin-top: 10%">
                        <label class="col-sm-3 control-label">描述</label>
                        <div class="col-sm-6">
                            <textarea name="des" required="" class="form-control textarea" rows="3"></textarea>
                        </div>
                    </div>



                    <div class="form-group" style="margin-top: 10%">
                        <label class="col-sm-3 control-label">上级</label>
                        <div class="col-sm-6">
                            <select id="select" name="pid" class="form-control"></select>
                        </div>
                    </div>


                    <button class="btn btn-primary" style="margin:20% 30%;width: 150px;" type="submit"> 提 交 </button>
            </form>
        </div>
    </div>
    </div>
@stop



@section('script')
    <script type="text/javascript">
        $(function(){
            App.init();

            var show_tree=function(trees){

                var str="<ul>";

                for(var x in trees){

                    var chd=trees[x].child;
                    if(trees[x]['pid']==0){
                        str+="<li><span><i class='icon-folder-open'></i>"+trees[x].title+"</span> <a class='dele' l_id='"+trees[x].id+"'>删除</a> <a class='update' pid='"+trees[x].pid+"'l_des='"+trees[x].des+"' l_title='"+trees[x].title+"' l_id='"+trees[x].id+"'>修改</a></li>";
                    }else if(chd.length<=0){
                        str+="<li><span><i class='icon-leaf'></i>"+trees[x].title+"</span> <a class='dele' l_id='"+trees[x].id+"'>删除</a> <a class='update' pid='"+trees[x].pid+"' l_title='"+trees[x].title+"' l_id='"+trees[x].id+"'>修改</a></li>";
                    }else{
                        str+="<li><span><i class='icon-minus-sign'></i>"+trees[x].title+"</span> <a class='dele' l_id='"+trees[x].id+"'>删除</a> <a class='update' pid='"+trees[x].pid+"' l_title='"+trees[x].title+"' l_id='"+trees[x].id+"'>修改</a></li>";
                    }


                    if(chd.length>0){
                        str+=show_tree(trees[x].child);
                    }
                }

                str+="</ul>";
                return str;
            };
            var tree='{!! $cate_tree !!}';
            tree=JSON.parse(tree);

            var show=show_tree(tree);
            $("#tree").html(show);

            $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
            $('.tree li.parent_li > span').on('click', function (e) {
                var children = $(this).parent('li.parent_li').find(' > ul > li');
                if (children.is(":visible")) {
                    children.hide('fast');
                    $(this).attr('title', 'Expand this branch').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
                } else {
                    children.show('fast');
                    $(this).attr('title', 'Collapse this branch').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
                }
                e.stopPropagation();
            });



            //下拉列表展示


            var before='';
            var show_list=function(trees){
                var str="";
                for(var x in trees){
                    var chd=trees[x].child;
                     str+=before+"<option value='"+trees[x].id+"'>"+before+trees[x].title+"</option>";
                    if(chd.length>0){
                        before+='---';
                        str+=show_list(trees[x].child);
                    }
                    if(x==(trees.length-1)){
                        before=-'---';
                        if(before='NaN'){
                            before='---';
                        }
                    }
                    if(trees[x].pid==0){
                        before='';
                    }
                }

                return str;
            };

            var list_str=show_list(tree);

            $("#select").html("<option value='0'>顶级菜单</option>"+list_str);




            //删除方法
            $('.dele').click(function(){
                var id=$(this).attr('l_id');
                var url='{{url("admin/cate_handle")}}';
                var type='dele';
                $.get(url,{id:id,type:type},function(d){
                    var msg=JSON.parse(d);
                      alert(msg.msg);
                    window.location.reload();
                });
            });

            //修改
            $('.update').click(function(){
                var id=$(this).attr('l_id');
                var title=$(this).attr('l_title');
                var des=$(this).attr('l_des');

                if(des=='null' || des=='undefined'){
                    des='';
                }



               $("input[name=id]").val(id);
               $("input[name=title]").val(title);

               $(".textarea").val(des);

            });



            //提交
            $(".btn").click(function(){
                var title=$("input[name=title]").val();
                var id=$("input[name=id]").val();
                var pid=$("#select").val();
                var des=$(".textarea").val();

                var url='{{url("admin/cate_handle")}}';
                if(title=='' || pid==''){
                    alert('请完整输入');
                    return;
                }
                if(pid==id){
                    alert('不能选择自身为上级');
                    return;
                }
                var type='insert';
                if(id!=''){
                     type='update';
                }


                $.get(url,{id:id,title:title,pid:pid,des:des,type:type},function(d){
                    var msg=JSON.parse(d);
                    $("input[name=id]").val('');
                    $("input[name=title]").val('');
                    $(".textarea").text('');
                    alert(msg.msg);
                    window.location.reload();
                });
            });


        });


    </script>
@stop



