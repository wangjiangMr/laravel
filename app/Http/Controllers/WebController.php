<?php

namespace App\Http\Controllers;

use Faker\Provider\Image;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\user;
use App\Models;
use Illuminate\Support\Facades\DB;



class WebController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $requests;



    public function __construct(Request $request)
    {

        $this->requests=$request;

    }



    /**
     * 登录验证
     * type
     * 1:默认手机号登录
     * 2：邮箱登录
     * 3：昵称登录
     * return
     * -1:参数不完整
     * 1：验证成功
     * 0：验证失败
     */
    public function val_login($mail,$pwd){
        if(!empty($pwd) && !empty($mail)){
            $ret=user::where(array('mail'=>$mail))->first();
            if(count($ret)>0){
                $bool=password_verify($pwd,$ret['pwd']);

                if($bool){
                    session(['user'=>$ret]);
                    return 1;
                }else{
                    return 2;
                }

            }else{
                return 0;
            }
        }else{
            return -1;
        }

    }





    /**
     * 获取菜单
     */
    public function get_map($map){
        foreach($map as $k=>$v){
            $is_child=Models\menu::where(['is_show'=>1,'type'=>0,'pid'=>$v['id']])->get();
            if(count($is_child)>0){

                $v['child']=$is_child;
                $this->get_map($is_child);
            }else{
                continue;
            }
        }
        return $map;
    }





    /**
     * @return mixed
     * 获取日志sql语句
     */
    function lastSql(){
        DB::enableQueryLog();
        $sql = DB::getQueryLog();

        $query = end($sql);

        return $query;

    }





    /**
     * 文件上传
     */
    public function upload_file($name,$w=null,$h=null){

        if (!$this->requests->hasFile($name)) {
            return ['status'=>0,'info'=>'无法获取上传文件'];
        }
        $file = $this->requests->file($name);

        if ($file->isValid()) {
            $date=date("/Y/m/d",time());
            //或者文件夹路径 如果没有则返回false
            $path=public_path('upload'.$date);

            if(!file_exists($path)){
                mkdir($path,0755,true);
            }

            $ext = $file->getClientOriginalExtension();
            $filename = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext;
            $truepath='/upload'.$date.'/'.$filename;
//            $filename = $file->getClientOriginalName();


            if(!$file->move($path,$filename)){

                return ['status'=>0,'info'=>'保存文件失败'];
                exit;

            }

            if(!empty($w) && !empty($h)){
                $img = \Intervention\Image\Facades\Image::make(public_path($truepath))->resize($w,$h);
                $img->save(public_path($truepath));
            }


            return ['status'=>1,'info'=>$truepath];
            exit;

        } else {
            return ['status'=>0,'info'=>'文件未通过验证'];

        }

    }


    /**
     * @param $id
     * @param $path
     * @return bool
     * 图片删除
     */
    public function dele_file($id,$path)
    {
        if (!empty($path) && file_exists(public_path($path))) {
            unlink(public_path($path));
            Models\Picture::find($id)->delete();
            return true;
        }
        return false;
    }


    /**
     * @param $cateid
     * @param null $where
     * @param null $order
     * 获取分类文章
     */
    public function get_art($cateid,$where=null,$orderfiel='id',$order='ASC',$limit=null){
        $ret['cate']=Models\cate::find($cateid);

        $map=['cate_id'=>$cateid];
        if(!empty($where)){
            $map=array_merge($map,$where);
        }
        $ret['art']=Models\article::with('pics')->where($map)->orderBy($orderfiel,$order)->limit($limit)->get();
        return $ret;
    }


    /**
     * @return string
     * 获取IP
     */
    function getClientIP()
    {
        global $ip;
        if (getenv("HTTP_CLIENT_IP"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if(getenv("HTTP_X_FORWARDED_FOR"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if(getenv("REMOTE_ADDR"))
            $ip = getenv("REMOTE_ADDR");
        else $ip = "Unknow";
        return $ip;
    }


    /**
     * @param $str
     * @return mixed
     * 去除标签
     */
    public function clean_str($str){
        $str = preg_replace( "@<script(.*?)</script>@is", "", $str );
        $str = preg_replace( "@<iframe(.*?)</iframe>@is", "", $str );
        $str = preg_replace( "@<style(.*?)</style>@is", "", $str );
        $str = preg_replace( "@<(.*?)>@is", "", $str );
        return $str;
    }


    /**
     * 获取分类数据
     */
    public function get_tree_cate($topid){
        global $arr;
        $child=Models\cate::where(['pid'=>$topid])->get();
        if(count($child)<=0){

            $map=Models\cate::where(['id'=>$topid])->get();
            $arr[]= $map[0];

        }else{

            foreach($child as $k=>$v){
                $this->get_tree_cate($v['id']);
            }
        }

        return $arr;
    }


    /**
     * 判断是否登录
     */
    public function is_log(){
        if(session('user')){
            return user::with('pics')->where('uid',session('user')['uid'])->first();
        }else{
            return false;
        }

    }








}
