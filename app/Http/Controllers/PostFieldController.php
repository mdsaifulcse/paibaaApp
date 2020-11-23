<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostField;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\SubCatWiseField;
use Validator,DB,Auth;

class PostFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filed=['text','number','dropdown','textarea'];
        foreach ($filed as $fieldType) {
           $type[$fieldType]=ucwords($fieldType);
        }
        $allData=PostField::orderBy('id','desc')->paginate(40);
        $category=Category::where('type',1)->where('status',1)->pluck('category_name','id');
        
        
        
        foreach ($allData as $key => $value) {
           $cat_name='';
            $sub_cat_name='';
           $catName=SubCatWiseField::leftJoin('sub_category','sub_category_wise_field.sub_category_id','sub_category.id')
               ->leftJoin('categories','categories.id','sub_category.category_id')
               ->select('categories.category_name','sub_category.sub_category_name')->where('post_field_id',$value->id)->get();

           foreach ($catName as $catKey => $cat) {
            $sub_cat_name=$sub_cat_name.(($catKey>0)?', ':'').$cat->sub_category_name;
            $cat_name=$cat->category_name;
           }
          $allData[$key]['sub_category_name']=$sub_cat_name;
          $allData[$key]['category_name']=$cat_name;
        }
        //return $allData;
        return view('backend.postField.index',compact('allData','category','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.postField.loadValue');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       //return $request;

        $validator = Validator::make($request->all(), [
                    'title' => 'required',
                    'field_type' => 'required',
                    //'required' => 'required',
                    'value' => 'required_if:field_type,==,dropdown',
                    'category' => 'required',
                    'sub_category_id' => 'required',

                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
        $input = $request->all();
        $input['created_by']=\Auth::user()->id;
//        if($input['part_of']==null){
//            unset($input['part_of']);
//        }

        DB::beginTransaction();
        try{

        if ($request->user_on_filter==1){
            $input['required']='required';
        }

        $field=PostField::create($input)->id;

        for ($j=0; $j <sizeof($input['sub_category_id']) ; $j++) { 
            SubCatWiseField::create([
                'sub_category_id'=>$input['sub_category_id'][$j],
                'post_field_id'=>$field,
                'created_by'=>Auth::user()->id
                ]);
        }
            
        $bug=0;
        DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $bug=$e->errorInfo[1];
            $bug1=$e->errorInfo[2];
        }
         if($bug==0){
        return redirect()->back()->with('success','Data Successfully Inserted');
        }elseif($bug==1062){
            return redirect()->back()->with('error','The name has already been taken.');
        }else{
            return redirect()->back()->with('error','Something Error Found ! '.$bug1);
        }
    }

    /**
     * Category wise Sub category Load
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subCategory=SubCategory::where('fk_category_id',$id)->where('status',1)->pluck('sub_category_name','id');
        $partOf=SubCatWiseField::leftJoin('post_field','sub_category_wise_field.fk_post_field_id','post_field.id')->leftJoin('sub_category','sub_category_wise_field.fk_sub_category_id','sub_category.id')
            ->distinct()->where('sub_category.fk_category_id',$id)
            ->pluck('title','post_field.id');
        return view('backend.postField.loadSubCategory',compact('subCategory','partOf'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $filed=['text','number','dropdown','textarea'];
        foreach ($filed as $fieldType) {
            $type[$fieldType]=ucwords($fieldType);
        }

        $data=PostField::findOrFail($id);
        $categoryId=SubCatWiseField::leftJoin('sub_category','sub_category_wise_field.sub_category_id','sub_category.id')->where('post_field_id',$id)->value('category_id');

        $subCategory=SubCategory::where('category_id',$categoryId)->where('status',1)->pluck('sub_category_name','id');
        $existSubCat=SubCatWiseField::leftJoin('sub_category','sub_category_wise_field.sub_category_id','sub_category.id')
            ->where('post_field_id',$id)->pluck('sub_category_id');

        $category=Category::where('type',1)->where('status',1)->pluck('category_name','id');
        return view('backend.postField.edit',compact('data','categoryId','existSubCat','subCategory','category','type'));
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
        $data=PostField::findOrFail($id);
         $validator = Validator::make($request->all(), [
             'title' => 'required',
             'field_type' => 'required',
             //'required' => 'required',
             'value' => 'required_if:field_type,==,dropdown',
             'category' => 'required',
             'sub_category_id' => 'required',
                ]);
                if ($validator->fails()) {return redirect()->back()->with('error','Duplicate or empty record found.');}

        $input=$request->all();
        $input['updated_by']=\Auth::user()->id;

        DB::beginTransaction();
        try{



            $existSubCat=SubCatWiseField::leftJoin('sub_category','sub_category_wise_field.sub_category_id','sub_category.id')
                ->where('post_field_id',$id)->delete();
            for ($j=0; $j <sizeof($input['sub_category_id']) ; $j++) { 
                SubCatWiseField::create([
                    'sub_category_id'=>$input['sub_category_id'][$j],
                    'post_field_id'=>$id,
                    'created_by'=>Auth::user()->id,
                    'updated_by'=>Auth::user()->id,
                    ]);
            }

            if ($request->user_on_filter==1){
                $input['required']='required';
            }

            $data->update($input);
            $bug=0;
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $bug = $e->errorInfo[1]; 
        }
        if($bug==0){
        return redirect()->back()->with('success','Post Filed Successfully Updated');
        }elseif($bug==1062){
            return redirect()->back()->with('error','The name has already been taken.');
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

            $data=PostField::findOrFail($id);
            DB::beginTransaction();
        try{
            SubCatWiseField::where('post_field_id',$id)->delete();
            $data->delete();
            $bug=0;
            $error=0;
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $bug=$e->errorInfo[1];
            $error=$e->errorInfo[2];
        }
        if($bug==0){
       return redirect()->back()->with('success','Data has been Successfully Deleted!');
        }elseif($bug==1451){
       return redirect()->back()->with('error','This Data is Used anywhere ! ');

        }
        elseif($bug>0){
       return redirect()->back()->with('error','Some thing error found !');

        }
    }
}
