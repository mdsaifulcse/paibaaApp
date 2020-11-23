<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Page;
use App\Models\PriceNegotiation;
use Illuminate\Support\ServiceProvider;
use App\Models\PrimaryInfo;
use App\Models\Menu;
use App\Models\MenuSetting;
use App\Models\ImportantLinks;
use App\Models\SocialIcon;
use App\Models\BgImage;
use View,MyHelper;
use App\Models\Notification;
use DB;
use Auth;
use App\Models\NotificationRead;

class OrganaizitionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            [
                'frontend._partials.header',
            ],

            function ($view){
                $categoryArr=Category::orderBy('serial_num','ASC')->where(['status'=>1])->pluck('category_name','link');

                $categories=Category::select('id','category_name','link','post_type')->orderBy('serial_num','ASC')->where(['status'=>1])->get();
                $notification=[];
                $countUnreadMessage=0;

                if (Auth::check()){

                    $requestArr=[];
                    $requestArr=PriceNegotiation::with('offeredUser')->leftJoin('ad_post','price_negotiations.ad_post_id','ad_post.id')
                        ->select('price_negotiations.*','ad_post.link','ad_post.title')
                        ->where('price_negotiations.request_to',Auth::user()->id)
                        ->where(['offer'=>1])->orderBy('id','DESC')->get()->toArray(); //'price_negotiations.status'=>0,

                    $replayArr=[];
                    $replayArr=PriceNegotiation::with('replayUser')->leftJoin('ad_post','price_negotiations.ad_post_id','ad_post.id')
                        ->select('price_negotiations.*','ad_post.link','ad_post.title')
                        ->where('price_negotiations.request_by',Auth::user()->id)
                        ->where(['offer'=>2])->orderBy('id','DESC')->get()->toArray(); //'price_negotiations.status'=>0,

                    $notification=array_merge($requestArr,$replayArr);

                    if (count($notification)>0){
                        foreach ($notification as $key=>$data){

                            if ($data['status']==0){
                                $countUnreadMessage+=1;
                            }
                        }
                    }
                }

                $view->with(['categories'=>$categories,'categoryArr'=>$categoryArr,'countUnreadMessage'=>$countUnreadMessage,'notification'=>$notification]); //
            }
            );


        View::composer( // primary info in home page
            [

                'home',
                'frontend._partials.header',
                'backend.app',
                'backend.index',
                'backend.student.edit-student-form',
                'auth.master',

            ],function ($view){

            $info = PrimaryInfo::first();

            $view->with(['info'=>$info,]);

        });

              View::composer( // about info in home page $ footer
            [

                'home',
                'frontend._partials.footer',
                'frontend.contact.about',



            ],function ($view){

            $about = PrimaryInfo::first();
            $footerPage=Page::orderBy('id','ASC')->where(['status'=>'1'])->get();

            $view->with(['about'=>$about,'footerPage'=>$footerPage]);

        });



        View::composer( // Main menu supply to menu bar
            [
                'backend._partials.sidebar',
                'backend.home.footerIconMenu',
            ],function ($view){
                $menus=Menu::with('subMenu')->orderBy('serial_num','asc')->where(['status'=>1,'type'=>1])->get();
                $view->with('menus',$menus);
        });

//        View::composer( //menu setting style add header
//            [
//                'frontend._partials.header'
//            ],function ($view){
//            $menusetting=MenuSetting::first();
//            $view->with('menusetting',$menusetting);
//        });

               View::composer( //importantlink add footer
            [
                //'frontend._partials.footer'
            ],function ($view){
            $importants=ImportantLinks::orderBY('id','ASC')->get();
            $view->with('importants',$importants);
        });

                View::composer( //social icon add footer
            [
                //'frontend._partials.footer'
            ],function ($view){
            $socials=SocialIcon::orderBY('id','ASC')->get();
            $view->with('socials',$socials);
        });

           View::composer( //bg iimage add footer
            [
                //'frontend._partials.header',
                'home'
            ],function ($view){
            $img=BgImage::first();
            $view->with('img',$img);
        });



    }
}
