<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PriceNegotiation extends Model
{
    protected $table='price_negotiations';
    protected $fillable=['user_id','ad_post_id','request_by','request_to','price','request_message','price_message','offer','status'];

    public function priceNegotiationOfAds()
    {
        return $this->belongsTo(AdPost::class, 'ad_post_id', 'id');
    }


    public function offeredUser()
    {
        return $this->belongsTo(User::class,'request_by','id');
    }

    public function replayUser()
    {
        return $this->belongsTo(User::class,'request_to','id');
    }
}
