<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{

    public $requests;



    public function __construct(Request $request)
    {
        $this->requests=$request;

    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 错误提示页面
     */
    public function error($info){
        return view('Admin/error',['title',$info]);
    }



    /**
     *首页
     */
    public function index(){
        //tdk
        $tdk=['title'=>'管理首页'];

        //再次检查是否登录
        if(!$this->is_log()){
            return redirect('backpage/login');
            exit;

        }



        //获取left菜单
        $map=Models\menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=Models\menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);



        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu
        ];

        return view('Admin/index',$data);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 后台登录页
     */
    public function login(Request $request){

        //tdk
        $tdk=['title'=>'管理首页'];


        if($this->is_log()){
            return redirect('admin');
            exit;
        }

        if(!empty($_REQUEST)){
            $this->validate($request,[
                'username'=>'required|max:255',
                'pwd'=>'required|min:6'
            ],[
                '请正确填写用户名',
                '密码格式不符合'
            ]);

            $name=$_REQUEST['username'];
            $pwd=$_REQUEST['pwd'];
            $logret=self::val_login($name,$pwd,3);
            if($logret==-1){
                return view('Admin/login',['tdk'=>$tdk,'tishi'=>'请完整输入']);
            }elseif($logret==0){

                return view('Admin/login',['tdk'=>$tdk,'tishi'=>'用户名不存在']);
            }elseif($logret==2){

                return view('Admin/login',['tdk'=>$tdk,'tishi'=>'密码错误']);
            }elseif($logret==1){

                return redirect('admin');

            }else{
                return view('Admin/login',['tdk'=>$tdk,'tishi'=>'未知错误']);
            }

        }else{
            return view('Admin/login',['tdk'=>$tdk]);
        }

    }


    /**
     * 退出登录
     */
    public function login_out(){
        session(['auth'=>null]);
        return redirect('backpage/login');
    }





    /**
     * 菜单管理
     */
    public function manage_menu(...$arg){
        //tdk
        $tdk=['title'=>'菜单管理'];

        //获取left菜单
        $map=Models\menu::where(['is_show'=>1,'type'=>0,'pid'=>0])->get();
        $leftmenu=$this->get_map($map);

        //获取top菜单
        $map=Models\menu::where(['is_show'=>1,'type'=>0,'pid'=>0,'is_top'=>1])->get();
        $topmenu=$this->get_map($map);


        $argnum=count($arg);
        $menu=null;
        if($argnum==1){
            $uri='admin/form_menu/'.$arg[0].'/';
        } elseif($argnum==2){

            $uri='admin/form_menu/'.$arg[0].'/'.$arg[1];
            $menu=Models\menu::where(['id'=>$arg[1]])->first();

        }else{
            $uri='admin/form_menu/add/';
        }



        //数据集合
        $data=[
            'tdk'=>$tdk,
            'left'=>$leftmenu,
            'top'=>$topmenu,
            'formuri'=>$uri,
            'formdata'=>$menu
        ];


        return view('Admin/manage_menu',$data);

    }


    /**
     * 菜单数据操作
     */
    public function change_menu(...$arg){

        if(count($arg)==1){

            $this->validate($this->requests,[
                'title'=>'max:255',
                'link'=>'required|max:255'
            ],[
                '标题不符合标准',
                '链接不符合标准'
            ]);

            $ret=Models\menu::create($_REQUEST);


        }
        if(count($arg)==2){

            if($arg[0]=='dele'){
                $de_menu=Models\menu::where('id',$arg[1])->get()[0];
                if($de_menu['pid']==0){
                    $ret=Models\menu::find($arg[1])->delete();
                    Models\menu::where(['pid'=>$de_menu['id']])->delete();
                }else{
                    $ret=Models\menu::find($arg[1])->delete();
                }

            }
            if($arg[0]=='edit'){
                $ret=Models\menu::find($arg[1])->update($_REQUEST);
            }
        }


        if($ret){

            return redirect('admin/menu');
        }

    }











}
