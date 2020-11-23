<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationWiseAdCount extends Model
{
    protected $table='location_wise_ad_counts';
    protected $fillable=['location_id','total_ad'];
}
