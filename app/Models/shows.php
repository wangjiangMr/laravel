<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class shows extends Model
{
    protected $table='pic_shows';
    public $timestamps = false;
    protected $fillable = ['title', 'des','create_at','pic_id'];

    /**
     * 获取全部图片
     */
    public function pics(){
        return $this->hasOne('App\Models\Picture', 'id','pic_id');
    }

}
