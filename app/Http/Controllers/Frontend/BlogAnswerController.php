<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdPost;
use App\Models\AnswerReplay;
use App\Models\BlogAnswer;
use Illuminate\Http\Request;
use Validator,Auth,DB;

class BlogAnswerController extends Controller
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'    => 'required|exists:users,id|numeric',
            'ad_post_id'    => 'required|exists:ad_post,id|numeric',
            'answer' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->all();

        try{
            $blogAnswer=BlogAnswer::where(['user_id'=>$request->user_id,'ad_post_id'=>$request->ad_post_id])->first();
            if (!empty($blogAnswer)){
                return redirect()->back()->with('error','Already you have answered');
            }

            BlogAnswer::create($input);
            $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
        if($bug==0){
            return redirect()->back()->with('success','Your answer successfully saved');
        }elseif($bug==1062){
            return redirect()->back()->with('error','The name has already been taken.');
        }else{
            return redirect()->back()->with('error','Something Error Found ! ');
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogAnswer  $blogAnswer
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogAnswer  $blogAnswer
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogAnswer $blogAnswer,Request $request)
    {

        if (!isset($request->ques)){
         return redirect()->with('error','Something went wrong !');
        }

        $adDetails=AdPost::findOrFail($request->ques);




        return view('frontend.ad.edit-answer',compact('blogAnswer','adDetails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogAnswer  $blogAnswer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogAnswer $blogAnswer)
    {
        //return $blogAnswer;

        $validator = Validator::make($request->all(), [
            'ad_post_id'=> 'required|exists:ad_post,id|numeric',
            'answer' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->all();

        try{

            $blogAnswer->update($input);
            $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
        if($bug==0){
            return redirect()->back()->with('success','Your answer successfully update');
        }elseif($bug==1062){
            return redirect()->back()->with('error','The name has already been taken.');
        }else{
            return redirect()->back()->with('error','Something Error Found ! ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogAnswer $blogAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogAnswer $blogAnswer)
    {

        try{
            $blogAnswer->delete();
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
