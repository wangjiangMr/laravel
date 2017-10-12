<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{

    protected $table='user';
    public $timestamps = false;


    /**
     * 获取头像
     */
    public function pics(){
        return $this->hasOne('App\Models\Picture', 'id','head_img');
    }

}
