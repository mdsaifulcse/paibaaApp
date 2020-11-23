<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\DivisionTown;
use Validator,Auth,DB;


class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Responses
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
                    'area_name' => 'required',
                    'serial_num' => 'required',
                    'division_town_id' => 'required|exists:division_towns,id',

                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
        $input = $request->all();
        $nameWithSpace=str_replace('_',' ', $input['area_name']);
        $name=explode(',',$nameWithSpace);
        for ($i=0; $i < sizeof($name); $i++){
            $input['area_name']=$name[$i];
            Area::create($input);
        }
        try{
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
        $division=DivisionTown::findOrFail($id);
       $maxSerial=Area::where('division_town_id',$id)->max('serial_num');
       $allData=Area::where('division_town_id',$id)->orderBy('id','desc')->paginate(20);
        return view('backend.divisionTown.area',compact('allData','division','maxSerial'));
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
         $data=Area::findOrFail($id);
         $validator = Validator::make($request->all(), [
                    'area_name' => 'required',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->with('error','Duplicate or empty record found.');
                }
        $input=$request->all();
        
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
        $data=Area::findOrFail($id);
        DB::beginTransaction();
        try{
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
       return redirect()->back()->with('success','Data has been Successfully Deleted!');
        }elseif($bug==1451){
       return redirect()->back()->with('error','This Data is Used anywhere ! ');

        }
        elseif($bug>0){
       return redirect()->back()->with('error','Some thing error found !');

        }
    }
}
