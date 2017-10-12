<?php

namespace App\Http\Controllers\Admin;
use App\Models\frendlink;
use App\Models\menu;
use App\Models\msg;
use App\Http\Controllers\Controller;
use App\Models\team;


class FrendlinkController extends Controller
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

        $ret=frendlink::get();

        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'tabledata'=>$ret

        ];
        return view('Admin/frendlink_list',$data);
    }



    /**
     * 编辑
     */
    public function frendlink_edit($id=null){
        $tdk=['title'=>'我们的团队'];

        //获取left菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);

        $ret=frendlink::where(['id'=>$id])->first();

        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'list'=>$ret,
        ];

        return view('Admin/frendlink_edit',$data);
    }



    /**
     * 操作
     */
    public function frendlink_handle(){


        if($_REQUEST['type']=='dele'){

            //删除
            $ret=frendlink::where(['id'=>$_REQUEST['id']])->delete();

        }else{


            //修改
            if(!empty($_REQUEST['id'])){
                $data=[
                    'title'=>$_REQUEST['title'],
                    'link'=>$_REQUEST['link'],
                    'is_show'=>$_REQUEST['is_show']
                ];
                $ret=frendlink::where(['id'=>$_REQUEST['id']])->update($data);

            }else{
                $data=[
                    'title'=>$_REQUEST['title'],
                    'link'=>$_REQUEST['link'],
                    'is_show'=>$_REQUEST['is_show'],
                    'create_at'=>time()
                ];
                //添加
                $ret=frendlink::insert($data);
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
