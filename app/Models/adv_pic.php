<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class adv_pic extends Model
{
    protected $table='adv_pic';
    public $timestamps = false;
    /**
     * 获取广告位相关图片信息
     */
    public function pics()
    {
        return $this->hasOne('App\Models\Picture', 'id', 'pic_id');

    }

}
