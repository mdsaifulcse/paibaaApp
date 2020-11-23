<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DivisionTown;
use Validator,Auth,DB;


class DivisionTownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allData=DivisionTown::orderBy('id','desc')->paginate(20);
        $maxSerial=DivisionTown::max('serial_num');
        return view('backend.divisionTown.index',compact('allData','maxSerial'));
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
        $validator = Validator::make($request->all(), [
                    'division_town' => "required|unique:division_towns",
                    'type' => 'required',
                    'serial_num' => 'required|numeric',
                    'status' => 'required',

                ]);
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
        $nameWithSpace=str_replace('_',' ', $input['division_town']);
        $division_town=explode(',',$nameWithSpace);

        DB::beginTransaction();
        try{
            for ($i=0; $i < sizeof($division_town); $i++){
                $input['division_town']=$division_town[$i];
                 $link=str_replace(' , ', '-', $division_town[$i]);
                $link=str_replace(', ', '-', $link);
                $link=str_replace(' ,', '-', $link);
                $link=str_replace(',', '-', $link);
                $link=str_replace('/', '-', $link);
                $link=trim($link,' ');
                $link=str_replace(' ', '-', $link);
                $link=str_replace('.', '', $link);
                $link=substr($link,0,29);
                $link=strtolower($link);
                $input['link']=$link;
                DivisionTown::create($input);
            }
        $bug=0;
        DB::commit();
        }catch(\Exception $e){
            DB::rollback();
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
        //
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
            $data=DivisionTown::findOrFail($id);
            $input=$request->all();
            $link=str_replace(' , ', '-', $input['division_town']);
            $link=str_replace(', ', '-', $link);
            $link=str_replace(' ,', '-', $link);
            $link=str_replace(',', '-', $link);
            $link=str_replace('/', '-', $link);
            $link=rtrim($link,' ');
            $link=str_replace(' ', '-', $link);
            $link=str_replace('.', '', $link);
            $link=substr($link,0,29);
            $link=strtolower($link);
            $input['link']=$link;
         $validator = Validator::make($input, [
                    'division_town' => "required|unique:division_towns,division_town,$id",
                    'link' => "required|unique:division_towns,link,$id",
                ]);

                if ($validator->fails()) { return redirect()->back()->with('error','Duplicate or empty record found.');}

        DB::beginTransaction();
        try{
            $data->update($input);
            $bug=0;
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
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
        $data=DivisionTown::findOrFail($id);
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
