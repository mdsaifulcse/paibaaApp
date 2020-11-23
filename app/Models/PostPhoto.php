<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostPhoto extends Model
{
    protected $table='post_photos';
    protected $fillable=['ad_post_id','photo_one','photo_two','photo_three','photo_four','photo_five'];
}
