<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Session;
use Response,Validator,DB;
use Illuminate\Http\Request;
use Yajra\Acl\Models\Role;

class ClientRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        \Auth::logout();
//        return redirect('/');
        return 'Client Area';
    }

    protected function uniqueUserValidation($data,$userID=null){

        $userData='';
        if (strpos($data, '@') !== false) {

            if ($userID!=''){
                $userData=User::where(['email'=>$data])->where('id','!=',$userID)->first();
            }else{
                $userData=User::where(['email'=>$data])->first();
            }

        }else{
            if ($userID!='') {
                $userData = User::where(['mobile' => $data])->where('id', '!=', $userID)->first();
            }else {
                $userData = User::where(['mobile' => $data])->first();
            }
        }

        return Response::json(['userData'=>$userData,]);
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

        //return $request;

        $validateFields=[
            'name' => 'required|max:50',
            'mobile'  => "required|min:11|max:11|unique:users|regex:/(01)[0-9]{9}/",
            'email'  => "unique:users",
            'password' => 'required|min:8|confirmed',
            /*enable   extension=php_fileinfo*/
        ];

        if ($request->email==null){
            unset($validateFields['email']);
        }

        $validator = Validator::make($request->all(), $validateFields);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        $input['password']=bcrypt($input['password']);
        $input['status']=0;
        $input['type']=3; // general user -------

        if ($request->hasFile('image')){
            $input['image']=MyHelper::photoUpload($request->file('image'),'images/users/',120,100);
        }


        DB::beginTransaction();
        try{
            $insertId= User::create($input)->id;

            $roleData=Role::where('slug','client')->first();

            $oldRole=DB::table('role_user')->where('user_id',$insertId)->first();

            if($oldRole!=null){
                DB::table('role_user')->where('user_id',$insertId)->update(['role_id'=>$roleData->id]);
            }else{
                DB::table('role_user')->insert(['role_id'=>$roleData->id,'user_id'=>$insertId]);
            }

            if ($request->joining_date!=null){
                $input['joining_date']=date('Y-m-d',strtotime($request->joining_date));
            }



            // set username -------------------
            $userName=str_replace(' , ', '', $input['name']);
            $userName=str_replace(', ', '', $userName);
            $userName=str_replace(' ,', '', $userName);
            $userName=str_replace(',', '', $userName);
            $userName=str_replace('/', '', $userName);
            $userName=rtrim($userName,' ');
            $userName=str_replace(' ', '', $userName);
            $userName=str_replace('.', '', $userName);
            $userName=substr($userName,0,20);
            $userName=strtolower($userName);
            $input['user_name']=$userName.$insertId;

            User::findOrFail($insertId)->update(['user_name'=>$input['user_name']]);

            DB::commit();
            $bug=0;
        }catch(Exception $e){
            DB::rollback();
            $bug=$e->errorInfo[1];
            $bug2=$e->errorInfo[1];
        }

        //Session::pull('od_rf','my-profile');

        if($bug==0){
            return redirect('/login?od_rf='.'my-profile')->with('success','Your account successfully create, Now Login & Complete Your Profile');
        }elseif($bug==1062){
            return redirect()->back()->with('error','The Email has already been taken.');
        }else{
            return redirect()->back()->with('error','Something Error Found ! '.$bug2);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
