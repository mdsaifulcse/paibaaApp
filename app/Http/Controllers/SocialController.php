<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Model\SocialLink;
use App\Http\Requests;

class SocialController extends Controller
{
    
    function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $max_serial=SocialLink::max('serial_num');
        $allData= SocialLink::orderBy('serial_num','asc')->paginate(10);
        return view('backend.social.index', compact('allData','max_serial'));
            
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
                    'name' => 'required',
                    'link' => 'required|url',
                    'icon_class' => 'required',
                ]);
                if ($validator->fails()) {
                    return redirect('social-links')
                        ->withErrors($validator)
                        ->withInput();
                }
        $input = $request->all();
        //return $input;
        try{
        SocialLink::create($input);
        $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
         if($bug==0){
        return redirect()->back()->with('success','Data Successfully Inserted');
        }elseif($bug==1062){
            return redirect()->back()->with('error','The name has already been taken.');
        }else{
            return redirect()->back()->with('error','Something Error Found ! ');
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'link' => 'required|url',
                    'icon_class' => 'required',
                ]);
                if ($validator->fails()) {
                    return redirect('social-links')->with('error','Invalid or empty record found.');
                }
        $input=$request->all();
        $data=SocialLink::findOrFail($id);
        try{
            $data->update($input);
            $bug=0;
        }catch(\Exception $e){
            $bug = $e->errorInfo[1]; 
        }
        if($bug==0){
        return redirect()->back()->with('success','Data Successfully Updated');
        }elseif($bug==1062){
            return redirect()->back()->with('error','The name has already been taken.');
        }else{
            return redirect()->back()->with('error','Something Error Found ! ');
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
         $data=SocialLink::findOrFail($id);
        try{
            $data->delete();
            $bug=0;
            $error=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
            $error=$e->errorInfo[2];
        }
        if($bug==0){
       return redirect('social-links')->with('success','Data has been Successfully Deleted!');
        }elseif($bug==1451){
       return redirect('social-links')->with('error','This Data is Used anywhere ! ');

        }
        elseif($bug>0){
       return redirect('social-links')->with('error','Some thing error found !');

        }  

  }
}
