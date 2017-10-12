<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $table='comment';
    public $timestamps = false;

    /**
     * 评论用户信息
     */
    public function user(){
        return $this->hasOne('App\Models\user', 'uid','uid');
    }
}
