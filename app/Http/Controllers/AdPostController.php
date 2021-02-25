<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\AdPost;
use App\Model\Category;
use App\Model\SubCategory;
use App\Model\LastStepCategory;
use App\Model\SubCatWiseBrand;
use App\Model\SubCatWiseField;
use App\Model\DivisionTown;
use App\Model\Area;
use App\Model\PostFieldValue;
use App\Model\UserInfo;
use DB;
use Auth;
use URL;
use Validator;
use Image;

class AdPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->email_verified!=1 or Auth::user()->status!=1){
            return redirect('profile')->with('error','You are not eligible to ad post!');
        }
        $query=Category::where('type',1)->where('status',1)->select('id','name','icon_photo','icon_class')->orderBy('serial_num','ASC');
        if( Auth::user()->type!=3){
            $category=$query->get();
        }else{
            
            $category=$query->where('post_type','!=',2)->get();
        }
        return view('frontend.adPost.categorySelect',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //return $request->all();
        if(isset($request->category)){
            $category=SubCategory::leftJoin('category','sub_category.fk_category_id','category.id')->where('sub_category.id',$request->category)
                ->select('sub_category.id as sub_id','sub_category.sub_category_name','category.name','category.post_type')->first();

            if($category==''){
                return redirect()->back();
            }
        }elseif(isset($request->subcategory)){
            $category=LastStepCategory::leftJoin('sub_category','last_step_category.fk_sub_category_id','sub_category.id')
            ->leftJoin('category','sub_category.fk_category_id','category.id')
            ->where('last_step_category.id',$request->subcategory)->
            select('sub_category.id as sub_id','last_step_category.id as last_id','sub_category.sub_category_name','last_step_category.last_step_category_name','category.name','category.post_type')->first();

            if($category==''){
                return redirect()->back();
            }
        }else{
           return redirect()->back();
        }
        
        $brand=SubCatWiseBrand::leftJoin('brands','sub_category_wise_brand.fk_brand_id','brands.id')->where('fk_sub_category_id',$category->sub_id)->pluck('brand_name','brands.id');

        $fields=SubCatWiseField::leftJoin('post_field','sub_category_wise_field.fk_post_field_id','post_field.id')
        ->select('title','post_field.id','required','type','value','part_of')
        ->where('fk_sub_category_id',$category->sub_id)
        ->where('post_field.status',1)->where('post_field.part_of','=',null)->get();
        
        $part=SubCatWiseField::leftJoin('post_field','sub_category_wise_field.fk_post_field_id','post_field.id')->leftJoin('post_field as post_field2','post_field.part_of','post_field2.id')->where('fk_sub_category_id',$category->sub_id)->select('post_field.id','post_field.title','post_field.required','post_field.type','post_field.value','post_field.part_of','post_field2.id as id2','post_field2.title as title2','post_field2.required as required2','post_field2.type as type2','post_field2.value as value2','post_field2.part_of as part_of2')->where('post_field2.status',1)->where('post_field.part_of','!=',null)->distinct()->get();
        $parts=json_decode($part);
        foreach($parts as $key => $value){
            foreach ($parts as $value2) {
                if($value->id==$value2->part_of){
                    unset($parts[$key]);
                }       
            }
        }
        $numbers=DB::table('mobile_number')->where('fk_user_id',Auth::user()->id)->where('is_verified',1)->get();
        $userInfo=UserInfo::where('fk_user_id',Auth::user()->id)->first();
        if($userInfo==''){
            return redirect('profile')->with('error','Update your information.');
        }
        $division=DivisionTown::where('status',1)->where('type',1)->orderBy('name','ASC')->pluck('name','id')->toArray();
        $town=DivisionTown::where('status',1)->where('type',2)->orderBy('name','ASC')->pluck('name','id')->toArray();

        $division_town=array(
            'Town'=>$town,
            'Division'=>$division,
            );
        $divisionId=$userInfo->fk_division_id;
        $area=Area::where('status',1)->where('fk_division_id',$divisionId)->pluck('area_name','id');
        return view('frontend.adPost.create',compact('category','brand','fields','parts','numbers','division_town','area','userInfo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Dhaka');
        $input=$request->all();
        $input['created_by']=Auth::user()->id;
        $link=str_replace(' , ', '-', $input['title']);
        $link=str_replace(', ', '-', $link);
        $link=str_replace(' ,', '-', $link);
        $link=str_replace(',', '-', $link);
        $link=str_replace('/', '-', $link);
        $link=rtrim($link,' ');
        $link=str_replace(' ', '-', $link);
        $link=str_replace('.', '', $link);
        $link=str_replace('?', '-', $link);
        $link=substr($link,0,30);
        $link=strtolower($link);
        $input['link']=$link.'-'.Auth::user()->id.'-'.date('ymdHis');
        $validator = Validator::make($input, [   
                    'fk_sub_category_id' => 'required|numeric',
                    'type'               => 'required|numeric',
                    'title'              => 'required|max:250',
                    'condition'          => 'required|numeric',
                    'mobile_number'      => 'required',
                    'photo_one'          => 'image',
                    'photo_two'          => 'image',
                    'photo_three'        => 'image',
                    'photo_four'         => 'image',
                    'link'               => 'unique:ad_post'
                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
           
            try{
              if(isset($input['is_negotiable'])){

                    $input['is_negotiable']=1;
                }else{

                    $input['is_negotiable']=2;
                }
                $postId=AdPost::create($input)->id;
                if ($request->hasFile('photo_one')) {
                    $photos=AdPost::photoUpload($request,$postId);
                 }
            
            for ($i=0; $i <sizeof($input['mobile_number']) ; $i++) { 
                DB::table('post_wise_number')->insert([
                    'mobile_number'=>$input['mobile_number'][$i],
                    'fk_post_id'=>$postId,
                    ]);
            }
            if(isset($input['fk_post_field_id'])){

                for ($j=0; $j <sizeof($input['fk_post_field_id']) ; $j++) {
                    PostFieldValue::create([
                        'fk_post_field_id'=>$input['fk_post_field_id'][$j],
                        'field_value'=>$input['field_value'][$j],
                        'fk_post_id'=>$postId,
                        ]);
                }
            }
           
                
            $bug=0;
            }catch(\Exception $e){
                $bug=$e->errorInfo[1];
            }
             if($bug==0){
            return redirect('pending-ads')->with('success','Successfully Inserted');
            }else{
                return redirect()->back()->with('error','Something Error Found ! ');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$title=null)
    {
        $data=AdPost::leftJoin('post_photo','ad_post.id','post_photo.fk_post_id')
                ->leftJoin('brands','ad_post.fk_brand_id','brands.id')
                ->leftJoin('division_town','ad_post.fk_division_id','division_town.id')
                ->leftJoin('area','ad_post.fk_area_id','area.id')
                ->leftJoin('sub_category','ad_post.fk_sub_category_id','sub_category.id')
                ->leftJoin('category','sub_category.fk_category_id','category.id')
                ->leftJoin('last_step_category','ad_post.fk_last_step_id','last_step_category.id')
                ->leftJoin('users','ad_post.created_by','users.id')
                ->leftJoin('users as update','ad_post.updated_by','update.id')
                ->select('ad_post.*','brands.brand_name','division_town.name as division_name','area.area_name','sub_category_name','last_step_category_name','users.name as creator','update.name as updator','category.name as cat_name','post_photo.photo_one','post_photo.photo_two','post_photo.photo_three','post_photo.photo_four','users.email')
                ->where('ad_post.created_by',Auth::user()->id)
                ->where('ad_post.status',1)
                ->where('ad_post.id',$id)
                ->first();
            if($data==null){
                return redirect()->back();
            }
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
        $othersAd=AdPost::leftJoin('post_photo','ad_post.id','post_photo.fk_post_id')
                ->leftJoin('sub_category','ad_post.fk_sub_category_id','sub_category.id')
                ->leftJoin('category','sub_category.fk_category_id','category.id')
                ->leftJoin('last_step_category','ad_post.fk_last_step_id','last_step_category.id')
                ->select('ad_post.*','sub_category_name','last_step_category_name','post_photo.photo_one','category.name as cat_name')
                ->where('ad_post.created_by',Auth::user()->id)
                ->where('ad_post.id','!=',$id)
                ->where('ad_post.status',1)
                ->where('ad_post.is_approved',0)
                ->orderBy('ad_post.id','DESC')
                ->get();
        $category=Category::where('type',1)->where('status',1)->orderBy('serial_num','ASC')->pluck('name','id');
        $division=DivisionTown::where('status',1)->where('type',1)->orderBy('name','ASC')->pluck('name','id')->toArray();
        $town=DivisionTown::where('status',1)->where('type',2)->orderBy('name','ASC')->pluck('name','id')->toArray();
        $division_town=array(
            'Town'=>$town,
            'Division'=>$division,
            );
        if($data->type!=3){
        return view('frontend.adPost.show',compact('data','mobile','postField','extraPart','othersAd','category','division_town'));
        }else{
        return view('frontend.adPost.jobShow',compact('data','mobile','postField','extraPart','othersAd','category','division_town'));

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=AdPost::leftJoin('post_photo','ad_post.id','post_photo.fk_post_id')
                ->leftJoin('brands','ad_post.fk_brand_id','brands.id')
                ->leftJoin('division_town','ad_post.fk_division_id','division_town.id')
                ->leftJoin('area','ad_post.fk_area_id','area.id')
                ->leftJoin('sub_category','ad_post.fk_sub_category_id','sub_category.id')
                ->leftJoin('category','sub_category.fk_category_id','category.id')
                ->leftJoin('last_step_category','ad_post.fk_last_step_id','last_step_category.id')
                ->leftJoin('users','ad_post.created_by','users.id')
                ->leftJoin('users as update','ad_post.updated_by','update.id')
                ->select('ad_post.*','brands.brand_name','division_town.name as division_name','area.area_name','sub_category_name','last_step_category_name','users.name as creator','update.name as updator','category.name as cat_name','post_photo.photo_one','post_photo.photo_two','post_photo.photo_three','post_photo.photo_four')
                ->where('ad_post.created_by',Auth::user()->id)
                ->where('ad_post.id',$id)
                ->orderBy('ad_post.id','DESC')
                ->first();
            if($data==null){
                return redirect()->back();
            }

        $mobiles=DB::table('post_wise_number')->where('fk_post_id',$id)->get();
        $postField=PostFieldValue::leftJoin('post_field','post_field_value.fk_post_field_id','post_field.id')->select('post_field_value.field_value','fk_post_field_id','post_field.title')->where('fk_post_id',$id)->where('part_of',null)->get();

        $fieldPart=PostFieldValue::leftJoin('post_field','post_field_value.fk_post_field_id','post_field.id')->leftJoin('post_field as post_field2','post_field.part_of','post_field2.id')->select('post_field_value.field_value','post_field.title','post_field.id','post_field.part_of','post_field2.id as id2','post_field2.title as title2')->where('fk_post_id',$id)->where('post_field.part_of','!=',null)->orderBy('post_field.id','DESC')->get();
        $fieldParts=json_decode($fieldPart);
        $extraPart=array();
        foreach($fieldParts as $key => $value){
            foreach ($fieldParts as $value2) {
                if($value->id==$value2->part_of){

                $extraPart[]=array(
                    'id'=>$value->id,
                    'id2'=>$value->id2,
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
        if($data->fk_last_step_id!=null){
            $category=LastStepCategory::leftJoin('sub_category','last_step_category.fk_sub_category_id','sub_category.id')->leftJoin('category','sub_category.fk_category_id','category.id')->where('last_step_category.id',$data->fk_last_step_id)->select('sub_category.id as sub_id','last_step_category.id as last_id','sub_category.sub_category_name','last_step_category.last_step_category_name','category.name','category.post_type')->first();
        }else
            {
            $category=SubCategory::leftJoin('category','sub_category.fk_category_id','category.id')->where('sub_category.id',$data->fk_sub_category_id)->select('sub_category.id as sub_id','sub_category.sub_category_name','category.name','category.post_type')->first();
        }
        $division=DivisionTown::where('status',1)->where('type',1)->orderBy('name','ASC')->pluck('name','id')->toArray();
        $town=DivisionTown::where('status',1)->where('type',2)->orderBy('name','ASC')->pluck('name','id')->toArray();
        $division_town=array(
            'Town'=>$town,
            'Division'=>$division,
            );
        $area=Area::where('status',1)->where('fk_division_id',$data->fk_division_id)->pluck('area_name','id');
        $brand=SubCatWiseBrand::leftJoin('brands','sub_category_wise_brand.fk_brand_id','brands.id')->where('fk_sub_category_id',$category->sub_id)->pluck('brand_name','brands.id');
        $fields=SubCatWiseField::leftJoin('post_field','sub_category_wise_field.fk_post_field_id','post_field.id')->where('fk_sub_category_id',$category->sub_id)->select('title','post_field.id','required','type','value','part_of')->where('post_field.status',1)->where('post_field.part_of','=',null)->get();
        $part=SubCatWiseField::leftJoin('post_field','sub_category_wise_field.fk_post_field_id','post_field.id')->leftJoin('post_field as post_field2','post_field.part_of','post_field2.id')->where('fk_sub_category_id',$category->sub_id)->select('post_field.id','post_field.title','post_field.required','post_field.type','post_field.value','post_field.part_of','post_field2.id as id2','post_field2.title as title2','post_field2.required as required2','post_field2.type as type2','post_field2.value as value2','post_field2.part_of as part_of2')->where('post_field2.status',1)->where('post_field.part_of','!=',null)->distinct()->get();
        $parts=json_decode($part);
        foreach($parts as $key => $value){
            foreach ($parts as $value2) {
                if($value->id==$value2->part_of){
                    unset($parts[$key]);
                }
                
            }
        }
        $numbers=DB::table('mobile_number')->where('fk_user_id',Auth::user()->id)->where('is_verified',1)->get();
        $userInfo=UserInfo::where('fk_user_id',Auth::user()->id)->first();
        return view('frontend.adPost.edit',compact('data','mobiles','postField','extraPart','division_town','category','brand','fields','parts','numbers','area','userInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        date_default_timezone_set('Asia/Dhaka');
        $data=AdPost::where('ad_post.created_by',Auth::user()->id)
                ->where('ad_post.id',$id)->first();
        if(count($data)==0){
            return redirect()->back();
        }
        $input=$request->all();

        $validator = Validator::make($request->all(), [
                    'type'          => 'required|numeric',
                    'title'         => 'required|max:250',
                    'condition'     => 'required|numeric',
                    'mobile_number' => 'required',
                    'photo_one'     => 'image',
                    'photo_two'     => 'image',
                    'photo_three'   => 'image',
                    'photo_four'    => 'image'
                ]);
        
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
            if(!isset($input['is_negotiable'])){
                $input['is_negotiable']=2;
            }
        try{
            if($input['type']!=3){
                $photos=AdPost::photoUpdate($request,$id);
            }
            DB::table('post_wise_number')->where('fk_post_id',$id)->delete();
            for ($i=0; $i <sizeof($input['mobile_number']) ; $i++) { 
                DB::table('post_wise_number')->insert([
                    'mobile_number'=>$input['mobile_number'][$i],
                    'fk_post_id'=>$id,
                    ]);
            }
            if(isset($input['fk_post_field_id'])){

                for ($j=0; $j <sizeof($input['fk_post_field_id']) ; $j++) {
                    $fieldId=$input['fk_post_field_id'][$j];
                    PostFieldValue::where('fk_post_id',$id)->where('fk_post_field_id',$fieldId)->update([
                        'field_value'=>$input['field_value'][$j],
                        ]);
                }
            }
            $input['is_approved']=2;
            $data->update($input);
                
            $bug=0;
            }catch(\Exception $e){
                $bug=$e->errorInfo[1];
            }
             if($bug==0){
            return redirect('pending-ads')->with('success','Data Successfully Updated');
            }else{
                return redirect()->back()->with('error','Something Error Found ! ');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=AdPost::where('id',$id)->where('created_by',Auth::user()->id)->first();
        if($data==null){
            return redirect()->back();
        }
        if($data->is_approved==1){
            $url='my-ads';
        }else{
            $url='pending-ads';
        }
        try{
        $photos=AdPost::deletePhoto($id);
        DB::table('post_wise_number')->where('fk_post_id',$id)->delete();
        PostFieldValue::where('fk_post_id',$id)->delete();
            $data->delete();
            $bug=0;
            $error=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            $error=$e->errorInfo[2];
        }
        if($bug==0){
       return redirect("$url")->with('success','Ad Successfully Deleted!');
        }elseif($bug==1451){
            return redirect()->back()->with('error','This ad is Used anywhere ! ');
        }
        elseif($bug>0){
       return redirect()->back()->with('error','Some thing error found !');

        } 
    }
    public function loadSubCat($id)
    {
        $subCategory=SubCategory::where('sub_category.status',1)->where('fk_category_id',$id)->select('sub_category.id','sub_category.sub_category_name')->orderBy('sub_category.serial_num','ASC')->get();
        foreach ($subCategory as $key => $value) {
            $lastStep[$key]=LastStepCategory::where('fk_sub_category_id',$value->id)->count();
        }
        return view('frontend.adPost.loadSubCat',compact('subCategory','lastStep'));
    }
    public function loadLastCat($id)
    {
        $lastCategory=LastStepCategory::where('status',1)->where('fk_sub_category_id',$id)->select('id','last_step_category_name')->orderBy('serial_num','ASC')->get();
        return view('frontend.adPost.loadLastStepCat',compact('lastCategory'));
    }
    public function loadArea($id)
    {
        $area=Area::where('status',1)->where('fk_division_id',$id)->orderBy('area_name','ASC')->pluck('area_name','id');
        return view('frontend.adPost.loadArea',compact('area'));
    }






}
