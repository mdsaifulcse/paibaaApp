<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table='sub_category';
    protected $fillable=['category_id','sub_category_name','sub_category_name_bn','status','serial_num','description','created_by','updated_by'];

    public function subCatPrices(){
        return $this->hasMany(AdPostPrice::class,'sub_category_id','id');
    }
    public function totalSubCatAd(){
        return $this->hasOne(SubCategoryWiseAdCount::class,'sub_category_id','id');
    }

    public function categoryData(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function subCategoryAds(){
        return $this->belongsToMany(AdPost::class,'ad_post_sub_category');
    }

}
