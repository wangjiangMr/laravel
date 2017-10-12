<?php

namespace App\Http\Controllers\Admin;

use App\Models\adv;
use App\Models\adv_pic;
use App\Models\article;
use App\Models\brand;
use App\Models\cate;
use App\Models\cfg;
use App\Models\menu;
use App\Models\nav;
use App\Models\Picture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class CfgController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 首页
     */
    public function index(){

        $tdk=['title'=>'配置管理'];

        //获取left菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);



        $ret=cfg::get();



        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'tabledata'=>$ret

        ];
        return view('Admin/cfg',$data);
    }




    /**
     * 广告编辑
     */
    public function cfg_edit($id=null){
        $tdk=['title'=>'添加配置'];

        //获取left菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);


        $ret=cfg::where(['id'=>$id])->first();

        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'list'=>$ret

        ];
        return view('Admin/cfg_edit',$data);
    }






    /**
     * 广告编辑
     */
    public function cfg_handle()
    {

        if ($_REQUEST['type'] == 'dele') {
            $ret = cfg::where(['id' => $_REQUEST['id']])->delete();
        } else {


            if (empty($_REQUEST['id'])) {
                $picret['id']=null;
                if ($_REQUEST['cover']) {
                    $msg = $this->upload_file('cover');
                    if ($msg['status'] == 1) {
                        $data = [
                            'true_path' => $msg['info'],
                            'source' => 'admin/cfg_edit',
                            'create_at' => time(),
                            'type' => '非富文本'
                        ];
                        $picret = Picture::create($data);
                        $picret->save();
                    } else {
                        echo json_encode(['msg' => $msg['info']]);
                        exit;
                    }
                }


                $data = [
                    'name' => $_REQUEST['name'],
                    'key' => $_REQUEST['key'],
                    'value' => $_REQUEST['value'],
                    'pic_id' => $picret['id'],
                    'title' => $_REQUEST['title']
                ];


                $ret = cfg::insert($data);
            } else {

                if (!empty($_REQUEST['cover'])) {
                    $cdg = cfg::with('pics')->where(['id' => $_REQUEST['id']])->first();
                    $this->dele_file($cdg['pics']['id'], $cdg['pics']['true_path']);
                    $msg = $this->upload_file('cover');
                    if ($msg['status'] == 1) {
                        $data = [
                            'true_path' => $msg['info'],
                            'source' => 'admin/cfg_edit',
                            'create_at' => time(),
                            'type' => '非富文本'
                        ];
                        $picret = Picture::create($data);
                        $picret->save();
                        $data = [
                            'name' => $_REQUEST['name'],
                            'key' => $_REQUEST['key'],
                            'value' => $_REQUEST['value'],
                            'pic_id' => $picret['id'],
                            'title' => $_REQUEST['title']
                        ];
                    } else {
                        echo json_encode(['msg' => $msg['info']]);
                        exit;
                    }

                } else {
                    $data = [
                        'name' => $_REQUEST['name'],
                        'key' => $_REQUEST['key'],
                        'value' => $_REQUEST['value'],
                        'title' => $_REQUEST['title']
                    ];
                }
                $ret = cfg::where(['id' => $_REQUEST['id']])->update($data);

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
