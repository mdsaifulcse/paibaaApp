<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\AdPost;
use App\Model\Category;
use App\Model\PostFieldValue;
use App\Model\DivisionTown;
use App\Model\SubCategory;
use App\Model\LastStepCategory;
use App\Model\Area;
use App\Model\UserCv;
use App\Model\AdManager;
use DB;

class AdController extends Controller
{
    public function index(){
        $banners=AdManager::where(['fk_page_id'=>3,'status'=>1])->get()->keyBy('serial_num');
        $query=AdPost::approvedAd();
        $adPost=$query->where('ad_post.type','!=',3)->paginate(25);
        $productCategory=Category::select('id','name','icon_photo','icon_class','link')->where('status',1)->where('type',1)->orderBy('serial_num','ASC')->get();
        foreach ($productCategory as $key => $value) {
            $productCategory[$key]['ad']=AdPost::leftJoin('sub_category','ad_post.fk_sub_category_id','sub_category.id')->where('sub_category.fk_category_id',$value->id)->where('is_approved',1)->where('ad_post.status',1)->count();
        }
        $division=DivisionTown::where('status',1)->get();
        foreach ($division as $key => $div) {
            $division[$key]['ad']=AdPost::where('fk_division_id',$div->id)->where('is_approved',1)->where('ad_post.status',1)->count();
        }
        \Session::put('title_msg','All ads');
        \Session::put('metaDescription','Buy & sell everything or search for property & jobs in Bangladesh Huge Range of Products, Buy and Sell Anything, Post your free ad');
        $page_title='ক্রয়- bikroy in bangladesh';
        return view('frontend.ad.index',compact('adPost','productCategory','division','page_title','banners'));
    }
    public function divisionWise(Request $request,$divLink){
        $banners=AdManager::where(['fk_page_id'=>3,'status'=>1])->get()->keyBy('serial_num');
        $filter='';
        $division=DivisionTown::where('link',$divLink)->select('id','name','link')->first();
        if(count($division)==0){
            return redirect()->back();
        }
        $query=AdPost::approvedAd();
        $adPost=$query->where('ad_post.fk_division_id',$division->id);
        if(isset($request->area)){
            $requestArea=Area::where('id',$request->area)->first();
            if(count($requestArea)==0){
                return redirect()->back();
            }
            $filter['area']=$request->area;
            $adPost=$adPost->where('ad_post.fk_area_id',$request->area);
        }
       
        $adPost=$adPost->where('ad_post.type','!=',3)->paginate(12);
        $productCategory=Category::select('id','name','icon_photo','icon_class','link')->where('status',1)->where('type',1)->orderBy('serial_num','ASC')->get();
        foreach ($productCategory as $key => $value) {
            $categoryQuery=AdPost::leftJoin('sub_category','ad_post.fk_sub_category_id','sub_category.id')->where('sub_category.fk_category_id',$value->id)->where('fk_division_id',$division->id)->where('is_approved',1)->where('ad_post.status',1);
            if(isset($request->area)){

                $categoryQuery=$categoryQuery->where('ad_post.fk_area_id',$request->area);
            }
            $productCategory[$key]['ad']=$categoryQuery->count();
        }
        $area=Area::select('id','area_name')->where('status',1)->where('fk_division_id',$division->id)->get();
        foreach ($area as $key => $value) {
            $area[$key]['ad']=AdPost::where('fk_area_id',$value->id)->where('is_approved',1)->where('ad_post.status',1)->count();
        }
        \Session::put('title_msg',$division->name);
        \Session::put('metaDescription','Buy & sell everything or search for property & jobs in Bangladesh Huge Range of Products, Buy and Sell Anything, Post your free ad');
        $page_title='ক্রয়- bikroy in '.$division->name;
        return view('frontend.ad.division',['adPost' => $adPost->appends($request->except('page'))],compact('area','productCategory','division','divLink','filter','page_title','banners'));
    }
    public function categoryWise(Request $request,$divLink,$link){
        $location='Bangladesh';
        $area=array();
        $filter=array();
        $category=Category::where('link',$link)->select('id','name','description','link','post_type')->first();

        if(count($category)==0){
        	return redirect()->back();
        }
        $division=DivisionTown::where('status',1)->get();
        foreach ($division as $key => $div) {
            $division[$key]['ad']=AdPost::leftJoin('sub_category','ad_post.fk_sub_category_id','sub_category.id')->where('fk_division_id',$div->id)->where('fk_category_id',$category->id)->where('is_approved',1)->where('ad_post.status',1)->count();
        }
        if($divLink!='bangladesh'){

            $division=DivisionTown::where('link',$divLink)->select('id','name','link')->first();
            if(count($division)==0){
                return redirect()->back();
            }
            $location=$division->name;
        }
        $query=AdPost::approvedAd();
        $adPost=$query->where('category.id',$category->id);
        if($divLink!='bangladesh'){
            $adPost=$adPost->where('ad_post.fk_division_id',$division->id);
        }
        if(isset($request->area)){
            $requestArea=Area::where('id',$request->area)->first();
            if(count($requestArea)==0){
                return redirect()->back();
            }
            $filter['area']=$request->area;
            $adPost=$adPost->where('ad_post.fk_area_id',$request->area);
        }
        $adPost=$adPost->paginate(12);
        $subCategory=SubCategory::select('id','sub_category_name')->where('status',1)->where('fk_category_id',$category->id)->orderBy('serial_num','ASC')->get();
        foreach ($subCategory as $key => $value) {
            $lastQuery=AdPost::where('fk_sub_category_id',$value->id)->where('is_approved',1)->where('ad_post.status',1);
            if($divLink!='bangladesh'){
                $lastQuery=$lastQuery->where('fk_division_id',$division->id);
            }
            if(isset($request->area)){
                
                $lastQuery=$lastQuery->where('fk_area_id',$request->area);
            }
               $subCategory[$key]['ad']=$lastQuery->count(); 
        }
        if($divLink!='bangladesh'){
            $area=Area::select('id','area_name')->where('status',1)->where('fk_division_id',$division->id)->get();
            foreach ($area as $key => $value) {
                $area[$key]['ad']=AdPost::leftJoin('sub_category','ad_post.fk_sub_category_id','sub_category.id')->where('fk_category_id',$category->id)->where('fk_area_id',$value->id)->where('is_approved',1)->where('ad_post.status',1)->count();
            }
        }
        \Session::put('title_msg',$category->name);
        \Session::put('metaDescription',$category->description);
        if($category->post_type==1){
            $page_title=$category->name.' for buy, sale in '.$location;
        }elseif($category->post_type==2){
            $page_title=$category->name;
        }
        $banners=AdManager::where(['fk_category_id'=>$category->id,'status'=>1])->get()->keyBy('serial_num');
        
    	return view('frontend.ad.category',['adPost' => $adPost->appends($request->except('page'))],compact('adPost','subCategory','category','division','divLink','link','area','filter','page_title','banners'));
    }

