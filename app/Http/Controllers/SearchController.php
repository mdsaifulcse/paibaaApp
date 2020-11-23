<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\AdPost;
use App\Model\DivisionTown;
use App\Model\Category;
use App\Model\SubCategory;
use App\Model\LastStepCategory;

class SearchController extends Controller
{
	public function search(Request $request){
		$name=$request->key;
    	$cat=$request->cat;
    	$area=$request->area;
    	$catName=' in All Category';
    	$query=AdPost::approvedAd()->where('ad_post.type','!=',3);
    	 if($area!=null){
        	$query=$query->where('ad_post.fk_division_id',$area);
        }
        if($cat!=null){
    	$catData=Category::where('link',$cat)->first();
    	if($catData==null){
    		return redirect()->back();
    	}
    	$catName=' in '.$catData->name;
        	$query=$query->where('category.id',$catData->id);
        }
      $adPost= $query->where('sub_category_name','LIKE',"%$name%")->orWhere('title','LIKE',"%$name%");
       if($cat!=null){
    	$catData=Category::where('link',$cat)->first();
    	$catName=' in '.$catData->name;
        	$adPost=$adPost->where('category.id',$catData->id);
        }
        if($area!=null){
        	$adPost=$adPost->where('ad_post.fk_division_id',$area);
        }
        $adPost=$adPost->paginate(12);

        $productCategory=Category::select('id','name','icon_photo','icon_class','link')->where('status',1)->where('type',1)->orderBy('serial_num','ASC')->get();
        foreach ($productCategory as $key => $value) {
            $productCategory[$key]['ad']=AdPost::leftJoin('sub_category','ad_post.fk_sub_category_id','sub_category.id')->where('sub_category.fk_category_id',$value->id)->where('is_approved',1)->where('ad_post.status',1)->count();
        }
        $division=DivisionTown::where('status',1)->get();
        foreach ($division as $key => $div) {
            $division[$key]['ad']=AdPost::where('fk_division_id',$div->id)->where('is_approved',1)->where('ad_post.status',1)->count();
        }
        \Session::put('title_msg','Search by "'.$name);
        \Session::put('metaDescription','Buy & sell everything or search for property & jobs in Bangladesh Huge Range of Products, Buy and Sell Anything, Post your free ad');
        
        $page_title='Search by "'.$name.'"'.$catName;
        return view('frontend.ad.index',compact('adPost','productCategory','division','page_title','name'));

	}
    public function autoComplete(Request $request){
    	$name=$request->name;
    	$cat=$request->cat;
    	$results=SubCategory::leftJoin('category','sub_category.fk_category_id','category.id')->where('category.type',1)->where('sub_category_name', 'LIKE', '%'. $name .'%')->take(10);
    	if($cat!=null){
    		$results=$results->where('category.link',$cat);
    	}
    	$results=$results->pluck('sub_category_name');

    	return response()->json($results);
    }
}
