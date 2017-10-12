<?php
/**
 * Created by PhpStorm.
 * User: Adminer
 * Date: 2017/8/25
 * Time: 10:09
 */


/**
 * @param $id
 * @return \Illuminate\Support\Collection
 * 获取图片
 */
if (! function_exists('get_pic_path')) {

    function get_pic_path($id)
    {

        if (!empty($id)) {
            $result = \App\Models\Picture::where(['id' => $id])->select('true_path')->first();

            if ($result) {
                return $result['true_path'];
            }
        }

    }


    /**
     * @param $id
     * @return mixed
     * 获取分类名
     */
    if (!function_exists('get_cate_names')) {
        function get_cate_name($id)
        {

            if (!empty($id)) {
                $result = \App\Models\cate::where(['id' => $id])->select('title')->first();

                if ($result) {
                    return $result['title'];
                }
            }

        }
    }


    /**
     * @param $id
     * @return mixed
     * 获取品牌名
     */
    if (!function_exists('get_brand_name')) {
        function get_brand_name($id)
        {
            if (!empty($id)) {
                $result = \App\Models\brand::where(['id' => $id])->select('title')->first();
                if ($result) {
                    return $result['title'];
                }
            }

        }
    }



    /**
     * @param $page 页面
     * @param $position 位置
     * @return mixed
     *获取广告页
     */
    if (! function_exists('get_adv_page')) {
        function get_adv_page($page, $position)
        {
            if (!empty($page) && !empty($position)) {
                $result = \App\Models\adv::where(['page' => $page, 'position' => $position])->first();
                if ($result) {
                    $pics = \App\Models\adv_pic::with('pics')->where(['adv_id' => $result['id']])->get();

                    return $pics;
                }
            }
        }
    }



    /**
     *获取配置项
     */
    if (! function_exists('get_cfg_item')) {
        function get_cfg_item($key, $is_pic = false,$all=false)
        {
            if (!empty($key)) {
                if ($is_pic == true) {
                    $result = \App\Models\cfg::with('pics')->where(['key' => $key])->first();
                } else {
                    $result = \App\Models\cfg::where(['key' => $key])->first();
                }
                if ($result) {
                    if($all){
                        return $result;
                    }else{
                        if ($is_pic == true) {
                            return $result['pics']['true_path'];
                        } else {
                            return $result['value'];
                        }
                    }

                }
            }
        }
    }



    /**
     *获取导航上级
     */
    if (! function_exists('get_nav_parent')) {
        function get_nav_parent($pid)
        {

            $result = \App\Models\nav::where(['id' => $pid])->select('title')->first();

            if ($result) {
                return $result['title'];
            } else {
                return '顶级';
            }
        }
    }


    /**
     *获取用户信息
     */
    if (! function_exists('get_user_info')) {
        function get_user_info($uid)
        {
            $result = \App\Models\user::where(['uid' => $uid])->first();

            if ($result) {
                return $result;
            }
        }
    }


    /**
     *获取问答默认回复
     */
    if (! function_exists('get_defualt_asw')) {
        function get_defualt_asw($id)
        {
            $result = \App\Models\q_answer::where(['id' => $id])->first();
            if ($result) {
                return $result;
            }else{
                $result['answer']='无数据';
                return $result;
            }
        }
    }


    /**
     *修改图片尺寸
     */
    if (! function_exists('reszie_img')) {
        function reszie_img($path,$w,$h)
        {
            $img=\Intervention\Image\Facades\Image::make(public_path($path))->resize($w,$h);
            $img->save(public_path($path));
            return $path;
        }
    }




    /**
     *获取友情链接
     */
    if (! function_exists('get_frendlink')) {
        function get_frendlink()
        {
          $ret=\App\Models\frendlink::where(['is_show'=>1])->get();
            return $ret;
        }
    }





}