    public function subCategoryWise(Request $request,$divLink,$link,$id){
        $banners=AdManager::where(['fk_page_id'=>3,'status'=>1])->get()->keyBy('serial_num');
        $area='';
        $filter='';
        $location='Bangladesh';
        $division=DivisionTown::where('status',1)->get();
        foreach ($division as $key => $div) {
            $division[$key]['ad']=AdPost::where('fk_division_id',$div->id)->where('fk_sub_category_id',$id)->where('is_approved',1)->where('ad_post.status',1)->count();
        }
        if($divLink!='bangladesh'){

            $division=DivisionTown::where('link',$divLink)->select('id','name','link')->first();
            if(count($division)==0){
                return redirect()->back();
            }
            $location=$division->name;
        }
    	$category=SubCategory::leftJoin('category','sub_category.fk_category_id','category.id')->where('sub_category.id',$id)->select('sub_category.id','name','sub_category_name','sub_category.description','category.link','category.post_type')->first();
        if(count($category)==0){
        	return redirect()->back();
        }
        $query=AdPost::approvedAd();
        $adPost=$query->where('sub_category.id',$category->id);
        if($divLink!='bangladesh'){
            $adPost=$adPost->where('ad_post.fk_division_id',$division->id);
        }
        if(isset($request->area)){
            $requestArea=Area::where('id',$request->area)->first();
            if(count($requestArea)==0){
                return redirect()->back();
            }
            $filter['area']=$request->area;
            $adPost=$adPost->where('ad_post.fk_area_id',$request->area);
        }
        $adPost=$adPost->paginate(12);
        $lastCategory=LastStepCategory::leftJoin('sub_category','last_step_category.fk_sub_category_id','sub_category.id')->select('last_step_category.id','last_step_category_name','sub_category.id as sub_id')->where('last_step_category.status',1)->where('fk_sub_category_id',$category->id)->orderBy('last_step_category.serial_num','ASC')->get();
        foreach ($lastCategory as $key => $value) {
                $lastQuery=AdPost::where('fk_last_step_id',$value->id)->where('is_approved',1)->where('ad_post.status',1);
            if($divLink!='bangladesh'){
                $lastQuery=$lastQuery->where('fk_division_id',$division->id);
            }
             if(isset($request->area)){
                
                $lastQuery=$lastQuery->where('fk_area_id',$request->area);
            }
               $lastCategory[$key]['ad']=$lastQuery->count(); 
        }
        if($divLink!='bangladesh'){
            $area=Area::select('id','area_name')->where('status',1)->where('fk_division_id',$division->id)->get();
            foreach ($area as $key => $value) {
                $area[$key]['ad']=AdPost::where('fk_area_id',$value->id)->where('fk_sub_category_id',$id)->where('is_approved',1)->where('ad_post.status',1)->count();
            }
        }
        \Session::put('title_msg',$category->sub_category_name);
        \Session::put('metaDescription',$category->description);
        if($category->post_type==1){
            $page_title=$category->sub_category_name.' for buy, sale in '.$location;

        }elseif($category->post_type==2){
            $page_title=$category->sub_category_name.' jobs in '.$location;
            
        }
    	return view('frontend.ad.subCategory',['adPost' => $adPost->appends($request->except('page'))],compact('adPost','lastCategory','category','division','area','divLink','link','id','filter','page_title','banners'));
    }
    
