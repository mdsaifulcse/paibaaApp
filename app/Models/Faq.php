<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table='faq';
    protected $fillable=['title','description','status','serial_num'];
}
