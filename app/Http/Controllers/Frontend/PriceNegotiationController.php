<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdPost;
use App\Models\PriceNegotiation;
use App\User;
use Illuminate\Http\Request;
use Validator,DB,Auth;

class PriceNegotiationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('auth');
    }

    public function index($adPostId,$offer,$userId)
    {

        $adDetails=AdPost::findOrFail($adPostId);

        $getChatReplayData=PriceNegotiation::with('priceNegotiationOfAds','offeredUser','replayUser')
            ->orderBy('price_negotiations.id','DESC');

        if($offer==1){
            $getChatReplayData= $getChatReplayData->where(['request_by'=>Auth::user()->id,'request_to'=>$adDetails->user_id, 'ad_post_id'=>$adDetails->id]);

        }elseif($offer==2){
            //return '2';
             $getChatReplayData= $getChatReplayData->where(['request_by'=>$userId,'request_to'=>Auth::user()->id, 'ad_post_id'=>$adDetails->id]);
        }

        $getChatReplayData= $getChatReplayData->get();

        return view('frontend.ad.load-chat-replay-data',compact('getChatReplayData'));

        //return response()->json($getChatReplayData);
    }


    public function getChatDataByPerson($adPostId,$userId){

        $getChatReplayData=PriceNegotiation::with('priceNegotiationOfAds','offeredUser','replayUser')
            ->orderBy('price_negotiations.id','DESC')
            ->where(['request_by'=>$userId,'request_to'=>Auth::user()->id, 'ad_post_id'=>$adPostId])->get();

        return view('frontend.ad.load-chat-replay-data',compact('getChatReplayData'));
    }


    public function loadChatUserData($userId){
        $userInfo=User::findOrFail($userId);
        return response()->json(['userInfo'=>$userInfo]);

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


        $adPostData=AdPost::FindOrFail($request->ad_post_id);

        $input=$request->all();

        if (!$request->price_title){
            return redirect()->back()->with('error','Al lease one price is required');
        }


        $validator=Validator::make($input,
            [
                'request_message'=>'required|max:250'
            ]
        );

        if ($validator->fails()){
            return redirect()->back()->with('error','Price & Request Message is required');
        }


        DB::beginTransaction();
        try{

            $price=0;
            $price_message='';
            foreach ($request->price_title as $priceTitle) {
                //$price_message='';
                $price_message.= "$priceTitle" . ' : ' . $request->offer_price[$priceTitle] . ',';

                $price+=$request->offer_price[$priceTitle];
            }

             $input['price']=$price;
             $input['price_message']=$price_message;


            $input['request_by']=Auth::user()->id;
            $input['request_to']=$adPostData->user_id;
            $input['offer']=1; // 1= Offer, 2= Replay

            PriceNegotiation::create($input);

            $bug=0;
            DB::commit();
            return redirect()->back()->with('success','Request Offer Successfully Send !');
        }catch(Exception $e){
            DB::rollback();
            $bug=$e->errorInfo[1];
            $error=$e->errorInfo[2];
        }
        if($bug==0){
            return redirect()->back()->with('success','Request Offer Successfully Send !');
        }elseif($bug==1451){
            return redirect()->back()->with('error','This ad is Used anywhere ! ');
        }
        elseif($bug>0){
            return redirect()->back()->with('error','Something error found !'.$error);

        }
    }


    public function saveChatMessage(Request $request){


        $adPostData=AdPost::FindOrFail($request->ad_post_id);

        $input=$request->all();

        //return $request;
        date_default_timezone_set('Asia/Dhaka');
        $input=$request->all();
        $validator = Validator::make($input, [
            'ad_post_id'=> 'required|exists:ad_post,id|numeric',
            'request_message'=> 'required|max:200',
            'offer'=>'required|integer|between:1,2',
            'user_id'=>'required|exists:users,id'

        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 403);
        }


        DB::beginTransaction();
        try{


            if ($request->offer==1){
                $input['request_by']=Auth::user()->id;
                $input['request_to']=$adPostData->user_id;

            }elseif($request->offer==2){
                $input['request_by']=$request->user_id;
                $input['request_to']=Auth::user()->id;
            }

            PriceNegotiation::create($input);

            $bug=0;
            DB::commit();
        }catch (\Exception $e){
            DB::rollback();
            $bug=$e->errorInfo[1];
            $bug1=$e->errorInfo[2];
        }


        if($bug==0){
            return response()->json('success',201);
        }else{
            return  response()->json('$bug1','500');
        }


    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PriceNegotiation  $priceNegotiation
     * @return \Illuminate\Http\Response
     */
    public function show(PriceNegotiation $priceNegotiation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PriceNegotiation  $priceNegotiation
     * @return \Illuminate\Http\Response
     */
    public function edit(PriceNegotiation $priceNegotiation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PriceNegotiation  $priceNegotiation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PriceNegotiation $priceNegotiation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PriceNegotiation  $priceNegotiation
     * @return \Illuminate\Http\Response
     */
    public function destroy(PriceNegotiation $priceNegotiation)
    {
        //
    }
}
