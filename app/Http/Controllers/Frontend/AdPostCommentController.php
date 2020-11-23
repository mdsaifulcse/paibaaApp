<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdPost;
use App\Models\AdPostComment;
use Illuminate\Http\Request;
use DB,Auth,Validator;

class AdPostCommentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($adPostId)
    {
        $comments=AdPostComment::with('commentAuthor')->orderBy('id','DESC')
            ->select('user_id','comment','created_at')->where(['ad_post_id'=>$adPostId])->take(15)->get();

        return view('frontend.ad.load-comments',compact('comments'));
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



    public function savePublicComment(Request $request){

        if($request->user_id==''){
            $adPostData=AdPost::findOrFail($request->ad_post_id);
            return redirect('/ad/'.$adPostData->link)->with('success','You Successfully Log In');
        }

        date_default_timezone_set('Asia/Dhaka');
        $input=$request->all();
        $validator = Validator::make($input, [
            //'user_id'=> 'required|exists:users,id|numeric',
            'ad_post_id'=> 'required|exists:ad_post,id|numeric',
            'comment'=> 'required|max:200'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 403);
        }

        $adPostComment=AdPostComment::where(['ad_post_id'=>$request->ad_post_id,'user_id'=>Auth::user()->id])
            ->whereDate('created_at','=', date('Y-m-d'))->latest()->first();

        if (!empty($adPostComment)){
            return response()->json(['adPostComment'=>$adPostComment]);
        }

        DB::beginTransaction();
        try{

            $input['user_id']= Auth::user()->id;
            AdPostComment::create($input);

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        return $request;
        return response()->json(['id'=>123],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdPostComment  $adPostComment
     * @return \Illuminate\Http\Response
     */
    public function show(AdPostComment $adPostComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdPostComment  $adPostComment
     * @return \Illuminate\Http\Response
     */
    public function edit(AdPostComment $adPostComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdPostComment  $adPostComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdPostComment $adPostComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdPostComment  $adPostComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdPostComment $adPostComment)
    {
        //
    }
}
