<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdPost;
use App\Models\AdPostArea;
use App\Models\AdPostComment;
use App\Models\AdPostLocation;
use App\Models\AdPostPrice;
use App\Models\AdPostSubCategory;
use App\Models\Area;
use App\Models\Category;
use App\Models\DivisionTown;
use App\Models\Location;
use App\Models\PostField;
use App\Models\PostFieldValue;
use App\Models\PostPhoto;
use App\Models\SubCategory;
use App\Models\SubCatWiseBrand;
use App\Models\SubCatWiseField;
use App\User;
use Illuminate\Http\Request;
use DB,Auth,Validator,DataLoad;

class AdPostController extends Controller
{

    public function getSubCategoryData(Request $request){
        //return $request->q;
        return $subCategory=SubCategory::select('sub_category_name')->where('category_id',$request->category_id)
            ->where('sub_category_name', 'like', '%' .$request->q. '%')->pluck('sub_category_name');
    }

    public function returnLocationData(Request $request){
        //return $request->q;
        return $subCategory=Location::select('location_name')
            ->where('location_name', 'like', '%' .$request->q. '%')->pluck('location_name');
    }

    public function returnAjaxData(Request $request){
        return $request;
        return ["Dhaka","Shylet","Barishal"];
    }

    public function myAllPost(){
        $adPost=AdPost::with('postCategory','postPhoto','adSubCategory','adLocation','postAuthor')->select('ad_post.*')
            ->where(['user_id'=>\Auth::user()->id])->orderBy('ad_post.id','DESC')
            ->paginate(20);
        return view('frontend.adPost.my-ads',compact('adPost'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->status!=1){
            return redirect('my-profile')->with('error','Your profile is not complete, Please update and complete your profile');
        }

        $categories=Category::select('id','category_name')->where('status',1)->orderBy('serial_num','asc')->get();
        return view('frontend.adPost.selectCategory',compact('categories'));
    }
    protected function loadSubCategory($categoryId){
        $subCategories=SubCategory::select('id','sub_category_name')->where('status',1)->orderBy('serial_num','asc')
            ->where('category_id',$categoryId)->get();
        return view('frontend.adPost.loadSubCategory',compact('subCategories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $categoryInfo=Category::where('categories.id',$request->cat_id)
        ->select('categories.category_name','categories.post_type','categories.id')->first();

        if (empty($categoryInfo)){
            return redirect('/ad-post')->with('error','Please Select Correct Category');
        }

        $userData=User::leftJoin('user_infos','user_infos.user_id','users.id')
            ->select('user_infos.*','users.*')->where('users.id',\Auth::user()->id)->first();

        return view('frontend.adPost.create',compact('categoryInfo','userData'));

    }

    protected function loadAreaByDivisionTown($divisionTown){
        //$areas=Area::where('division_town_id',$divisionTown)->orderBy('id','DESC')->pluck('area_name','id');
        $areas=DataLoad::areaData($divisionTown);
        return view('frontend.load-data.load-area',compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    function make_slug($string) {
        return preg_replace('/\s+/u', '-', trim($string));
    }


    public function store(Request $request)
    {

        date_default_timezone_set('Asia/Dhaka');
        $input=$request->except('sub_category_name','location','price_title','price');
        $link=str_replace(' , ', '-', $input['title']);
        $link=str_replace(', ', '-', $link);
        $link=str_replace(' ,', '-', $link);
        $link=str_replace(',', '-', $link);
        $link=str_replace('/', '-', $link);
        $link=rtrim($link,' ');
        $link=str_replace(' ', '-', $link);
        $link=str_replace('.', '', $link);
        $link=substr($link,0,30);
        $link=strtolower($link);
        if (strlen($input['title']) != strlen(utf8_decode($input['title']))){
            $link=substr($input['title'],0,80);
            $link=strtolower($link);
            $link= $this->make_slug($link);
        }

        $input['link']=$link.'-'.Auth::user()->id.'-'.date('ymdHis');

        if(isset($input['deliverable'])){
            $input['deliverable']=1;
        }else{
            $input['deliverable']=2;
        }

        $validator = Validator::make($input, [
            'category_id'    => 'required|exists:categories,id|numeric',
            'title'              => 'required|max:100',
            'address'            => 'required_if:category_id,!=5|max:120',
            'tag'                => 'nullable|max:100',
            'description'        => 'required|max:5000',
            'photo_one'          => 'nullable|image',
            'photo_two'          => 'image',
            'photo_three'        => 'image',
            'photo_four'         => 'image',
            'link'               => 'unique:ad_post',
            'delivery_fee'       => 'required_if:deliverable,==,1'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        DB::beginTransaction();
        try{

            $input['user_id']=Auth::user()->id;
            $input['created_by']=Auth::user()->id;

            if(isset($request->tag)) {
                $input['tag'] = $request->tag[0];
            }

            $input['price']=isset($request->price)?$request->price[0]:'';

            //return $input;
            $postId=AdPost::create($input)->id;


            if(isset($request->sub_category_name)) { // ad-post sub-category with category --------

                $subCates=explode(',',$request->sub_category_name[0]);

                $subCategorySize=sizeof($subCates);

                for ($i = 0; $i < $subCategorySize; $i++) {

                    $subCategory = SubCategory::firstOrCreate(['sub_category_name' =>$subCates[$i],'category_id'=>$request->category_id])->id;
                        AdPostSubCategory::create(
                            [
                                'sub_category_id'=>$subCategory,
                                'category_id'=>$request->category_id,
                                'ad_post_id'=>$postId,
                            ]
                        );

                    if (isset($request->price_title)){ // ad-post price with sub-category -------
                        $priceTitleSize = sizeof($request->price_title);

                        for ($j = 0; $j < $priceTitleSize; $j++) {
                            AdPostPrice::create([
                                'ad_post_id' => $postId,
                                'category_id' => $request->category_id,
                                'sub_category_id' => $subCategory,
                                'price_title' => $request->price_title[$j],
                                'price' => $request->price[$j],
                            ]);
                        }
                    } // end if price title ---
                } // end sub-category for ---
            }

            if(isset($request->location)){

                $locations=explode(',',$request->location[0]);

                $locationSize=sizeof($locations);

                for ($i=0; $i <$locationSize ; $i++) {

                    $location = Location::where(['location_name' =>$locations[$i]])->first();
                    if (empty($location)){
                        $link=str_replace(' , ', '-', $locations[$i]);
                        $link=str_replace(', ', '-', $link);
                        $link=str_replace(' ,', '-', $link);
                        $link=str_replace(',', '-', $link);
                        $link=str_replace('/', '-', $link);
                        $link=rtrim($link,' ');
                        $link=str_replace(' ', '-', $link);
                        $link=str_replace('.', '', $link);
                        $link=substr($link,0,50);
                        $link=strtolower($link);

                        $location=Location::create(['location_name'=>$locations[$i],'url'=>$link]);
                    }

                    AdPostLocation::create([
                        'location_id' => $location->id,
                        'category_id'=>$request->category_id,
                        'ad_post_id' => $postId,
                    ]);
                }
            }



            if ($request->hasFile('photo_one')) {
                $photoOnePath=\MyHelper::postPhotoUpload($request->file('photo_one'));
                $photoTwoPath='';
                $photoThreePath='';
                $photoFourPath='';
            if ($request->hasFile('photo_two')) { $photoTwoPath=\MyHelper::postPhotoUpload($request->file('photo_two')); }
            if ($request->hasFile('photo_three')) { $photoThreePath=\MyHelper::postPhotoUpload($request->file('photo_three')); }
            if ($request->hasFile('photo_four')) { $photoFourPath=\MyHelper::postPhotoUpload($request->file('photo_four')); }


                PostPhoto::create([
                    'ad_post_id'=>$postId,
                    'photo_one'=>$photoOnePath,
                    'photo_two'=>$photoTwoPath,
                    'photo_three'=>$photoThreePath,
                    'photo_four'=>$photoFourPath,
                ]);
            }else{
                PostPhoto::create([
                    'ad_post_id'=>$postId,
                    'photo_one'=>'no-photo',
                ]);
            }


            $bug=0;
            DB::commit();
        }catch (Exception $e){
            DB::rollback();
            $bug=$e->errorInfo[1];
            $bug1=$e->errorInfo[2];
        }


        if($bug==0){
            return redirect()->back()->with('success','Your Post Successfully Post & Waiting for Approval');
        }else{
            return redirect()->back()->with('error','Something Error Found ! '.$bug1);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {

        $adData=AdPost::with('adPostPrice')->findOrfail($id);

        $categoryInfo=Category::where('categories.id',$adData->category_id)
            ->select('categories.category_name','categories.post_type','categories.id')->first();

        if (empty($categoryInfo)){
            return redirect('/ad-post')->with('error','Please Select Correct Category');
        }

        $existPostSubCats=AdPostSubCategory::leftJoin('sub_category','ad_post_sub_category.sub_category_id','sub_category.id')
                    ->where('ad_post_sub_category.ad_post_id',$id)->select('sub_category.sub_category_name')
                    ->pluck('sub_category_name')->toArray();

        $existLocation=AdPostLocation::leftJoin('locations','ad_post_locations.location_id','locations.id')
            ->where('ad_post_locations.ad_post_id',$id)->select('locations.location_name')
            ->pluck('location_name')->toArray();


//        $division=DivisionTown::orderBy('id','DESC')->where('type',1)->pluck('division_town','id');
//        $towns=DivisionTown::orderBy('id','DESC')->where('type',2)->pluck('division_town','id');
//        $divisionTowns=['Town'=>$towns,'Division'=>$division];

        $existDivisionTownArea=[];

        return view('frontend.adPost.edit',compact('adData','categoryInfo','existPostSubCats','existLocation'));
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

        //return $request;
        $adData=AdPost::findOrFail($id);
        $input=$request->except('sub_category_name','location','price_title','price');

        if(isset($input['deliverable'])){
            $input['deliverable']=1;
        }else{
            $input['deliverable']=2;
        }


        date_default_timezone_set('Asia/Dhaka');

        $link=str_replace(' , ', '-', $input['title']);
        $link=str_replace(', ', '-', $link);
        $link=str_replace(' ,', '-', $link);
        $link=str_replace(',', '-', $link);
        $link=str_replace('/', '-', $link);
        $link=rtrim($link,' ');
        $link=str_replace(' ', '-', $link);
        $link=str_replace('.', '', $link);
        $link=substr($link,0,30);
        $link=strtolower($link);
        if (strlen($input['title']) != strlen(utf8_decode($input['title']))){
            $link=substr($input['title'],0,80);
            $link=strtolower($link);
            $link= $this->make_slug($link);
        }

        $input['link']=$link.'-'.Auth::user()->id.'-'.date('ymdHis');

        $validator = Validator::make($input, [
            'category_id'    => 'required|exists:categories,id|numeric',
            'title'              => 'required|max:100',
            'address'            => 'required_if:category_id,!=5|max:120',
            'tag'                => 'nullable|max:100',
            'description'        => 'required|max:5000',
            'photo_one'          => 'nullable|image',
            'photo_two'          => 'image',
            'photo_three'        => 'image',
            'photo_four'         => 'image',
            'link'               => 'unique:ad_post',
            'delivery_fee'       => 'required_if:deliverable,==,1'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //return $input;


        DB::beginTransaction();
        try{
            $input['updated_by']=Auth::user()->id;
            $input['is_approved']=2;

            if(isset($request->tag)) {
                $input['tag'] = $request->tag[0];
            }

            $input['price']=isset($request->price)?$request->price[0]:'';
            $adData->update($input);


            // --- relational table  start---

            if(isset($request->sub_category_name)) { // ad-post sub-category with category --------

                $adPostSubCatData=AdPostSubCategory::where(['ad_post_id'=>$id])->get();
                if (!empty($adPostSubCatData)){ // delete old data--
                    AdPostSubCategory::where(['ad_post_id'=>$id])->delete();
                }

                $subCates=explode(',',$request->sub_category_name[0]);

                $subCategorySize=sizeof($subCates);

                for ($i = 0; $i < $subCategorySize; $i++) {

                    $subCategory = SubCategory::firstOrCreate(['sub_category_name' =>$subCates[$i],'category_id'=>$request->category_id])->id;
                    AdPostSubCategory::create(
                        [
                            'sub_category_id'=>$subCategory,
                            'category_id'=>$request->category_id,
                            'ad_post_id'=>$adData->id,
                        ]
                    );


                    if (isset($request->price_title)){ // ad-post price with sub-category -------

                        $adPostPriceData=AdPostPrice::where(['ad_post_id'=>$id])->get();
                        if (!empty($adPostPriceData)){ // delete old data--
                            AdPostPrice::where(['ad_post_id'=>$id])->delete();
                        }

                        $priceTitleSize = sizeof($request->price_title);

                        for ($j = 0; $j < $priceTitleSize; $j++) {
                            AdPostPrice::create([
                                'ad_post_id' => $adData->id,
                                'category_id' => $request->category_id,
                                'sub_category_id' => $subCategory,
                                'price_title' => $request->price_title[$j],
                                'price' => $request->price[$j],
                            ]);
                        }
                    } // end if price title ---
                } // end sub-category for ---
            }

            if(isset($request->location)){

                $adPostPriceData=AdPostLocation::where(['ad_post_id'=>$id])->get();
                if (!empty($adPostPriceData)){ // delete old data--
                    AdPostLocation::where(['ad_post_id'=>$id])->delete();
                }

                $locations=explode(',',$request->location[0]);

                $locationSize=sizeof($locations);

                for ($i=0; $i <$locationSize ; $i++) {
                    $location = Location::where(['location_name' =>$locations[$i]])->first();
                   if (empty($location)){
                       $link=str_replace(' , ', '-', $locations[$i]);
                       $link=str_replace(', ', '-', $link);
                       $link=str_replace(' ,', '-', $link);
                       $link=str_replace(',', '-', $link);
                       $link=str_replace('/', '-', $link);
                       $link=rtrim($link,' ');
                       $link=str_replace(' ', '-', $link);
                       $link=str_replace('.', '', $link);
                       $link=substr($link,0,50);
                       $link=strtolower($link);

                       $location=Location::create(['location_name'=>$locations[$i],'url'=>$link]);
                   }


                    AdPostLocation::create([
                        'location_id' => $location->id,
                        'category_id'=>$request->category_id,
                        'ad_post_id' => $adData->id,
                    ]);
                }
            }


            // --- relational table  end  ---




            $adPhotos = PostPhoto::where(['ad_post_id' => $id])->first();
            $photoPaths=[];
            if ($request->hasFile('photo_one')) {
                $photoOnePath = \MyHelper::postPhotoUpload($request->file('photo_one'));
                if ($adPhotos->photo_one != '' && file_exists('images/post_photo/big/' . $adPhotos->photo_one) && file_exists('images/post_photo/small/' . $adPhotos->photo_one)) {
                    unlink('images/post_photo/big/' . $adPhotos->photo_one);
                    unlink('images/post_photo/small/' . $adPhotos->photo_one);
                }
                $photoPaths += ['photo_one' => $photoOnePath];
            }

                if ($request->hasFile('photo_two')) {
                    $photoTwoPath=\MyHelper::postPhotoUpload($request->file('photo_two'));
                    if ($adPhotos->photo_two!='' && file_exists('images/post_photo/big/'.$adPhotos->photo_two) && file_exists('images/post_photo/small/'.$adPhotos->photo_two)){
                        unlink('images/post_photo/big/'.$adPhotos->photo_two);
                        unlink('images/post_photo/small/'.$adPhotos->photo_two);
                    }
                    $photoPaths+= ['photo_two'=>$photoTwoPath];
                }

                if ($request->hasFile('photo_three')) {
                    $photoThreePath=\MyHelper::postPhotoUpload($request->file('photo_three'));
                    if ($adPhotos->photo_three!='' && file_exists('images/post_photo/big/'.$adPhotos->photo_three) && file_exists('images/post_photo/small/'.$adPhotos->photo_three)){
                        unlink('images/post_photo/big/'.$adPhotos->photo_three);
                        unlink('images/post_photo/small/'.$adPhotos->photo_three);
                    }
                    $photoPaths+=['photo_three'=>$photoThreePath];
                }
                if ($request->hasFile('photo_four')) {
                    $photoFourPath=\MyHelper::postPhotoUpload($request->file('photo_four'));
                    if ($adPhotos->photo_four!='' && file_exists('images/post_photo/big/'.$adPhotos->photo_four) && file_exists('images/post_photo/small/'.$adPhotos->photo_four)){
                        unlink('images/post_photo/big/'.$adPhotos->photo_four);
                        unlink('images/post_photo/small/'.$adPhotos->photo_four);
                    }
                    $photoPaths+= ['photo_four'=>$photoFourPath];
                }

                $adPhotos->update($photoPaths);



            $bug=0;
            DB::commit();
        }catch (Exception $e){
            DB::rollback();
            $bug=$e->errorInfo[1];
            $bug1=$e->errorInfo[2];
        }


        if($bug==0){
            return redirect()->back()->with('success','Ad Info Successfully Update & Waiting for Review');
        }else{
            return redirect()->back()->with('error','Something Error Found ! '.$bug1);
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
        $data=AdPost::FindOrFail($id);

        DB::beginTransaction();
        try{

            $postPrice=AdPostPrice::where(['ad_post_id'=>$data->id])->get();
            if (!empty($postPrice)){ // ad post prices delete-----------
                AdPostPrice::where(['ad_post_id'=>$data->id])->delete();
            }

            $postSubCategory=AdPostSubCategory::where(['ad_post_id'=>$data->id])->get();
            if (!empty($postSubCategory)){// ad post sub-categories delete -----------
                AdPostSubCategory::where(['ad_post_id'=>$data->id])->delete();
            }

            $postLocations=AdPostLocation::where(['ad_post_id'=>$data->id])->get();
            if (!empty($postLocations)){ // ad post location delete -----------
                AdPostLocation::where(['ad_post_id'=>$data->id])->delete();
            }

            $adPosLocation=AdPostComment::where(['ad_post_id'=>$data->id])->get();
            if (!empty($adPosLocation)){ // ad post comment delete -----------
                AdPostComment::where(['ad_post_id'=>$data->id])->delete();
            }


            $adPhotos=PostPhoto::where(['ad_post_id'=>$data->id])->first();

            if (!empty($adPhotos)){

                if ($adPhotos->photo_one!='' &&file_exists('images/post_photo/big/'.$adPhotos->photo_one) && file_exists('images/post_photo/small/'.$adPhotos->photo_one)){
                    unlink('images/post_photo/big/'.$adPhotos->photo_one);
                    unlink('images/post_photo/small/'.$adPhotos->photo_one);
                }
                if ($adPhotos->photo_two!='' && file_exists('images/post_photo/big/'.$adPhotos->photo_two) && file_exists('images/post_photo/small/'.$adPhotos->photo_two)){
                    unlink('images/post_photo/big/'.$adPhotos->photo_two);
                    unlink('images/post_photo/small/'.$adPhotos->photo_two);
                }
                if ($adPhotos->photo_three!='' && file_exists('images/post_photo/big/'.$adPhotos->photo_three) && file_exists('images/post_photo/small/'.$adPhotos->photo_three )){
                    unlink('images/post_photo/big/'.$adPhotos->photo_three);
                    unlink('images/post_photo/small/'.$adPhotos->photo_three);
                }
                if ($adPhotos->photo_four!='' && file_exists('images/post_photo/big/'.$adPhotos->photo_four) && file_exists('images/post_photo/small/'.$adPhotos->photo_four)){
                    unlink('images/post_photo/big/'.$adPhotos->photo_four);
                    unlink('images/post_photo/small/'.$adPhotos->photo_four);
                }
                if ($adPhotos->photo_five!='' && file_exists('images/post_photo/big/'.$adPhotos->photo_five) && file_exists('images/post_photo/small/'.$adPhotos->photo_five)){
                    unlink('images/post_photo/big/'.$adPhotos->photo_five);
                    unlink('images/post_photo/small/'.$adPhotos->photo_five);
                }
            }
            $adPhotos->delete();

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
            return redirect()->back()->with('success','Ad Successfully Deleted!');
        }elseif($bug==1451){
            return redirect()->back()->with('error','This ad is Used anywhere ! ');
        }
        elseif($bug>0){
            return redirect()->back()->with('error','Some thing error found !'.$error);

        }
    }
}
