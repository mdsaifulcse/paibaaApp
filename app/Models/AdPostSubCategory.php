<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdPostSubCategory extends Model
{
    protected $table='ad_post_sub_category';
    protected $fillable=['ad_post_id','category_id','sub_category_id'];

    public function subCatByCat(){
        return $this->belongsTo(SubCategory::class,'sub_category_id','id');
    }
}
