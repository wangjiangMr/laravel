<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class adv extends Model
{
    protected $table='adv';
    public $timestamps = false;


    /**
     * 获取广告位相关图片信息
     */
    public function advs()
    {

        return $this->hasMany('App\Models\adv_pic', 'adv_id', 'id');

    }


}
