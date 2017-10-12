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
use App\Models\team;
use App\Models\user;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;


class TeamController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 首页
     */
    public function index(){

        $tdk=['title'=>'我们的团队'];

        //获取left菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);



        $ret=team::with('head')->get();




        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'tabledata'=>$ret

        ];
        return view('Admin/team_list',$data);
    }




    /**
     * 编辑
     */
    public function team_edit($id=null){
        $tdk=['title'=>'我们的团队'];

        //获取left菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);

        $ret=team::where(['id'=>$id])->first();


        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'list'=>$ret,
        ];


        return view('Admin/team_edit',$data);
    }


    /**
     * 操作
     */
    public function team_handle(){


        if($_REQUEST['type']=='dele'){
            //删除头像
            $team=team::with('head')->where(['id'=>$_REQUEST['id']])->first();
            if(!empty($team['head'])){
                $this->dele_file($team['head']['id'],$team['head']['true_path']);
                Picture::find($team['head']['id'])->delete();
            }

            //删除
            $ret=team::where(['id'=>$_REQUEST['id']])->delete();


        }else{


            if(!empty($_REQUEST['head_img'])){

                $path=$this->upload_file('head_img',200,200)['info'];
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




            if(empty($_REQUEST['id'])){
                $data=[
                    'name'=>$_REQUEST['name'],
                    'job_name'=>$_REQUEST['job_name'],
                    'des'=>$_REQUEST['des'],
                    'head_img'=>$head_img,
                    'create_at'=>time()
                ];
                $ret=team::insert($data);
            }else{
                //删除原图
                    $user=team::with('head')->where(['id'=>$_REQUEST['id']])->first();
                    if(!empty($user['head'])){
                        $this->dele_file($user['head']['id'],public_path($user['head']['true_path']));
                    }

                //baocun
                if(empty($_REQUEST['head_img'])){
                    $data=[
                        'name'=>$_REQUEST['name'],
                        'job_name'=>$_REQUEST['job_name'],
                        'des'=>$_REQUEST['des']
                    ];
                }else{
                    $data=[
                        'name'=>$_REQUEST['name'],
                        'job_name'=>$_REQUEST['job_name'],
                        'des'=>$_REQUEST['des'],
                        'head_img'=>$head_img
                    ];
                }

                $ret=team::where(['id'=>$_REQUEST['id']])->update($data);
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
