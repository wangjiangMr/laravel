<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\article;
use App\Models\brand;
use App\Models\cate;
use App\Models\menu;
use App\Models\Picture;
use App\Models\shows;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


/**
 * Class PictureController
 * @package App\Http\Controllers\Admin
 * 图片相关
 */
class ArticleController extends Controller
{





    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 文章管理首页
     */
    public function index(){
        //tdk
        $tdk=['title'=>'文章管理'];

        //获取left菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);

        $ret=article::get();
        $tabledata=$ret;


        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'tabledata'=>$tabledata

        ];
        return view('Admin/article',$data);
    }






    public function edit_art($id=null){
        $tdk=['title'=>'添加/修改文章'];
        //获取left菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);
        //获取top菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);
        $art=null;
        if($id){

            $art=article::with('pics')->find($id);

        }

        //获取品牌
        $brand=brand::get();


        //获取分类
        $cate_tree=$this->get_tree_cate(23);



        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'art'=>$art,
            'brand'=>$brand,
            'cate'=>$cate_tree


        ];

        return view('Admin/edit_art',$data) ;

    }






    /**
     * 富文本图片上传
     */
    public function text_pic(){

        $msg=$this->upload_file('file');

        $data=[
            'true_path'=>$msg['info'],
            'source'=>'admin/edit_art',
            'create_at'=>time(),
            'type'=>'富文本'
        ];
        if($msg['status']==1){
            Picture::create($data)->save();
            echo json_encode(['msg'=>$msg['info']]);
            exit;
        }else{

            echo json_encode(['msg'=>$msg['info']]);
            exit;
        }


    }




    /**
     * 添加文章操作
     */
    public function add_art(){

        //验证
        $this->validate($this->requests,
            [
                'title'=>'required|max:100',
                'des'=>'required|max:100',
                'keywords'=>'max:255',
            ],[
                '标题不合法',
                '描述不能为空',
                '关键字长度太长'
            ]);

        if(empty($_REQUEST['file'])){
            if(empty($_REQUEST['cover'])){
                $picret['id']='';
            }else{
                //图片保存
                $msg=$this->upload_file('cover');
                if($msg['status']!=1){
                    echo json_encode(['msg'=>'封面上传错误']);
                    exit;
                }

                $data=[
                    'true_path'=>$msg['info'],
                    'source'=>'admin/edit_art',
                    'create_at'=>time(),
                    'type'=>'非富文本'
                ];
                $picret=Picture::create($data);
                $picret->save();
            }

        }else{
            $picret['id']=$_REQUEST['file'];
        }

        if(!empty($_REQUEST['id']) && empty($_REQUEST['file'])){
            //删除原纪录
            $art=article::with('pics')->find($_REQUEST['id']);

            if(!empty($art['pics']['true_path']) && file_exists(public_path($art['pics']['true_path']))){
                unlink(public_path($art['pics']['true_path']));
                Picture::find($art['pics']['id'])->delete();
            }

        }

        //文章保存
        if(empty($_POST['brand_id'])){
            $_POST['brand_id']=null;
        }
        if(empty($picret['id'])){
            $picret['id']=null;
        }
        if(empty($_POST['cate_id'])){
            $_POST['cate_id']=null;
        }

        $art=array();
        $art['cover_id']=$picret['id'];
        $art['title']=$_POST['title'];
        $art['des']=$_POST['des'];
        $art['content']=$_POST['content'];
        $art['brand_id']=$_POST['brand_id'];
        $art['cate_id']=$_POST['cate_id'];
        $art['keywords']=$_POST['keywords'];
        $art['create_at']=time();

        if(!empty($_REQUEST['id'])){
            $ret=article::where(['id'=>$_REQUEST['id']])->update($art);
        }
        else{
            $art=article::create($art);
            $ret=$art->save();
        }

        if($ret){
            echo json_encode(['msg'=>'操作成功']);
            exit;

        }


    }


    /**
     * 文章删除
     */
    public function dele_art(){
//        获取相关信息
        $art=article::find($_GET['id']);
        $pic=Picture::find($art['cover_id']);

//        删除文件
        if(!empty($pic['true_path']) && file_exists(public_path($pic['true_path']))){
            unlink(public_path($pic['true_path']));
            Picture::find($art['cover_id'])->delete();
        }

//        删除记录
        $art_de=article::find($_GET['id'])->delete();

        if($art_de){
            echo json_encode(['msg'=>'删除成功']);
            exit;
        }else{
            echo json_encode(['msg'=>'删除失败']);
            exit;
        }

    }







}