<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategoryWiseAdCount extends Model
{
    protected $table='sub_category_wise_ad_counts';
    protected $fillable=['sub_category_id','total_ad'];

}
