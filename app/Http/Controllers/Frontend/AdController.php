<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdPost;
use App\Models\AdPostComment;
use App\Models\AdPostLocation;
use App\Models\AdPostPrice;
use App\Models\AdPostSubCategory;
use App\Models\Category;
use App\Models\Location;
use App\Models\PriceNegotiation;
use App\Models\SubCategory;
use App\User;
use Illuminate\Http\Request;
use Validator,Auth,DB,DataLoad;

class AdController extends Controller
{
    public function categoryWiseAds(Request $request, $divisionLink,$catLink)
    {
        $category=Category::with('subCategoryData')->where(['link'=>$catLink])->first();
        if ($category==''){
            return redirect()->back()->with('error','Something went wrong on category !');
        }

        $location='bangladesh';
        if ($divisionLink!='' && $divisionLink!='bangladesh')
        {
            $location=Location::where('url',$divisionLink)->first();
        }
;
        if ($location==''){
            return redirect()->back()->with('error','Something went wrong on location !');
        }


        $category=Category::with('subCategoryData')->where(['link'=>$catLink])->first();
        if ($category==''){
            return redirect()->back()->with('error','Something went wrong on category !');
        }


        // category & sub-category wise ad count
         $adSubCategories=AdPostSubCategory::with('subCatByCat')
             ->leftJoin('ad_post','ad_post_sub_category.ad_post_id','ad_post.id')
             ->leftJoin('sub_category','ad_post_sub_category.sub_category_id','sub_category.id')
             ->leftJoin('sub_category_wise_ad_counts','sub_category_wise_ad_counts.sub_category_id','sub_category.id')
            ->select('ad_post_sub_category.sub_category_id')
            ->where('ad_post_sub_category.category_id',$category->id)->where(['ad_post.status'=>1,'ad_post.is_approved'=>1])
            ->groupBy('ad_post_sub_category.sub_category_id')->orderBy('sub_category_wise_ad_counts.total_ad','DESC')->limit(20)->get();


        // category & location wise ad count

        $categoryWiseLocations=AdPostLocation::with('locationByCat')
            ->leftJoin('ad_post','ad_post_locations.ad_post_id','ad_post.id')
            ->leftJoin('locations','ad_post_locations.location_id','locations.id')
            ->leftJoin('location_wise_ad_counts','location_wise_ad_counts.location_id','locations.id')
            ->select('ad_post_locations.location_id')
            ->where('ad_post_locations.category_id',$category->id)->where(['ad_post.status'=>1,'ad_post.is_approved'=>1])
            ->groupBy('ad_post_locations.location_id')->orderBy('location_wise_ad_counts.total_ad','DESC')->limit(20)->get();

//        foreach ($adSubCategories as $adSubCat){
//            return $adSubCat->subCatByCat->subCatPrices;
//        }


        $activeAds=AdPost::with('postAuthor','postCategory','postPhoto','adSubCategory','adLocation','adPostPrice','adPostLocation')
            ->select('ad_post.title','ad_post.price','ad_post.link','ad_post.id','ad_post.user_id','ad_post.category_id')
            ->where(['ad_post.is_approved'=>1,'ad_post.status'=>1,'ad_post.category_id'=>$category->id])
            ->orderBy('ad_post.id','DESC');

        if ($location!='bangladesh'){
            $activeAds=$activeAds->whereHas('adPostLocation',function ($q)use($location){
                $q->where('ad_post_locations.location_id',$location->id);
            });
        }

        // check sub-category
        $subCategoryInfo='';
        if (isset($request->subcategory) && $request->subcategory!=''){
            $subCategoryInfo=SubCategory::findOrFail($request->subcategory);

            $activeAds=$activeAds->leftJoin('ad_post_sub_category','ad_post_sub_category.ad_post_id','ad_post.id')
                ->where(['ad_post_sub_category.sub_category_id'=>$request->subcategory]);
        }


        // check price & price title
        if (isset($request->pricetitle) && $request->pricetitle!=''){

            $adPrice=AdPostPrice::where('price_title',$request->pricetitle)->first();
            if (empty($adPrice)){
                return redirect()->back()->with('error','Something went wrong, Try again later !');
            }else{

            $activeAds=$activeAds->leftJoin('ad_post_prices','ad_post_prices.ad_post_id','ad_post.id')
                ->where('ad_post_prices.price_title','LIKE','%'.$request->pricetitle.'%');
            }
        }
        //return $request;


        if ($request->catLink!='' && $request->by_playing_user!=''){
            $category = Category::where(['link' => $request->catLink])->first();

            if ($category == '') {return redirect()->back()->with('error', 'Something went wrong !');}

            $activeAds=$activeAds->where('ad_post.title','LIKE','%'.$request->by_playing_user.'%')
                ->orWhere('ad_post.tag','LIKE','%'.$request->by_playing_user.'%')
                ->where('ad_post.category_id',$category->id)->limit(24)->get();
        }elseif ($request->catLink=='' && $request->by_playing_user!=''){

            $activeAds=$activeAds->where('ad_post.title','LIKE','%'.$request->by_playing_user.'%')
                ->orWhere('ad_post.tag','LIKE','%'.$request->by_playing_user.'%')->limit(24)->get();
        }else{
            $activeAds=$activeAds->limit(24)->get();
        }


        return view('frontend.ad.index',compact('category','activeAds','adSubCategories','subCategoryInfo','categoryWiseLocations'));
    }


