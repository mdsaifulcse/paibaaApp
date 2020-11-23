<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table='user_infos';
    protected $fillable=['user_id','location_id'];

    public function userDesignation(){
        return $this->belongsTo(Designation::class,'designation_id','id');
    }

    public function userData(){
        return $this->belongsTo(User::class,'user_id','id');
    }




}
