<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\SubCatWiseBrand;
use Validator,DB,Auth;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $allData=Brand::leftJoin('sub_category_wise_brands','sub_category_wise_brands.brand_id','brands.id')
           ->leftJoin('sub_category','sub_category_wise_brands.sub_category_id','sub_category.id')
           ->select('sub_category.sub_category_name','brands.*')
           ->orderBy('id','desc')->paginate(40);
        $category=Category::where('type',1)->where('status',1)->pluck('category_name','id');


//        foreach ($allData as $key => $value) {
//            $cat_name='';
//            $catName=SubCatWiseBrand::leftJoin('sub_category','sub_category_wise_brands.sub_category_id','sub_category.id')
//                ->select('sub_category.sub_category_name')->where('brand_id',$value->id)->get();
//            foreach ($catName as $catKey => $cat) {
//                $cat_name=$cat_name.(($catKey>0)?', ':'').$cat->sub_category_name;
//            }
//            $allData[$key]['category']=$cat_name;
//        }

        //return $allData;

        return view('backend.brand.index',compact('allData','category'));
    }


    protected function loadSubcategoryByCategory($categoryId){

        $subCategory=SubCategory::where('category_id',$categoryId)->pluck('sub_category_name','id');

        return view('backend.brand.loadSubCategory',compact('subCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                    'brand_name' => 'required',
                    'sub_category_id' => 'required',

                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

        DB::beginTransaction();
        try{
            $input = $request->all();
            $input['created_by']=\Auth::user()->id;

            $nameWithSpace=str_replace('_',' ', $input['brand_name']);

            $brand_name=explode(',',$nameWithSpace);
            for ($i=0; $i < sizeof($brand_name); $i++){
                $input['brand_name']=$brand_name[$i];
                $brand=Brand::create($input)->id;
                for ($j=0; $j <sizeof($input['sub_category_id']) ; $j++) {
                    SubCatWiseBrand::create([
                        'sub_category_id'=>$input['sub_category_id'][$j],
                        'brand_id'=>$brand,
                        'created_by'=>Auth::user()->id
                    ]);
                }
            }

            $bug=0;
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $bug=$e->errorInfo[1];
        }
         if($bug==0){
        return redirect()->back()->with('success','Brand Successfully Inserted');
        }elseif($bug==1062){
            return redirect()->back()->with('error','The name has already been taken.');
        }else{
            return redirect()->back()->with('error','Something Error Found ! ');
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
        return view('backend.brand.loadSubCategory',compact('subCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Brand::findOrFail($id);
        $categoryId=SubCatWiseBrand::leftJoin('sub_category','sub_category_wise_brands.sub_category_id','sub_category.id')
            ->where('brand_id',$id)->value('category_id');
        $existSubCat=SubCatWiseBrand::leftJoin('sub_category','sub_category_wise_brands.sub_category_id','sub_category.id')
            ->where('brand_id',$id)->pluck('sub_category_id');
        $subCategory=SubCategory::where('category_id',$categoryId)->where('status',1)->pluck('sub_category_name','id');
        $category=Category::where('type',1)->where('status',1)->pluck('category_name','id');
        return view('backend.brand.edit',compact('data','categoryId','existSubCat','subCategory','category'));
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
        $data=Brand::findOrFail($id);
         $validator = Validator::make($request->all(), [
                    'brand_name' => 'required',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->with('error','Duplicate or empty record found.');
                }
        $input=$request->all();
        $input['updated_by']=\Auth::user()->id;
        DB::beginTransaction();
        try{
            $existSubCat=SubCatWiseBrand::where('brand_id',$id)->delete();
            for ($j=0; $j <sizeof($input['sub_category_id']) ; $j++) {
                SubCatWiseBrand::create([
                    'sub_category_id'=>$input['sub_category_id'][$j],
                    'brand_id'=>$id,
                    'created_by'=>Auth::user()->id
                    ]);
            }
            $data->update($input);
            $bug=0;
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            $bug = $e->errorInfo[1]; 
        }
        if($bug==0){
        return redirect()->back()->with('success','Brand Successfully Updated');
        }elseif($bug==1062){
            return redirect()->back()->with('error','The name has already been taken.');
        }else{
            return redirect()->back()->with('error','Something Error Found ! '.$bug);
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

            $data=Brand::findOrFail($id);
            DB::beginTransaction();
        try{
            $existSubCat=SubCatWiseBrand::where('brand_id',$id)->delete();
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
