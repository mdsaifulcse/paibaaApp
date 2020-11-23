<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\DivisionTown;
use App\Models\Location;
use App\Models\UserInfo;
use App\User;
use Illuminate\Http\Request;
use DB,Auth,Validator;
use Illuminate\Support\Facades\Hash;

class MyProfileController extends Controller
{
    protected function myProfileSetting(){

        $userData=User::leftJoin('user_infos','user_infos.user_id','users.id')
            ->select('user_infos.*','users.*')->where('users.id',\Auth::user()->id)->first();

        $existingLocation='';

        $locationName=UserInfo::leftJoin('locations','user_infos.location_id','locations.id')
                    ->select('location_name')->where('user_id',\Auth::user()->id)->pluck('location_name')->toArray();

        $existingLocation= implode(',', $locationName);

        return view('frontend.my-account.my-profile',compact('userData','existingLocation'));
    }

    protected function loadAreaByDivisionTown($divisionTown){
        $areas=Area::where('division_town_id',$divisionTown)->orderBy('id','DESC')->pluck('area_name','id');
        return view('frontend.load-data.load-area',compact('areas'));
    }

    protected function updateMyProfile(Request $request){

        //return $request;
        $validateFields=[
            'name' => 'required|max:50',
            'mobile'  => "required|min:11|max:11|unique:users,mobile,$request->id|regex:/(01)[0-9]{9}/",
            'email'  => "required|email|unique:users,email,$request->id",
            'address'  => "required|max:200",

            /*enable   extension=php_fileinfo*/
        ];

        if ($request->email==null){
            unset($validateFields['email']);
        }

        $validator = Validator::make($request->all(), $validateFields);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input=$request->all();
        $data=User::findOrFail($request->id);

        DB::beginTransaction();
        try{
            if ($request->hasFile('image')){
                $input['image']=\MyHelper::photoUpload($request->file('image'),'images/users/',120,100);
            }

            $input['created_by']=\Auth::user()->id;
            $input['updated_by']=\Auth::user()->id;
            $input['user_id']=$data->id;
            $input['status']=1;

            $data->update($input);


            $userInfo=UserInfo::where('user_id',$data->id)->delete();

            if(isset($request->location)){

                $locations=explode(',',$request->location[0]);

                $locationSize=sizeof($locations);

                for ($i=0; $i <$locationSize ; $i++) {
                    $location = Location::firstOrCreate(['location_name' =>$locations[$i]]);
                    UserInfo::create([
                        'location_id' => $location->id,
                        'user_id' => $data->id,
                    ]);
                }
            }


            DB::commit();
            $bug=0;
        }catch (Exception $e){
            DB::rollback();
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];

        }

        if($bug==0){
            return redirect()->back()->with('success','Brand Successfully Updated');
           // return redirect()->back()->with('success','Brand Successfully Updated');
        }elseif($bug==1062){
            return redirect()->back()->with('error','The name has already been taken.');
        }else{
            return redirect()->back()->with('error','Something Error Found ! '.$bug1);
        }

    }


    protected function updateMyPassword(Request $request){

        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|min:8',
            //'password' => 'required|min:8|max:12|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $data=User::findOrFail($request->id);

        $input=$request->all();
        $newPass=$input['password'];
        if(!empty($input['old_password'])){

            $inputOld=$input['old_password'];
            if(Hash::check($inputOld,$data['password'])){

                $input['password']=bcrypt($newPass);

            }else{
                return redirect()->back()->with('error','Current Password not match !');
            }
        }

        DB::beginTransaction();
        try{
            $data->update($input);
            $bug=0;
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $bug=$e->errorInfo[1];
            $bug1=$e->errorInfo[2];
        }

        if($bug==0){
            return redirect()->back()->with('success','Password Changed Successfully !');
        }else{
            return redirect()->back()->with('error','Something is wrong ! '.$bug1);
        }

    }

    public function showSetUserNameForm(){

        $userData=User::findOrFail(Auth::user()->id);
        return view('frontend.my-account.set-username',compact('userData'));

    }

    public function updateMyNewUserName(Request $request){

        //return $request;
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|min:5|max:20|unique:users',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        DB::beginTransaction();
        try{

            $userData=User::where(['id'=>Auth::user()->id,'user_name'=>$request->old_user_name])->first();

            if (empty($userData)){
                return redirect()->back()->with('error','Something went wrong, Try Again !');
            }

            $userData->update(['user_name'=>$request->user_name]);

            $bug=0;
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $bug=$e->errorInfo[1];
            $bug1=$e->errorInfo[2];
        }


        if($bug==0){
            return redirect()->back()->with('success','Password Changed Successfully !');
        }else{
            return redirect()->back()->with('error','Something is wrong ! '.$bug1);
        }


    }


}
