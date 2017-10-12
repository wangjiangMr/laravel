<?php

namespace App\Http\Controllers\Admin;

use App\Models\cate;
use App\Models\menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CateController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 首页
     */
    public function index(){
        $tdk=['title'=>'分类管理'];

        //获取left菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);


        $top_cate=cate::where(['pid'=>0])->get();
        $cate_tree=$this->get_tree_cate($top_cate);



        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'cate_tree'=>$cate_tree

        ];
        return view('Admin/cate',$data);
    }


    /**
     * 树形数据
     */
    public function get_tree_cate($map){

        foreach($map as $k=>$v){
            $chd=cate::where(['pid'=>$v['id']])->get();
            if(!empty($chd)){
                $v['child']=$chd;
                $this->get_tree_cate($v['child']);

            }else{
                continue;
            }
        }

        return $map;

    }


    /**
     * 分类操作
     */
    public function cate_handle(){

        //删除
        if($_GET['type']=='dele') {
            $ret = cate::find($_GET['id'])->delete();

        }
        //修改
        if($_GET['type']=='update'){
            $data=[
                'title'=>$_GET['title'],
                'pid'=>$_GET['pid'],
                'des'=>$_GET['des']
            ];
            $ret=cate::where(['id'=>$_GET['id']])->update($data);
        }
        //添加
        if($_GET['type']=='insert'){

            $has=cate::where(['title'=>$_GET['title']])->first();
            if($has){
                $msg=['msg'=>'标题已存在！','code'=>0];
                echo json_encode($msg);
                exit;
            }
            $data=[
                'title'=>$_GET['title'],
                'pid'=>$_GET['pid'],
                'des'=>$_GET['des']
            ];

            $ret=cate::insert($data);

        }
        //返回
        if($ret){
            $msg=['msg'=>'操作成功！','code'=>1];
            echo json_encode($msg);
            exit;
        }else{
            $msg=['msg'=>'操作失败！','code'=>0];
            echo json_encode($msg);
            exit;
        }

    }



}
