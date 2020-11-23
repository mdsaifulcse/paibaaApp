<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table='locations';
    protected $fillable=['location_name','location_name_bn','url','status','created_by','updated_by'];

    public function locationCreator(){
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function locationAds(){
        return $this->belongsToMany(AdPost::class,'ad_post_locations');
    }

}
