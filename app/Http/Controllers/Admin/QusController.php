<?php

namespace App\Http\Controllers\Admin;

use App\Models\adv;
use App\Models\adv_pic;
use App\Models\article;
use App\Models\brand;
use App\Models\cate;
use App\Models\menu;
use App\Models\nav;
use App\Models\Picture;
use App\Models\q_answer;
use App\Models\qus;
use App\Models\user;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;


class QusController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 首页
     */
    public function index(){

        $tdk=['title'=>'问答管理'];

        //获取left菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);



        $ret=qus::get();






        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'tabledata'=>$ret

        ];
        return view('Admin/qus_list',$data);
    }



    /**
     * 问答回复列表
     */
    public function answer_list($id){


        $tdk=['title'=>'问答列表'];

        //获取left菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);

        $ret=q_answer::where(['q_id'=>$id])->get();


        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'tabledata'=>$ret,
            'self_id'=>$id

        ];
        return view('Admin/answer_list',$data);
    }


    /**
     * 广告编辑
     */
    public function qus_edit($id=null){
        $tdk=['title'=>'添加问题'];

        //获取left菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);


        $ret=qus::with('asws')->where(['id'=>$id])->first();


        //获取分类

         $select_cate=$this->get_tree_cate(24);


        //获取用户
        $users=user::where(['is_admin'=>0])->get();

        //

        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'list'=>$ret,
            'cate'=>$select_cate,
            'users'=>$users

        ];
        return view('Admin/qus_edit',$data);
    }





    /**
     * 广告图片编辑
     */
    public function answer_edit($qid=null,$id=null){
        $tdk=['title'=>'问答管理'];

        //获取left菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);



        $ret=q_answer::where(['id'=>$id])->first();



        //获取用户
        $users=user::where(['is_admin'=>0])->get();


        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'list'=>$ret,
            'qus_id'=>$qid,
            'users'=>$users

        ];


        return view('Admin/answer_edit',$data);
    }


    /**
     * 广告编辑
     */
    public function qus_handle(){


        if($_REQUEST['type']=='dele'){
            //删除相关回答
            q_answer::where(['q_id'=>$_REQUEST['id']])->delete();

            $ret=qus::where(['id'=>$_REQUEST['id']])->delete();

        }else{

            if(empty($_REQUEST['id'])){
                $data=[
                    'title'=>$_REQUEST['title'],
                    'qus_des'=>$_REQUEST['qus_des'],
                    'cate_id'=>$_REQUEST['cate_id'],
                    'uid'=>$_REQUEST['uid'],
                    'is_check'=>$_REQUEST['is_check'],
                    'is_show'=>$_REQUEST['is_show']
                ];
                $ret=qus::insert($data);
            }else{
                $data=[
                    'title'=>$_REQUEST['title'],
                    'qus_des'=>$_REQUEST['qus_des'],
                    'cate_id'=>$_REQUEST['cate_id'],
                    'uid'=>$_REQUEST['uid'],
                    'default_asw'=>$_REQUEST['default_asw'],
                    'is_check'=>$_REQUEST['is_check'],
                    'is_show'=>$_REQUEST['is_show']
                ];
                $ret=qus::where(['id'=>$_REQUEST['id']])->update($data);
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





    /**
     * 广告图片编辑
     */
    public function answer_handle()
    {


        if ($_REQUEST['type'] == 'dele') {
            $ret = q_answer::where(['id' => $_REQUEST['id']])->delete();
        } else {

            $data=[
                'uid'=>$_REQUEST['uid'],
                'q_id'=>$_REQUEST['q_id'],
                'answer'=>$_REQUEST['answer'],
                'is_check'=>$_REQUEST['is_check'],
                'is_show'=>$_REQUEST['is_show']
            ];


            if(empty($_REQUEST['id'])){
                $ret=q_answer::insert($data);
            }else{
                $ret=q_answer::where(['id'=>$_REQUEST['id']])->update($data);
            }
        }
        if ($ret) {
            echo json_encode(['msg' => '操作成功']);
            exit;
        } else {
            echo json_encode(['msg' => '操作失败']);
            exit;
        }
    }








}
