<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cfg extends Model
{
    protected $table='cfg';
    public $timestamps = false;

    /**
     * 获取封面图片
     */
    public function pics(){
        return $this->hasOne('App\Models\Picture', 'id','pic_id');
    }
}