	public function lastCategoryWise(Request $request,$divLink,$link,$subId,$id){
        $banners=AdManager::where(['fk_page_id'=>3,'status'=>1])->get()->keyBy('serial_num');
            $location='Bangladesh';
	    	$division=DivisionTown::where('status',1)->get();
            foreach ($division as $key => $div) {
                $division[$key]['ad']=AdPost::where('fk_division_id',$div->id)->where('fk_last_step_id',$id)->where('is_approved',1)->where('ad_post.status',1)->count();
            }
            $area='';
            if($divLink!='bangladesh'){

                $division=DivisionTown::where('link',$divLink)->select('id','name','link')->first();
                if(count($division)==0){
                    return redirect()->back();
                }
                $location=$division->name;
            }
            $category=LastStepCategory::leftJoin('sub_category','last_step_category.fk_sub_category_id','sub_category.id')->leftJoin('category','sub_category.fk_category_id','category.id')->select('last_step_category.id','last_step_category_name','last_step_category.description','post_type')->where('last_step_category.id',$id)->first();
	        if(count($category)==0){
	        	return redirect()->back();
	        }

            $query=AdPost::approvedAd();
            $adPost=$query->where('last_step_category.id',$category->id);
            if($divLink!='bangladesh'){
                $adPost=$adPost->where('ad_post.fk_division_id',$division->id);
            }
            if(isset($request->area)){
                $requestArea=Area::where('id',$request->area)->first();
                if(count($requestArea)==0){
                    return redirect()->back();
                }
                $filter['area']=$request->area;
                $adPost=$adPost->where('ad_post.fk_area_id',$request->area);
            }
            $adPost=$adPost->paginate(12);
            if($divLink!='bangladesh'){
                $area=Area::select('id','area_name')->where('status',1)->where('fk_division_id',$division->id)->get();
                foreach ($area as $key => $value) {
                    $area[$key]['ad']=AdPost::where('fk_area_id',$value->id)->where('fk_last_step_id',$id)->where('is_approved',1)->where('ad_post.status',1)->count();
                }
            }
	        \Session::put('title_msg',$category->last_step_category_name);
	        \Session::put('metaDescription',$category->description);
            if($category->post_type==1){
            $page_title=$category->last_step_category_name.' for buy, sale in '.$location;

            }elseif($category->post_type==2){
            $page_title=$category->last_step_category_name.' jobs in '.$location;
                
            }
	    	return view('frontend.ad.lastCategory',['adPost' => $adPost->appends($request->except('page'))],compact('adPost','category','link','subId','id','divLink','division','area','filter','page_title','banners'));
	    }
	    
