<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $table='pictures';
    public $timestamps = false;
    protected $fillable = ['title', 'des','create_at','source','true_path','type'];
}
