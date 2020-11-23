<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdPost;
use App\Models\AnswerReplay;
use Illuminate\Http\Request;
use Validator,Auth,DB;

class AnswerReplayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request){

    }


    public function saveBlogAnsReplay(Request $request)
    {


        if($request->user_id==''){
            $adPostData=AdPost::findOrFail($request->ad_post_id);
            return redirect('/ad/'.$adPostData->link)->with('success','You Successfully Log In');
        }


        if($request->answer_id=='' || $request->ad_post_id==''){
            return redirect()->back()->with('error','Something went wrong !');
        }

        date_default_timezone_set('Asia/Dhaka');
        $input=$request->all();
        $validator = Validator::make($input, [
            //'user_id'=> 'required|exists:users,id|numeric',
            'ad_post_id'=> 'required|exists:ad_post,id|numeric',
            'answer_id'=> 'required|exists:blog_answers,id|numeric',
            'replay'=> 'required|max:100'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 403);
        }

//        $replayData=AnswerReplay::where(['answer_id'=>$request->answer_id,'ad_post_id'=>$request->ad_post_id,'user_id'=>Auth::user()->id])
//            ->whereDate('created_at','=', date('Y-m-d'))->latest()->first();
//
//        if (!empty($replayData)){
//            return response()->json(['replayData'=>$replayData]);
//        }

        DB::beginTransaction();
        try{

            $input['user_id']= Auth::user()->id;
            AnswerReplay::create($input);

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
     * @param  \App\Models\AnswerReplay  $answerReplay
     * @return \Illuminate\Http\Response
     */
    public function show($ansId)
    {
        $ansReplay=AnswerReplay::with('replayAuthor')->orderBy('id','DESC')
            ->select('user_id','replay','created_at','id')->where(['answer_id'=>$ansId])->take(15)->get();

        return view('frontend.ad.load-ans-replay',compact('ansReplay','ansId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnswerReplay  $answerReplay
     * @return \Illuminate\Http\Response
     */
    public function edit(AnswerReplay $answerReplay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogAnswer  $answerReplay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnswerReplay $answerReplay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnswerReplay  $answerReplay
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

         $answerReplay=AnswerReplay::findOrFail($id);
        try{
            $answerReplay->delete();
            $bug=0;
            $error=0;
        }catch(\Exception $e){
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