    public function show($link){
        $banners=AdManager::where(['fk_page_id'=>4,'status'=>1])->get()->keyBy('serial_num');
        $data=AdPost::leftJoin('post_photo','ad_post.id','post_photo.fk_post_id')
                ->leftJoin('brands','ad_post.fk_brand_id','brands.id')
                ->leftJoin('division_town','ad_post.fk_division_id','division_town.id')
                ->leftJoin('area','ad_post.fk_area_id','area.id')
                ->leftJoin('sub_category','ad_post.fk_sub_category_id','sub_category.id')
                ->leftJoin('category','sub_category.fk_category_id','category.id')
                ->leftJoin('last_step_category','ad_post.fk_last_step_id','last_step_category.id')
                ->leftJoin('users','ad_post.created_by','users.id')
                ->leftJoin('users as update','ad_post.updated_by','update.id')
                ->select('ad_post.*','brands.brand_name','division_town.name as division_name','area.area_name','sub_category_name','last_step_category_name','users.name as creator','update.name as updator','category.name as cat_name','category.link as cat_link','post_photo.photo_one','post_photo.photo_two','post_photo.photo_three','post_photo.photo_four','users.email','sub_category.id as sub_id','last_step_category.id as last_id')
                ->where('ad_post.status',1)
                ->where('ad_post.link',$link)
                ->first();
            if($data==null){
                return redirect()->back();
            }
            $ogImage="images/post/big/".$data->photo_one;
            $id=$data->id;
        $mobile=DB::table('post_wise_number')->where('fk_post_id',$id)->get();
        $postField=PostFieldValue::leftJoin('post_field','post_field_value.fk_post_field_id','post_field.id')->select('post_field_value.field_value','post_field.title')->where('fk_post_id',$id)->where('part_of',null)->get();

        $part=PostFieldValue::leftJoin('post_field','post_field_value.fk_post_field_id','post_field.id')->leftJoin('post_field as post_field2','post_field.part_of','post_field2.id')->select('post_field_value.field_value','post_field.title','post_field.id','post_field.part_of','post_field2.title as title2')->where('fk_post_id',$id)->where('post_field.part_of','!=',null)->orderBy('post_field.id','DESC')->get();
        $parts=json_decode($part);
        $extraPart=array();
        foreach($parts as $key => $value){
            foreach ($parts as $value2) {
                if($value->id==$value2->part_of){

                $extraPart[]=array(
                    'title'=>$value->title,
                    'title2'=>$value->title2,
                    'field_value'=>$value->field_value,
                    'field_value2'=>$value2->field_value,
                    );
                }
                
            }
        }
        foreach($extraPart as $key => $value){
            foreach ($extraPart as $value2) {
                if($value['title']==$value2['title2']){
                    unset($extraPart[$key]);

                }
                
            }
        }
        /*My others ad*/
        $query=AdPost::approvedAd();
        $othersAd=$query->where('ad_post.id','!=',$id)
                ->where('sub_category.id',$data->sub_id)
                ->where('last_step_category.id',$data->last_id)
                ->simplePaginate(6);
        $category=Category::where('type',1)->where('status',1)->orderBy('serial_num','ASC')->pluck('name','id');
        $division=DivisionTown::where('status',1)->where('type',1)->pluck('name','id')->toArray();
        $town=DivisionTown::where('status',1)->where('type',2)->pluck('name','id')->toArray();
        $division_town=array(
            'Town'=>$town,
            'Division'=>$division,
            );
        $visit=AdPost::where('id',$id)->first();
        $visit->update([
            'visitor'=>$visit->visitor+1,
        ]);
        \Session::put('title_msg',$data->title);
        \Session::put('metaDescription',$data->title);
        if($data->type!=3){

        return view('frontend.ad.show',compact('data','mobile','postField','extraPart','othersAd','category','division_town','banners','ogImage'));
        }else{
        return view('frontend.ad.jobShow',compact('data','mobile','postField','extraPart','othersAd','category','division_town','banners','ogImage'));

        }
    }
    public function jobApply($id){
        $cv=UserCv::where('created_by',\Auth::user()->id)->first();
        if($cv==null){
            return redirect('resume/create');
        }
        try{

        DB::table('job_application')->insert([
            'fk_post_id'=>$id,
            'fk_user_id'=>\Auth::user()->id,
            ]);

        $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
         if($bug==0){
        return redirect()->back()->with('success','Your application has been submitted.');
        }elseif($bug==1062){
            return redirect()->back()->with('error','You are already Applied!');
        }else{
            return redirect()->back()->with('error','Something Error Found ! ');
        }
    }



}
