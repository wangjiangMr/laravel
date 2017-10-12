<?php

namespace App\Http\Controllers\Admin;
use App\Models\menu;
use App\Models\msg;
use App\Models\Picture;
use App\Models\team;
use App\Http\Controllers\Controller;



class MsgController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 首页
     */
    public function index(){

        $tdk=['title'=>'留言管理'];

        //获取left菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);

        $ret=msg::get();

        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'tabledata'=>$ret

        ];
        return view('Admin/msg_list',$data);
    }




    /**
     * 操作
     */
    public function msg_handle(){


        if($_REQUEST['type']=='dele'){

            //删除
            $ret=msg::where(['id'=>$_REQUEST['id']])->delete();

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
