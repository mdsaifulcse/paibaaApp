<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Image;
use DB;

class AdPost extends Model
{
    protected $table='ad_post';
    protected $fillable=['user_id','title','lang','description','address','category_id','deliverable','delivery_fee','price','is_negotiable','tag','status','visitor','link','is_approved','approved_by','published_till','created_by','updated_by',];


    public function postCategory(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function adSubCategory(){ // Ad Post Sub-Categories
        return $this->belongsToMany(SubCategory::class,'ad_post_sub_category');
    }

    public function adLocation(){
        return $this->belongsToMany(Location::class,'ad_post_locations');
    }

    public function adPostPrice(){ // Ad Post Sub-Categories
        return $this->hasMany(AdPostPrice::class,'ad_post_id','id')->groupBy('price_title')->orderBy('id');
    }

    public function postApproved(){
        return $this->belongsTo(User::class,'approved_by','id');
    }

    public function postAuthor(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function postPhoto(){
        return $this->hasOne(PostPhoto::class,'ad_post_id','id');
    }

    public function blogAnswers(){
        return $this->hasMany(BlogAnswer::class,'ad_post_id','id');
    }


    public function adPostComments(){
        return $this->hasMany(AdPostComment::class,'ad_post_id','id');
    }

//    public function adPostFiledValue(){
//        return $this->hasOne(PostFieldValue::class,'ad_post_id','id')->leftJoin('post_fields','post_fields.id','post_field_value.post_field_id')
//            ->where('post_fields.use_on_filter',1);
//    }

    public function userPriceNegotiation(){

        if (Auth::check()){
            return $this->hasOne(PriceNegotiation::class,'ad_post_id','id')->where(['request_by'=>Auth::user()->id]);
        }else{
            return '';
        }

    }



    static function approvedAd(){}

    static function photoUpdate($request,$id){}









}
