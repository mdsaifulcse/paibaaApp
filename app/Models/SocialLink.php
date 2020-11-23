<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $table='social_links';
    protected $fillable=['name','link','status','serial_num','icon_class'];
}
