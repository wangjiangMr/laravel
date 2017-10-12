<?php

namespace App\Http\Controllers\Admin;

use App\Models\article;
use App\Models\cate;
use App\Models\menu;
use App\Models\nav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class NavigationController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 首页
     */
    public function index(){



        $tdk=['title'=>'导航管理'];

        //获取left菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);



        $ret=nav::get();



        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'tabledata'=>$ret

        ];
        return view('Admin/navigation',$data);
    }



    public function edit_nav($id=null){
        $tdk=['title'=>'导航管理'];

        //获取left菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);

        $ret=null;
        if(!empty($id)){

            $ret=nav::where(['id'=>$id])->first();

        }

        //获取上级
        $parent=nav::where(['pid'=>0])->get();

        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'list'=>$ret,
            'parent'=>$parent
        ];
        return view('Admin/edit_nav',$data);
    }


    /**
     * 导航处理
     */
    public function nav_handle(){

        if(empty($_REQUEST['weight'])){
            $weight=null;
        }else{
            $weight=$_REQUEST['weight'];
        }
        if($_REQUEST['type']=='dele'){
            $ret=nav::find($_REQUEST['id'])->delete();
        }else{

            if($_REQUEST['id']){
                $data=[
                    'title'=>$_REQUEST['title'],
                    'url'=>$_REQUEST['url'],
                    'weight'=>$weight,
                    'pid'=>$_REQUEST['pid'],
                    'is_show'=>$_REQUEST['is_show']
                ];
                $ret=nav::where(['id'=>$_REQUEST['id']])->update($data);
            }else{
//                || empty($_REQUEST['url']
                if(empty($_REQUEST['title'])){
                    echo json_encode(['msg'=>'链接或标题不能为空']);
                    exit;
                }
                $data=[
                    'title'=>$_REQUEST['title'],
                    'url'=>$_REQUEST['url'],
                    'weight'=>$weight,
                    'pid'=>$_REQUEST['pid'],
                    'is_show'=>$_REQUEST['is_show']
                ];
                $ret=nav::insert($data);

            }

        }

        if($ret){
            echo json_encode(['msg'=>'操作成功']);
            exit;
        }else{
            echo json_encode(['msg'=>'操作失败']);
            exit;
        }

    }






}
