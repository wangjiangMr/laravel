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


class UserController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 首页
     */
    public function index(){

        $tdk=['title'=>'用户管理'];

        //获取left菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);



        $ret=user::get();






        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'tabledata'=>$ret

        ];
        return view('Admin/user_list',$data);
    }




    /**
     * 广告图片编辑
     */
    public function user_edit($id=null){
        $tdk=['title'=>'用户管理'];

        //获取left菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);

        $ret=user::where(['uid'=>$id])->first();


        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'list'=>$ret,
        ];


        return view('Admin/user_edit',$data);
    }


    /**
     * 广告编辑
     */
    public function user_handle(){


        if($_REQUEST['type']=='dele'){


            //删除
            $ret=user::where(['uid'=>$_REQUEST['uid']])->update(['status'=>-1]);


        }else{


            if(!empty($_REQUEST['head_img'])){

                $path=$this->upload_file('head_img')['info'];
                $data=[
                    'true_path'=>$path,
                    'source'=>'admin/edit_brand',
                    'create_at'=>time(),
                    'type'=>'非富文本'
                ];
                $picret=Picture::create($data);
                $picret->save();
                $head_img=$picret['id'];

            }




            if(empty($_REQUEST['uid'])){
                $data=[
                    'name'=>$_REQUEST['name'],
                    'truename'=>$_REQUEST['truename'],
                    'mail'=>$_REQUEST['mail'],
                    'mobile'=>$_REQUEST['mobile'],
                    'is_admin'=>$_REQUEST['is_admin'],
                    'status'=>$_REQUEST['status'],
                    'head_img'=>$head_img
                ];
                $ret=user::insert($data);
            }else{
                //删除原图
                $user=user::with('pics')->where(['uid'=>$_REQUEST['uid']])->first();
                if(!empty($user['pics'])){
                    $this->dele_file($user['pics']['id'],public_path($user['pics']['true_path']));
                }

                //baocun
                $data=[
                    'name'=>$_REQUEST['name'],
                    'truename'=>$_REQUEST['truename'],
                    'mail'=>$_REQUEST['mail'],
                    'mobile'=>$_REQUEST['mobile'],
                    'is_admin'=>$_REQUEST['is_admin'],
                    'status'=>$_REQUEST['status'],
                    'head_img'=>$head_img
                ];
                $ret=user::where(['uid'=>$_REQUEST['uid']])->update($data);
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
