<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdPostLocation extends Model
{
    protected $table='ad_post_locations';
    protected $fillable=['category_id','ad_post_id','location_id'];

    public function locationByCat(){
        return $this->belongsTo(Location::class,'location_id','id');
    }
}
