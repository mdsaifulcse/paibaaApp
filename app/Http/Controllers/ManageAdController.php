<?php

namespace App\Http\Controllers;

use App\Models\AdPostArea;
use App\Models\AdPostComment;
use App\Models\AdPostLocation;
use App\Models\AdPostPrice;
use App\Models\AdPostSubCategory;
use App\Models\Category;
use App\Models\CategoryWiseAdCount;
use App\Models\Location;
use App\Models\LocationWiseAdCount;
use App\Models\PostPhoto;
use App\Models\PriceNegotiation;
use App\Models\SubCategoryWiseAdCount;
use Illuminate\Http\Request;
use App\Models\AdPost;
use App\Models\SubCategory;
use App\Models\SubCatWiseBrand;
use App\Models\SubCatWiseField;
use App\Models\PostFieldValue;
use DB,Auth,URL, Validator,Image,DataLoad;
use Yajra\DataTables\DataTables;

class ManageAdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adPost=AdPost::with('adSubCategory','postAuthor')->select('ad_post.*')
            ->where(['is_approved'=>2])->orderBy('ad_post.id','DESC')
            ->paginate(20);
        return view('backend.ad.index',compact('adPost'));
    }

    public function allAds(){
        return view('backend.ad.all-ads');
    }

    public function showAllAds(){
        $allApprovedAds=AdPost::leftJoin('users','users.id','ad_post.user_id')
        //->leftJoin('sub_category','sub_category.id','ad_post.sub_category_id')
        ->leftJoin('categories','categories.id','ad_post.category_id')
        ->leftJoin('post_photos','ad_post.id','post_photos.ad_post_id')
            ->select('users.name','users.mobile','categories.category_name','post_photos.photo_one','ad_post.*')
            ->orderBy('ad_post.id','DESC')->where(['is_approved'=>1]);

        return DataTables::of($allApprovedAds)
            ->addIndexColumn()
            ->addColumn('DT_RowIndex','')
            ->addColumn('Photo','<img src="{{asset(\'images/post_photo/small/\'.$photo_one)}}" style="width: 60px" alt=" Paibaa | Shob Paibaa">')
            ->addColumn('Status','<span>
                         @if($status==1) 
                         <a href="{{URL::to(\'change-ad-status/\'.$status.\'/\'.$id)}}" title="Click here to Inactive this Ad" class="btn btn-success">Active</a>
                          @else
                          <a href="{{URL::to(\'change-ad-status/\'.$status.\'/\'.$id)}}" title="Click here to Active this Ad" class="btn btn-warning">Inactive</a>
                           @endif 
                         </span>'
            )
            ->addColumn('CreatedAt','<span><?php echo date(\'d-M-Y\',strtotime($created_at));?></span>')
            ->addColumn('Action','
                <div class="dropdown">
              <button class="no-padding" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu action-dropdown" aria-labelledby="dLabel">
                
                <li>
                <a  href="{{URL::to(\'manage-ad/\'.$id)}}/edit" title="Click here to update ad information" class="btn btn-warning btn-xs" style="display: inline-flex;
padding: 3px 5px;"><i class="fa fa-pencil"></i>Edit</a>
                </li>
                <li>
                    {!!Form::open(array(\'route\'=>[\'manage-ad.destroy\',"$id"],\'method\'=>\'DELETE\',\'id\'=>"deleteForm$id"))!!}
                        <button type="button" class="btn btn-danger btn-xs" onclick="return deleteConfirm(\'deleteForm{{$id}}\')"><i class="fa fa-trash"></i> Delete</button>
                    {!! Form::close() !!}
                </li>
              </ul>
          </div>
            ')
    ->rawColumns(['DT_RowIndex','Photo','CreatedAt','Status','Action'])
    ->toJson();

    }


    public function changeAdStatus($status, $id){

        if ($status==0 || $status==1){
            if ($status==0){
                $statusText='Active';
                $changeStatus=1;
            }else{
                $statusText='Inactive';
                $changeStatus=0;
            }
        }else{
            return redirect()->back()->with('error','Something went wrong !');
        }



        try{
            AdPost::findOrFail($id)->update(
            [
                'status'=>$changeStatus,
            ]);

            $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            $bug1=$e->errorInfo[2];
        }

        if($bug==0){
            return redirect()->back()->with('success','Ad Successfully '.$statusText);
        }else{
            return redirect()->back()->with('error','Something Error Found ! '.$bug1);
        }

    }



    public function published()
    {
        $adPost=AdPost::leftJoin('post_photo','ad_post.id','post_photo.fk_post_id')
            ->leftJoin('sub_category','ad_post.fk_sub_category_id','sub_category.id')
            ->leftJoin('category','sub_category.fk_category_id','category.id')
            ->leftJoin('users','ad_post.created_by','users.id')
            ->leftJoin('users as approved','ad_post.approved_by','approved.id')
            ->leftJoin('last_step_category','ad_post.fk_last_step_id','last_step_category.id')
            ->leftJoin('user_type','users.type','user_type.id')
            ->where('ad_post.is_approved',1)
            ->where('ad_post.type','!=',3)
            ->select('ad_post.*','sub_category_name','last_step_category_name','post_photo.photo_one','category.name as cat_name','users.name as creator','approved.name as approver_name','user_type.type_name')
            ->orderBy('ad_post.id','DESC')
            ->paginate(20);
        return view('backend.ad.index',compact('adPost'));
    }
    public function jobs()
    {
        $adPost=AdPost::leftJoin('post_photo','ad_post.id','post_photo.fk_post_id')
            ->leftJoin('sub_category','ad_post.fk_sub_category_id','sub_category.id')
            ->leftJoin('category','sub_category.fk_category_id','category.id')
            ->leftJoin('users','ad_post.created_by','users.id')
            ->leftJoin('users as approved','ad_post.approved_by','approved.id')
            ->leftJoin('last_step_category','ad_post.fk_last_step_id','last_step_category.id')
            ->leftJoin('user_type','users.type','user_type.id')
            ->where('ad_post.is_approved','!=',1)
            ->where('ad_post.type',3)
            ->select('ad_post.*','sub_category_name','last_step_category_name','post_photo.photo_one','category.name as cat_name','users.name as creator','approved.name as approver_name','user_type.type_name')
            ->orderBy('ad_post.id','DESC')
            ->paginate(20);
        return view('backend.ad.index',compact('adPost'));
    }
    public function publishedJobs()
    {
        $adPost=AdPost::leftJoin('post_photo','ad_post.id','post_photo.fk_post_id')
            ->leftJoin('sub_category','ad_post.fk_sub_category_id','sub_category.id')
            ->leftJoin('category','sub_category.fk_category_id','category.id')
            ->leftJoin('users','ad_post.created_by','users.id')
            ->leftJoin('users as approved','ad_post.approved_by','approved.id')
            ->leftJoin('last_step_category','ad_post.fk_last_step_id','last_step_category.id')
            ->leftJoin('user_type','users.type','user_type.id')
            ->where('ad_post.is_approved',1)
            ->where('ad_post.type',3)
            ->select('ad_post.*','sub_category_name','last_step_category_name','post_photo.photo_one','category.name as cat_name','users.name as creator','approved.name as approver_name','user_type.type_name')
            ->orderBy('ad_post.id','DESC')
            ->paginate(20);
        return view('backend.ad.index',compact('adPost'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        AdPost::findOrFail($request->id);
        $adPost= AdPost::where('id',$request->id)->update([
            'is_approved'=>1,
            'status'=>1,
            'approved_by'=>Auth::user()->id,
        ]);
        try{
            $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            $bug1=$e->errorInfo[2];
        }
        if($bug==0){
            return redirect('manage-ad')->with('success','Successfully Updated');
        }else{
            return redirect()->back()->with('error','Something Error Found ! '.$bug1);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
    public function edit($id)
    {

        $adData=AdPost::with('adPostPrice','postAuthor')->findOrfail($id);

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


        return view('backend.ad.edit',compact('adData','categoryInfo','existPostSubCats','existLocation'));

    }

    protected function loadAreaByDivisionTown($divisionTown){
        //$areas=Area::where('division_town_id',$divisionTown)->orderBy('id','DESC')->pluck('area_name','id');
        $areas=DataLoad::areaData($divisionTown);
        return view('backend.load-data.load-area',compact('areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    function make_slug($string) {
        return preg_replace('/\s+/u', '-', trim($string));
    }

    public function generateLink($title, $authId=null)
    {
        if(strlen($title) != mb_strlen($title, 'utf-8'))
        {
            $title=date('dmyHis');
        }


        $link=str_replace(' , ', '-', $title);
        $link=str_replace(', ', '-', $link);
        $link=str_replace(' ,', '-', $link);
        $link=str_replace(',', '-', $link);
        $link=str_replace('/', '-', $link);
        $link=rtrim($link,' ');
        $link=str_replace(' ', '-', $link);
        $link=str_replace('.', '', $link);
        $link=str_replace('?', '-', $link);
        $link=str_replace('?', '-', $link);
        $link=str_replace('&', '-', $link);
        $link=substr($link,0,30);
        $link=strtolower($link);

        if (strlen($title) != strlen(utf8_decode($title))){
            $link=substr($title,0,80);
            $link=strtolower($link);
            $link= $this->make_slug($link);
        }

        if ($authId!=null)
        {
            return $link.'-'.$authId;
        }else{
            return $link;
        }
    }


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

        $input['link']= $this->generateLink($input['title'],Auth::user()->id);

        $validator = Validator::make($input, [
            'category_id'    => 'required|exists:categories,id|numeric',
            'title'              => 'required|max:100',
            'address'            => 'nullable|max:120',//'required_if:category_id,!=5|max:120',
            'tag'                => 'nullable|max:100',
            'description'        => 'required|max:5000',
            'photo_one'          => 'nullable|image',
            'photo_two'          => 'image',
            'photo_three'        => 'image',
            'photo_four'         => 'image',
            'link'               => "unique:ad_post,link,$id",
            'delivery_fee'       => 'required_if:deliverable,==,1'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        DB::beginTransaction();
        try{

            $input['updated_by']=Auth::user()->id;

            if(isset($request->tag)) {
                $input['tag'] = $request->tag[0];
            }

            $input['price']=isset($request->price)?$request->price[0]:'';


            // --- relational table  start---


            // category wise ad count --------
            $categoryTotalAds=CategoryWiseAdCount::where('category_id',$adData->category_id)->first();
            if (($request->status==0 Or $request->is_approved==2) And ($adData->status==1 Or $adData->is_approved==1)){ // inactive or pending

                if (!empty($categoryTotalAds)){
                    $categoryTotalAds->update(['total_ad'=>$categoryTotalAds->total_ad-1]);
                }

            }elseif(($request->status==1 Or $request->is_approved==1) And ($adData->status==0 Or $adData->is_approved==2)){ // active or published

                if (!empty($categoryTotalAds)){
                    $categoryTotalAds->update(['total_ad'=>$categoryTotalAds->total_ad+1]);
                }else{
                    CategoryWiseAdCount::create(['category_id'=>$adData->category_id,'total_ad'=>1]);
                }

            } // end category ad count



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
                    // sub-category wise ad count --------
                    $subCatTotalAds=SubCategoryWiseAdCount::where('sub_category_id',$subCategory)->first();
                    if (($request->status==0 Or $request->is_approved==2) And ($adData->status==1 Or $adData->is_approved==1)){ // inactive or pending

                        if (!empty($subCatTotalAds)){
                            $subCatTotalAds->update(['total_ad'=>$subCatTotalAds->total_ad-1]);
                        }

                    }elseif(($request->status==1 Or $request->is_approved==1) And ($adData->status==0 Or $adData->is_approved==2)){ // active or published

                        if (!empty($subCatTotalAds)){
                            $subCatTotalAds->update(['total_ad'=>$subCatTotalAds->total_ad+1]);
                        }else{
                            SubCategoryWiseAdCount::create(['sub_category_id'=>$subCategory,'total_ad'=>1]);
                        }

                    } // end sub-category ad count


                    if (isset($request->price_title) && isset($request->price)){ // ad-post price with sub-category -------

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

                        $link=$this->generateLink($locations[$i]);

                        $location=Location::create(['location_name'=>$locations[$i],'url'=>$link]);
                    }


                    AdPostLocation::create([
                        'location_id' => $location->id,
                        'category_id'=>$request->category_id,
                        'ad_post_id' => $adData->id,
                    ]);

                    // location wise ad count --------
                    $locationTotalAds=LocationWiseAdCount::where('location_id',$location->id)->first();
                    if (($request->status==0 Or $request->is_approved==2) And ($adData->status==1 Or $adData->is_approved==1)){// inactive or pending

                        if (!empty($locationTotalAds)){
                            $locationTotalAds->update(['total_ad'=>$locationTotalAds->total_ad-1]);
                        }

                    }elseif(($request->status==1 Or $request->is_approved==1) And ($adData->status==0 Or $adData->is_approved==2)){ // active or published

                        if (!empty($locationTotalAds)){
                            $locationTotalAds->update(['total_ad'=>$locationTotalAds->total_ad+1]);
                        }else{
                            LocationWiseAdCount::create(['location_id'=>$location->id,'total_ad'=>1]);
                        }

                    } // end location ad count
                } // end for ---
            }


            // --- relational table  end  ---


            $adData->update($input);

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
            return redirect()->back()->with('success','Ad Data Successfully Update');
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
