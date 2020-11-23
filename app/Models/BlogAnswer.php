<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class BlogAnswer extends Model
{
    protected $table='blog_answers';
    protected $fillable=['user_id','ad_post_id','answer','status'];

    public function blogAnswerUser(){
        return $this->belongsTo(User::class,'user_id','id');
    }


//    public function ansReplay(){
//        return $this->hasMany(AnswerReplay::class,'answer_id','id');
//    }

}
