<?php
/**
 * Created by PhpStorm.
 * User: mdsaiful
 * Date: 12/23/2019
 * Time: 11:50 AM
 */
namespace App\CustomFacades;

use App\Models\AdPost;
use App\Models\Area;
use App\Models\Category;
use App\Models\DivisionTown;

class DataLoadController
{

    public function categoryData(){
       return Category::orderBy('id','DESC')->pluck('category_name','id');
    }
    public function divisionData(){
       return DivisionTown::orderBy('id','DESC')->where('type',1)->pluck('division_town','id');
    }

    public function townData(){
       return DivisionTown::orderBy('id','DESC')->where('type',2)->pluck('division_town','id');
    }

    public function areaData($division_town_id=null){
        if ($division_town_id!=null){

            return  Area::where('division_town_id',$division_town_id)->orderBy('id','DESC')->pluck('area_name','id');
        }else{
            return  Area::orderBy('id','DESC')->pluck('area_name','id');
        }
    }

    public function adPostAreas(){
        return AdPost::join('areas','ad_post.area_id','areas.id')->where(['ad_post.status'=>1,'is_approved'=>'1'])->pluck('area_name','areas.id');
    }

}