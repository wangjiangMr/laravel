<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    protected $table='brand';
    public $timestamps = false;



    /**
     * 获取封面图片
     */
    public function pics(){
        return $this->hasOne('App\Models\Picture', 'id','cover_id');
    }



}
