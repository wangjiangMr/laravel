<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class q_answer extends Model
{
    protected $table='qus_answer';
    public $timestamps = false;

    /**
     * 用户信息
     */
    public function user(){
        return $this->hasOne('App\Models\user', 'uid','uid');
    }

}
