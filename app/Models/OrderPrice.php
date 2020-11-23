<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPrice extends Model
{
    protected $table='order_prices';
    protected $fillable=['order_id','price_title','price'];
}
