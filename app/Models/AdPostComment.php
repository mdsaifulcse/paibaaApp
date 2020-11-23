<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AdPostComment extends Model
{
    protected $table='ad_post_comments';
    protected $fillable=['user_id','ad_post_id','comment','status'];
    //protected $dates;

    public function commentAuthor(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}
