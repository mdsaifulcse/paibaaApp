<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use DB,Auth,URL, Validator,Image,DataLoad;
use Yajra\DataTables\DataTables;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.ad-location.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations=Location::leftJoin('users','users.id','locations.created_by')
            ->select('users.name','locations.*')
            ->orderBy('locations.id','DESC');

        return DataTables::of($locations)
            ->addIndexColumn()
            ->addColumn('DT_RowIndex','')
            ->addColumn('Status','<span>
                         @if($status==1) 
                         <a href="javascript:void()" title="This location is active" class="btn btn-success btn-sm">Active</a>
                          @else
                          <a href="javascript:void()" title="This is location is inaction" class="btn btn-warning btn-sm">Inactive</a>
                           @endif 
                         </span>'
            )
            ->addColumn('CreatedAt','<span><?php echo date(\'d-M-Y\',strtotime($created_at));?></span>')
            ->addColumn('Action','
                <div class="dropdown">
              <button class="no-padding" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu action-dropdown" aria-labelledby="dLabel">
                
                <li>
                <a  href="#locationModal<?php echo $id;?>" class="btn btn-xs btn-success" data-toggle="modal"><i class="fa fa-pencil"></i> Edit</a>
                </li>
                <li>
                    {!!Form::open(array(\'route\'=>[\'location.destroy\',"$id"],\'method\'=>\'DELETE\',\'id\'=>"deleteForm$id"))!!}
                        <button type="button" class="btn btn-danger btn-xs" onclick="return deleteConfirm(\'deleteForm{{$id}}\')"><i class="fa fa-trash"></i> Delete</button>
                    {!! Form::close() !!}
                </li>
              </ul>
          </div>
          
          
          <div class="modal fade" id="locationModal<?php echo $id;?>" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                {!! Form::open(array(\'route\' => [\'location.update\',$id],\'method\'=>\'PUT\',\'class\'=>\'form-horizontal author_form\',\'files\'=>\'true\')) !!}
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Location</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">

                                    <div class="form-group row">
                                        <label class="col-md-12"> Location Name <sup class="text-danger">*</sup>:</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="location_name" value="<?php echo $location_name; ?>" required placeholder="Location Name">
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <div class="col-md-4 no-padding">
                                            <label class="col-md-12"> Status <sup class="text-danger">*</sup></label>
                                            <div class="col-md-12">
                                                {{Form::select(\'status\',[\'1\'=>\'Active\',\'0\'=>\'Inactive\'],$status,[\'class\'=>\'form-control\'])}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-danger pull-left" data-dismiss="modal">Close</a>
                                    <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                </div>
                                {!! Form::close(); !!}
                            </div>
                        </div>
                    </div>
          
            ')
            ->rawColumns(['DT_RowIndex','Photo','CreatedAt','Status','Action'])
            ->toJson();
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
            'location_name' => 'required',
            'status' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->all();

        try{

            $locationData=Location::where('location_name',$request->location_name)->first();

            $link=str_replace(' , ', '-', $input['location_name']);
            $link=str_replace(', ', '-', $link);
            $link=str_replace(' ,', '-', $link);
            $link=str_replace(',', '-', $link);
            $link=str_replace('/', '-', $link);
            $link=rtrim($link,' ');
            $link=str_replace(' ', '-', $link);
            $link=str_replace('.', '', $link);
            $link=substr($link,0,50);
            $link=strtolower($link);
            $input['url']=$link;


            if (empty($locationData)){
                $input['created_by']=Auth::user()->id;
                Location::create($input);
            }else{
                $input['updated_by']=Auth::user()->id;
                $locationData->update($input);
            }

            ;
            $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
        if($bug==0){
            return redirect()->back()->with('success','Data Successfully Inserted');
        }elseif($bug==1062){
            return redirect()->back()->with('error'.$bug);
        }else{
            return redirect()->back()->with('error','Something Error Found ! ');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $validator = Validator::make($request->all(), [
            'location_name' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input=$request->all();
        $data=Location::findOrFail($id);
        try{
            $link=str_replace(' , ', '-', $input['location_name']);
            $link=str_replace(', ', '-', $link);
            $link=str_replace(' ,', '-', $link);
            $link=str_replace(',', '-', $link);
            $link=str_replace('/', '-', $link);
            $link=rtrim($link,' ');
            $link=str_replace(' ', '-', $link);
            $link=str_replace('.', '', $link);
            $link=substr($link,0,50);
            $link=strtolower($link);
            $input['url']=$link;

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
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=Location::findOrFail($id);
        try{
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
