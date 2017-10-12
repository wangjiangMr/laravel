<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class qus extends Model
{
    protected $table='qustion';
    public $timestamps = false;

    /**
     * 获取全部图片
     */
    public function asws(){
        return $this->hasMany('App\Models\q_answer', 'q_id','id');
    }

}
