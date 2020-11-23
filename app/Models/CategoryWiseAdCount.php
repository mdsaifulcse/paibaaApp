<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryWiseAdCount extends Model
{
    protected $table='category_wise_ad_counts';
    protected $fillable=['category_id','total_ad'];
}
