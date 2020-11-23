<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB,Auth,Validator;
use App\Http\Requests;
use App\Models\Category;

class CategoryController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function index(Request $request)
    {
        $url=$request->path();
        $type=($url=='category')?'1':'2';
        $max_serial=Category::where('type',$type)->max('serial_num');
        $allData=Category::where('type',$type)->orderBy('id','desc')->paginate(10);
        return view('backend.category.index',compact('allData','max_serial','type','url'));
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
        $input = $request->all();
        $link=str_replace(' , ', '-', $input['category_name']);
        $link=str_replace(', ', '-', $link);
        $link=str_replace(' ,', '-', $link);
        $link=str_replace(',', '-', $link);
        $link=str_replace('/', '-', $link);
        $link=rtrim($link,' ');
        $link=str_replace(' ', '-', $link);
        $link=str_replace('.', '', $link);
        $link=substr($link,0,50);
        $link=strtolower($link);
        $input['link']=$link;
        if($input['type']==2){
            $input['link']=$link.'2';
        }
        $validator = Validator::make($input, [
                    'category_name' => 'required',
                    'link' => 'required|unique:categories',
                   
                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
        $input['created_by']=\Auth::user()->id;

        if ($request->hasFile('icon_photo')) {

            $input['icon_photo']=\MyHelper::photoUpload($request->file('icon_photo'),'images/categories/',120,100);

        }
        Category::create($input);
        try{
        $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
         if($bug==0){
        return redirect()->back()->with('success','Category Successfully Created');
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
        $allData=Category::orderBy('id','desc')->paginate(10);
        return view('backend.category.memberCategory',compact('allData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data=Category::findOrFail($id);
        $max_serial=Category::where('type',$data->type)->max('serial_num');
        $url=\Request::path();
        $url=explode('/',$url);
        $url= $url[0];
        return view('backend.category.edit',compact('data','max_serial','url'));
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
        $input = $request->all();
        $link=str_replace(' , ', '-', $input['category_name']);
        $link=str_replace(', ', '-', $link);
        $link=str_replace(' ,', '-', $link);
        $link=str_replace(',', '-', $link);
        $link=str_replace('/', '-', $link);
        $link=rtrim($link,' ');
        $link=str_replace(' ', '-', $link);
        $link=str_replace('.', '', $link);
        $link=substr($link,0,40);
        $link=strtolower($link);
        $input['link']=$link;

        $data=Category::findOrFail($id);

         $validator = Validator::make($input, [
                    'category_name' => 'required',
                    'serial_num' => 'required',
                    'link' => "required|unique:categories,link,$id",
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->with('error','Duplicate or empty record found.');
                }
        $input['updated_by']=\Auth::user()->id;
        if ($request->hasFile('icon_photo')) {
            $input['icon_photo']=\MyHelper::photoUpload($request->file('icon_photo'),'images/categories/',120,100);

            if($data->icon_photo!=null and file_exists($data->icon_photo)){
            unlink($data->icon_photo);
            }
        }
        
        try{
            $data->update($input);
            $bug=0;
        }catch(\Exception $e){
            $bug = $e->errorInfo[1]; 
        }
        if($bug==0){
        return redirect()->back()->with('success','Category Successfully Updated');
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

            $data=Category::findOrFail($id);
        try{
            if($data->icon_photo!=null and file_exists($data->icon_photo)){
                unlink($data->icon_photo);
            }
            $data->delete();
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