<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table='orders';
    protected $fillable=['ad_post_id','customer_id','post_user_id','category_id','booking_date_start','booking_date_end','booking_time_start','booking_time_end','txt_message','attach_file','delivery_address','total_amount','service_meet_up','status'];

}
