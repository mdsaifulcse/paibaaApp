<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrimaryInfo extends Model
{
    protected $table='primary_info';
    protected $fillable=['company_name','company_name_ban','logo','favicon','address','address_ban','mobile_no','mobile_no_ban','phone','email','description','description_ban','meta_description','meta_description_ban','type'];
}
