<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AnswerReplay extends Model
{
    protected $table='answer_replays';
    protected $fillable=['user_id','ad_post_id','answer_id','replay','status'];

    public function replayAuthor(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}
