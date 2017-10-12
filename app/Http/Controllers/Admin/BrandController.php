<?php

namespace App\Http\Controllers\Admin;

use App\Models\article;
use App\Models\brand;
use App\Models\cate;
use App\Models\menu;
use App\Models\nav;
use App\Models\Picture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class brandController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 首页
     */
    public function index(){



        $tdk=['title'=>'品牌管理'];

        //获取left菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);



        $ret=brand::get();




        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'tabledata'=>$ret

        ];
        return view('Admin/brand',$data);
    }



    public function edit_brand($id=null){
        $tdk=['title'=>'添加品牌'];

        //获取left菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);

        $ret=null;
        if(!empty($id)){

            $ret=brand::where(['id'=>$id])->first();

        }

        //获取分类
        $cate_tree=$this->get_tree_cate(30);

        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'list'=>$ret,
            'cate'=>$cate_tree

        ];
        return view('Admin/edit_brand',$data);
    }


    /**
     * 操作
     */
    public function brand_handle(){

        if($_REQUEST['type']=='dele'){
            //删除原纪录
            $brand=brand::with('pics')->find($_REQUEST['id']);
            if(!empty($brand['pics']['true_path']) && file_exists(public_path($brand['pics']['true_path']))){
                unlink(public_path($brand['pics']['true_path']));
                Picture::find($brand['pics']['id'])->delete();
            }

            $ret=brand::find($_REQUEST['id'])->delete();
        }else{

            if($_REQUEST['id']){
                if(empty($_REQUEST['title']) || empty($_REQUEST['cover'])){
                    echo json_encode(['msg'=>'标题或封面不能为空']);
                    exit;
                }
                $info=$this->upload_file('cover',450,150)['info'];
                $data=[
                    'true_path'=>$info,
                    'source'=>'admin/edit_brand',
                    'create_at'=>time(),
                    'type'=>'非富文本'
                ];
                $picret=Picture::create($data);
                $picret->save();

                $data=[
                    'title'=>$_REQUEST['title'],
                    'cover_id'=>$picret['id'],
                    'brand_des'=>$_REQUEST['des'],
                    'cate_id'=>$_REQUEST['cate_id']
                ];
                $ret=brand::where(['id'=>$_REQUEST['id']])->update($data);
            }else{
                if(empty($_REQUEST['title']) || empty($_REQUEST['cover'])){
                    echo json_encode(['msg'=>'标题或封面不能为空']);
                    exit;
                }
                $info=$this->upload_file('cover',450,150)['info'];
                $data=[
                    'true_path'=>$info,
                    'source'=>'admin/edit_brand',
                    'create_at'=>time(),
                    'type'=>'非富文本'
                ];
                $picret=Picture::create($data);
                $picret->save();

                //删除原纪录
                $brand=brand::with('pics')->find($_REQUEST['id']);
                if(!empty($brand['pics']['true_path']) && file_exists(public_path($brand['pics']['true_path']))){
                    unlink(public_path($brand['pics']['true_path']));
                    Picture::find($brand['pics']['id'])->delete();
                }

                $data=[
                    'title'=>$_REQUEST['title'],
                    'cover_id'=>$picret['id'],
                    'brand_des'=>$_REQUEST['des'],
                    'create_at'=>time(),
                    'cate_id'=>$_REQUEST['cate_id']

                ];
                $ret=brand::insert($data);

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
