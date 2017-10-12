<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    protected $table='article';
    public $timestamps = false;
    protected $fillable = ['title', 'des','create_at','content','cover_id','keywords','cate_id','brand_id'];

    /**
     * 获取全部图片
     */
    public function pics(){
        return $this->hasOne('App\Models\Picture', 'id','cover_id');
    }
}
