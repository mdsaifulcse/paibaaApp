<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdPost;
use App\Models\Category;
use App\Models\Location;
use App\Models\Page;
use App\Models\PriceNegotiation;
use Illuminate\Http\Request;
use Auth,DB,Validator,Session,DataLoad;

class PaibaController extends Controller
{
    public function index(Request $request){

        if (Session::has('odRf')){ // when login for order or request ---
            return redirect(Session::get('odRf'));
        }

        //return $request;
        $activeAds=AdPost::with('postCategory','postPhoto','adSubCategory','adLocation')
            ->select('ad_post.title','ad_post.price','ad_post.link','ad_post.id','ad_post.category_id')
            ->where(['ad_post.is_approved'=>1,'ad_post.status'=>1])
            ->orderBy('ad_post.id','DESC');


        if ($request->catLink!='' && $request->by_playing_user!=''){
            $category = Category::where(['link' => $request->catLink])->first();

            if ($category == '') {return redirect()->back()->with('error', 'Something went wrong !');}

            $activeAds=$activeAds->where('ad_post.title','LIKE','%'.$request->by_playing_user.'%')
                ->orWhere('ad_post.tag','LIKE','%'.$request->by_playing_user.'%')
                ->where('ad_post.category_id',$category->id)->limit(12)->get();
        }elseif ($request->catLink=='' && $request->by_playing_user!=''){

            $activeAds=$activeAds->where('ad_post.title','LIKE','%'.$request->by_playing_user.'%')
                ->orWhere('ad_post.tag','LIKE','%'.$request->by_playing_user.'%')->limit(12)->get();
        }else{
            $activeAds=$activeAds->limit(12)->get();
        }


        return view('frontend.home.index',compact('activeAds'));

    }


    public function singlePageDetail($pageLink){

        $pageDetails=Page::where(['link'=>$pageLink,'status'=>1])->first();

        if (empty($pageDetails)){
            return redirect()->back()->with('error','Something went wrong on page !');
        }

        return view('frontend.page.details',compact('pageDetails'));


    }



}