    public function getNavSubCategoryName(Request $request){
        //return $request->q;
        $category=Category::select('id')->where('category_name',$request->category)->first();

        return $subCategory=SubCategory::select('sub_category_name')->where('category_id',$category->id)
            ->where('sub_category_name', 'like', '%' .$request->q. '%')->pluck('sub_category_name');
    }

    public function getNavLocationData($category,Request $request){
        $category=Category::where('category_name',$category)->first();

        $categoryWiseLocations=AdPostLocation::with('locationByCat')
            ->leftJoin('ad_post','ad_post_locations.ad_post_id','ad_post.id')
            ->leftJoin('locations','ad_post_locations.location_id','locations.id')
            ->leftJoin('location_wise_ad_counts','location_wise_ad_counts.location_id','locations.id')
            ->select('ad_post_locations.location_id')
            ->where('locations.location_name', 'like', '%' . $request->locationKeyword . '%')
            ->where(['ad_post.status'=>1,'ad_post.is_approved'=>1])
            ->groupBy('ad_post_locations.location_id')->orderBy('location_wise_ad_counts.total_ad','DESC')->limit(30);

        if (!empty($category)) {
            $categoryWiseLocations=$categoryWiseLocations->where('ad_post_locations.category_id',$category->id);
        }

        $categoryWiseLocations=$categoryWiseLocations->get();

        return view('frontend.ad.search-nav-location',compact('category','categoryWiseLocations'));
    }


    public function getNavSubCategoryData($category,Request $request){
        $category=Category::where('category_name',$category)->first();

        $subCategoryInfo='';

        $adSubCategories=AdPostSubCategory::with('subCatByCat')
           ->leftJoin('ad_post','ad_post_sub_category.ad_post_id','ad_post.id')
            ->leftJoin('sub_category','ad_post_sub_category.sub_category_id','sub_category.id')
            ->leftJoin('sub_category_wise_ad_counts','sub_category_wise_ad_counts.sub_category_id','sub_category.id')
            ->select('ad_post_sub_category.sub_category_id')
            ->where('sub_category.sub_category_name', 'like', '%' . $request->catKeyword . '%')
            ->where(['ad_post.status'=>1,'ad_post.is_approved'=>1])
            ->groupBy('ad_post_sub_category.sub_category_id')->orderBy('sub_category_wise_ad_counts.total_ad','DESC')->limit(30);

        if (!empty($category)) {
            $adSubCategories = $adSubCategories->where('ad_post_sub_category.category_id',$category->id);
        }

        $adSubCategories=$adSubCategories->get();
        return view('frontend.ad.search-nav-subcategory',compact('category','adSubCategories','subCategoryInfo'));
    }

