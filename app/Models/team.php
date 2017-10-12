<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class team extends Model
{
    protected $table='our_team';
    public $timestamps = false;

    /**
     * 获取头像
     */
    public function head(){
        return $this->hasOne('App\Models\Picture', 'id','head_img');
    }
}
