<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdPostPrice extends Model
{
    protected $table='ad_post_prices';
    protected $fillable=['category_id','ad_post_id','sub_category_id','price_title','price','is_negotiable'];
}