    public function singleAdDetails(Request $request, $adLink){

        $adDetails=AdPost::with('postCategory','adSubCategory','postAuthor','postPhoto','blogAnswers')
            ->where(['link'=>$adLink,'is_approved'=>1,'status'=>1])->first();
        if(empty($adDetails)){
            return redirect()->back()->with('error','Something went wrong ! Please Try Again Late');
        }

        $priceNegotiation='';
        $getChatReplayData=[];

        $getChatOfferData=[];
        $offerUsers=[];
        $currentChatUser=[];
        $offer='';
        if (Auth::check()){
            $priceNegotiation=PriceNegotiation::select('ad_post_id','request_by')->where(['request_by'=>Auth::user()->id,'ad_post_id'=>$adDetails->id])->first();

            // See Chat Replay Data  --------------------
            if ((isset($request->user) && isset($request->offer)) && decrypt($request->offer)==2 ){

                $offer=decrypt($request->offer);
                $currentChatUser=User::findOrFail(decrypt($request->user));
                $getChatReplayData=PriceNegotiation::with('priceNegotiationOfAds','offeredUser','replayUser')->orderBy('price_negotiations.id','DESC')
                    ->where(['request_by'=>Auth::user()->id,'request_to'=>$adDetails->user_id, 'ad_post_id'=>$adDetails->id])
                    ->get();

                PriceNegotiation::where(['request_by'=>Auth::user()->id,'offer'=>2,'ad_post_id'=>$adDetails->id])->update(['status'=>1]);
            }else{

                $getChatReplayData=PriceNegotiation::with('priceNegotiationOfAds','offeredUser','replayUser')->orderBy('price_negotiations.id','DESC')
                    ->where(['request_by'=>Auth::user()->id,'request_to'=>$adDetails->user_id, 'ad_post_id'=>$adDetails->id])->get();
                $offer=2;
                $currentChatUser=User::findOrFail($adDetails->user_id);
            }


            // See Offer Data ---------------
            if ((isset($request->user) && isset($request->offer)) && decrypt($request->offer)==1 ){

                $offer=decrypt($request->offer);
                $currentChatUser=User::findOrFail(decrypt($request->user));

                $getChatOfferData=PriceNegotiation::with('priceNegotiationOfAds','offeredUser','replayUser')->orderBy('price_negotiations.id','DESC')
                    ->where(['request_to'=>Auth::user()->id,'request_by'=>decrypt($request->user), 'ad_post_id'=>$adDetails->id])
                    ->get();

                $offerUsers=PriceNegotiation::leftJoin('users','price_negotiations.request_by','users.id')
                    //->select('users.name','users.id')
                    ->where(['request_to'=>Auth::user()->id, 'ad_post_id'=>$adDetails->id])
                    ->groupBy('users.id')->pluck('users.name','users.id');
                PriceNegotiation::where(['request_to'=>Auth::user()->id,'offer'=>1,'ad_post_id'=>$adDetails->id,'request_by'=>decrypt($request->user)])->update(['status'=>1]);

            }

        }


        $comments=AdPostComment::with('commentAuthor')->orderBy('id','DESC')
            ->select('user_id','comment','created_at')->where(['ad_post_id'=>$adDetails->id])->take(5)->get();
        $tags=[];
        if ($adDetails->tag!=''){
            //$tags=str_replace(' ','-',explode(',',$adDetails->tag));
            $tags=explode(',',$adDetails->tag);
        }
        $activeAds=AdPost::with('postCategory','adSubCategory','postPhoto')
            ->select('ad_post.title','ad_post.price','ad_post.link','ad_post.id','ad_post.category_id')
            ->where(['ad_post.is_approved'=>1,'ad_post.status'=>1,'ad_post.category_id'=>$adDetails->category_id])
            ->orderBy('ad_post.id','DESC')->limit(8)->get();

        //return $activeAds;
        if ($adDetails->postCategory->id==5){
            return view('frontend.ad.blog-details',compact('adDetails','priceNegotiation',
                'comments','getChatReplayData','offer','getChatOfferData','currentChatUser','offerUsers','tags','activeAds'));
        }


        return view('frontend.ad.details',compact('adDetails','priceNegotiation',
            'comments','getChatReplayData','offer','getChatOfferData','currentChatUser','offerUsers','tags','activeAds'));


    }

    public function loadBlogAnsById($ansEditId){


        return view('frontend.ad.editBlogAns',compact('ansEditId'));
    }




    public function viewAuthorAllAds($userName){

        $userProfile=User::with('userInfo')->where(['user_name'=>$userName])->first();
        if (empty($userProfile)){
            return redirect()->back()->with('error','Something went wrong !');
        }

        $activeAds=AdPost::with('postAuthor','postCategory','postPhoto','adSubCategory','adLocation','adPostPrice')
            ->select('ad_post.title','ad_post.price','ad_post.link','ad_post.id','ad_post.category_id')
            ->where(['ad_post.is_approved'=>1,'ad_post.status'=>1,'ad_post.user_id'=>$userProfile->id])
            ->orderBy('ad_post.id','DESC')->limit(8)->get();
        return view('frontend.ad.author-all-ads',compact('userProfile','activeAds'));
    }

