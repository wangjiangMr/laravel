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
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;


class AdvController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 首页
     */
    public function index(){

        $tdk=['title'=>'广告管理'];

        //获取left菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);



        $ret=adv::get();






        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'tabledata'=>$ret

        ];
        return view('Admin/adv',$data);
    }



    /**
     * 广告图片列表页
     */
    public function adv_pic($id){



        $tdk=['title'=>'图片列表'];

        //获取left菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);



        $ret=adv_pic::with('pics')->where(['adv_id'=>$id])->get();




        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'tabledata'=>$ret,
            'self_id'=>$id

        ];
        return view('Admin/adv_pic',$data);
    }


    /**
     * 广告编辑
     */
    public function adv_edit($id=null){
        $tdk=['title'=>'添加广告'];

        //获取left菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);


        $ret=adv::where(['id'=>$id])->first();

        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'list'=>$ret

        ];
        return view('Admin/adv_edit',$data);
    }



    /**
     * 广告图片编辑
     */
    public function adv_pic_edit($tid=null,$id=null){
        $tdk=['title'=>'广告管理'];

        //获取left菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);



        $ret=adv_pic::where(['id'=>$id])->first();
        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'list'=>$ret,
            'adv_id'=>$tid

        ];
        return view('Admin/adv_pic_edit',$data);
    }


    /**
     * 广告编辑
     */
    public function adv_handle(){


        if($_REQUEST['type']=='dele'){
            $lis=adv::with('advs')->where(['id'=>$_REQUEST['id']])->first();
            if($lis['advs']) {
                foreach ($lis['aadvs'] as $k => $v) {
                    $pic = Picture::where(['id' => $v['pic_id']])->first();
                    $this->dele_file($v['pic_id'], $pic['true_path']);
                    adv_pic::find($v['id'])->delete();
                }
            }
            $ret=adv::where(['id'=>$_REQUEST['id']])->delete();
        }else{

            $data=[
                'adv_name'=>$_REQUEST['adv_name'],
                'position'=>$_REQUEST['position'],
                'page'=>$_REQUEST['page'],
                'height'=>$_REQUEST['height'],
                'wid'=>$_REQUEST['wid'],
                'extend_file'=>$_REQUEST['extend_file']
            ];
            if(empty($_REQUEST['id'])){
                $ret=adv::insert($data);
            }else{
                $ret=adv::where(['id'=>$_REQUEST['id']])->update($data);

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
    public function adv_pic_handle()
    {


        if ($_REQUEST['type'] == 'dele') {

            //相关文件删除
            $pics = adv_pic::with('pics')->where(['id' => $_REQUEST['id']])->first();

            $this->dele_file($pics['pics']['id'], $pics['pics']['true_path']);


            $ret = adv_pic::where(['id' => $_REQUEST['id']])->delete();
        } else {

            $advinfo=adv::where(['id'=>$_REQUEST['adv_id']])->first();

            $w=$advinfo['wid'];
            $h=$advinfo['height'];

            if (empty($_REQUEST['id'])) {

                //上传图片
                //修改图片尺寸

                $up_ret = $this->upload_file('cover',$w,$h);

                if ($up_ret['status'] == 1) {

                    $data = [
                        'true_path' => $up_ret['info'],
                        'source' => 'admin/edit_art',
                        'create_at' => time(),
                        'type' => '非富文本'
                    ];
                    $picret = Picture::create($data);
                    $picret->save();

                    $adv_pic_data = [
                        'title' => $_REQUEST['title'],
                        'adv_id' => $_REQUEST['adv_id'],
                        'des' => $_REQUEST['des'],
                        'pic_id' => $picret['id'],
                        'create_at' => time(),
                        'link'=>$_REQUEST['link']
                    ];

                    $ret = adv_pic::insert($adv_pic_data);


                } else {
                    echo json_encode(['msg' => $up_ret['info']]);
                    exit;

                }

            } else {

                //修改

                if (empty($_REQUEST['cover'])) {
                    $adv_pic_data = [
                        'title' => $_REQUEST['title'],
                        'adv_id' => $_REQUEST['adv_id'],
                        'des' => $_REQUEST['des'],
                        'link'=>$_REQUEST['link']
                    ];
                } else {


                    //相关yuan文件删除
                    $pics = adv_pic::with('pics')->where(['id' => $_REQUEST['id']])->first();
                    $this->dele_file($pics['pics']['id'], $pics['pics']['true_path']);

                    //上传图片
                    $up_ret = $this->upload_file('cover',$w,$h);

                    if ($up_ret['status'] == 1) {

                        $data = [
                            'true_path' => $up_ret['info'],
                            'source' => 'admin/edit_art',
                            'create_at' => time(),
                            'type' => '非富文本'
                        ];
                        $picret = Picture::create($data);
                        $picret->save();

                        $adv_pic_data = [
                            'title' => $_REQUEST['title'],
                            'adv_id' => $_REQUEST['adv_id'],
                            'des' => $_REQUEST['des'],
                            'pic_id' => $picret['id']
                        ];


                    } else {
                        echo json_encode(['msg' => $up_ret['info']]);
                        exit;

                    }
                }
                $ret = adv_pic::where(['id' => $_REQUEST['id']])->update($adv_pic_data);


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
