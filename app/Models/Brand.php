<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table='brands';
    protected $fillable=['brand_name','brand_name_bn','status','serial_num','created_by','updated_by'];
}