    public function showAdsByAdPriceTitle($price,Request $request)
    {
        if ( !isset($request->cat))
        {
            return redirect()->back()->with('error','Something went wrong');
        }

       $category=Category::with('subCategoryData')->where('link',$request->cat)->first();

        if (empty($category))
        {
            return redirect('/')->with('error','Category is invalid');
        }

        $priceData='';
        $activePriceAds=[];
        if (isset($price) && $price!=''){
            $priceData=$price;
            $activePriceAds=AdPost::with('postAuthor','postCategory','postPhoto','adSubCategory','adLocation','adPostPrice')
                ->leftJoin('ad_post_prices','ad_post_prices.ad_post_id','ad_post.id')
                ->select('ad_post.title','ad_post.price','ad_post.link','ad_post.id','ad_post.category_id')
                ->where(['ad_post.category_id'=>$category->id,'ad_post.is_approved'=>1,'ad_post.status'=>1])->where('ad_post_prices.price_title','like','%'.$priceData.'%')
                ->orderBy('ad_post.id','DESC')->limit(20)->get();
        }

        if ( !count($activePriceAds)>0 ){
            return redirect()->back()->with('error','Something went wrong !');
        }

        // category & sub-category wise ad count
        $adSubCategories=AdPostSubCategory::with('subCatByCat')
            ->leftJoin('ad_post','ad_post_sub_category.ad_post_id','ad_post.id')
            ->leftJoin('sub_category','ad_post_sub_category.sub_category_id','sub_category.id')
            ->leftJoin('sub_category_wise_ad_counts','sub_category_wise_ad_counts.sub_category_id','sub_category.id')
            ->select('ad_post_sub_category.sub_category_id')
            ->where(['ad_post.status'=>1,'ad_post.is_approved'=>1])
            ->groupBy('ad_post_sub_category.sub_category_id')->orderBy('sub_category_wise_ad_counts.total_ad','DESC')->limit(30)->get();
        $subCategoryInfo='';

        $categoryWiseLocations=AdPostLocation::with('locationByCat')
            ->leftJoin('ad_post','ad_post_locations.ad_post_id','ad_post.id')
            ->leftJoin('locations','ad_post_locations.location_id','locations.id')
            ->leftJoin('location_wise_ad_counts','location_wise_ad_counts.location_id','locations.id')
            ->select('ad_post_locations.location_id')
            ->where('ad_post_locations.category_id',$category->id)->where(['ad_post.status'=>1,'ad_post.is_approved'=>1])
            ->groupBy('ad_post_locations.location_id')->orderBy('location_wise_ad_counts.total_ad','DESC')->limit(30)->get();


        return view('frontend.ad.price-ads',compact('activePriceAds','priceData','category','adSubCategories','subCategoryInfo','categoryWiseLocations'));
    }


    public function showAdsByAdTags($tag){

        $tagData='';
        $activeTagsAds=[];
        if (isset($tag) && $tag!='' ){
            $tagData=str_replace('-',' ',$tag);
            $activeTagsAds=AdPost::with('postAuthor','postCategory','postPhoto','adSubCategory','adLocation','adPostPrice')
                ->select('ad_post.title','ad_post.price','ad_post.link','ad_post.id','ad_post.category_id')
                ->where(['ad_post.is_approved'=>1,'ad_post.status'=>1])->where('tag','like','%'.$tagData.'%')
                ->orderBy('ad_post.id','DESC')->limit(8)->get();
        }


        if ( !count($activeTagsAds)>0 ){
            return redirect()->back()->with('error','Something went wrong !');
        }

        $category=Category::with('subCategoryData')->findOrFail($activeTagsAds[0]->category_id);

        // category & sub-category wise ad count
        $adSubCategories=AdPostSubCategory::with('subCatByCat')
            ->leftJoin('ad_post','ad_post_sub_category.ad_post_id','ad_post.id')
            ->leftJoin('sub_category','ad_post_sub_category.sub_category_id','sub_category.id')
            ->leftJoin('sub_category_wise_ad_counts','sub_category_wise_ad_counts.sub_category_id','sub_category.id')
            ->select('ad_post_sub_category.sub_category_id')
            ->where('ad_post_sub_category.category_id',$activeTagsAds[0]->category_id)->where(['ad_post.status'=>1,'ad_post.is_approved'=>1])
            ->groupBy('ad_post_sub_category.sub_category_id')->orderBy('sub_category_wise_ad_counts.total_ad','DESC')->limit(20)->get();
        $subCategoryInfo='';


//        $categories=AdPost::join('categories','ad_post.category_id','categories.id')
//            ->select('categories.link','categories.category_name')//->where(['ad_post.user_id'=>$userProfile->id])
//            ->groupBy('ad_post.category_id')->get();

        // category & location wise ad count

        $categoryWiseLocations=AdPostLocation::with('locationByCat')
            ->leftJoin('ad_post','ad_post_locations.ad_post_id','ad_post.id')
            ->leftJoin('locations','ad_post_locations.location_id','locations.id')
            ->leftJoin('location_wise_ad_counts','location_wise_ad_counts.location_id','locations.id')
            ->select('ad_post_locations.location_id')
            ->where('ad_post_locations.category_id',$category->id)->where(['ad_post.status'=>1,'ad_post.is_approved'=>1])
            ->groupBy('ad_post_locations.location_id')->orderBy('location_wise_ad_counts.total_ad','DESC')->limit(20)->get();


        return view('frontend.ad.tag-ads',compact('activeTagsAds','tagData','category','adSubCategories','subCategoryInfo','categoryWiseLocations'));
    }



    public function saveAdPostPublicComment(Request $request){

        return '1';
    }



}
