<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    protected $table='menu';
    public $timestamps = false;
    protected $fillable = ['title', 'link','is_show','is_top','pid'];
    //
}
