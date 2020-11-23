<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCatWiseBrand extends Model
{
    protected $table='sub_category_wise_brands';
    protected $fillable=['sub_category_id','brand_id','created_by','updated_by'];
}
