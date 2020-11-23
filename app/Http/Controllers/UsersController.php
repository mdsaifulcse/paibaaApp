<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Image;
use Auth,DB, MyHelper, Validator;
use Yajra\Acl\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allUsers=User::leftJoin('role_user','users.id','role_user.user_id')
            ->leftJoin('roles','role_user.role_id','roles.id')
            ->where('users.type',1)->where('users.id','!=',1)
            ->select('users.*','roles.name as role_name','role_id')
            ->orderBy('users.id','ASC')->paginate(20);


        return view('backend.primary_info.user.index',compact('allUsers'));
    }
    public function students()
    {
        $allUsers=User::leftJoin('role_user','users.id','role_user.user_id')
            ->leftJoin('roles','role_user.role_id','roles.id')
            ->where('users.type','!=',1)
            ->select('users.*','roles.name as role_name','role_id')
            ->orderBy('users.id','ASC')->paginate(10);


        return view('backend.primary_info.user.index',compact('allUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::where('system',1)->pluck('name','id');
       return view('backend.primary_info.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validateFields=[
            'name' => 'required|max:50',
            'mobile'  => "required|min:11|max:11|unique:users|regex:/(01)[0-9]{9}/",
            'email'  => "unique:users|email|max:100",
            'role_id'  => "required|exists:roles,id",
            'password' => 'required|min:8|confirmed',
            /*enable   extension=php_fileinfo*/
        ];

        if ($request->email==null){
            unset($validateFields['email']);
        }

        $validator = Validator::make($request->all(), $validateFields);

        if ($validator->fails()) { return redirect()->back()->withErrors($validator)->withInput();}

            $input = $request->all();
            $input['password']=bcrypt($input['password']);
            $input['created_by']=Auth::user()->id;
            $input['type']=1;
            $input['status']=1;

            if ($request->hasFile('image')){ $input['image']=MyHelper::photoUpload($request->file('image'),'images/users/',120,100);}

            DB::beginTransaction();
        try{
            $insertId= User::create($input)->id;
            $oldRole=DB::table('role_user')->where('user_id',$insertId)->first();
            if($oldRole!=null){
                DB::table('role_user')->where('user_id',$insertId)->update(['role_id'=>$request->role_id]);
            }else{
                DB::table('role_user')->insert(['role_id'=>$request->role_id,'user_id'=>$insertId]);
            }


            DB::commit();
            $bug=0;
            }catch(\Exception $e){
                DB::rollback();
                $bug=$e->errorInfo[1];
            }
             if($bug==0){
            return redirect('all-users')->with('success','Data Successfully Inserted');
            }elseif($bug==1062){
                return redirect()->back()->with('error','The Email has already been taken.');
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
        $data=User::leftJoin('role_user','users.id','role_user.user_id')->select('users.*','role_id')->where('users.id',$id)->first();

        if($data==null){
            return redirect()->back();
        }
        $roles=DB::table('roles')->where('system',1)->pluck('name','id');

        return view('backend.primary_info.user.edit',compact('data','roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=User::findOrFail($id);
        return view('backend.primary_info.user.password',compact('data'));
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

        $data= User::findOrFail($request->id);
        $validateFields=[
            'name' => 'required|max:50',
            'mobile'  => "required|min:11|max:11|unique:users,mobile,$request->id|regex:/(01)[0-9]{9}/",
            'email'  => "unique:users,email,$request->id|email|max:100",
            /*enable   extension=php_fileinfo*/
        ];

        if ($request->email==null){
            unset($validateFields['email']);
        }

        $validator = Validator::make($request->all(), $validateFields);

        if ($validator->fails()) { return redirect()->back()->withErrors($validator)->withInput();}

        $input = $request->except('_token');

        $input=$request->all();
        DB::beginTransaction();

        try{

            if(isset($request->role_id)){
                $oldRole=DB::table('role_user')->where('user_id',$id)->first();
                if($oldRole!=null){
                    DB::table('role_user')->where('user_id',$id)->update(['role_id'=>$request->role_id]);
                }else{
                    DB::table('role_user')->insert(['role_id'=>$request->role_id,'user_id'=>$id]);
                }
            }

            if ($request->hasFile('image')){
                $input['image']=MyHelper::photoUpload($request->file('image'),'images/users/',120,100);

                if (file_exists($data->image)){
                    unlink($data->image);
                }
            }

            $input['updated_by']=Auth::user()->id;
            $data->update($input);
            DB::commit();
            $bug=0;
        }
        catch(\Exception $e)

        {
            DB::rollback();
           $bug=$e->errorInfo[1];
            $bug1=$e->errorInfo[2];
        }

        if($bug==0){

            return redirect()->back()->with('success','Successfully updated');

        }elseif ($bug==1062) {

            return redirect()->back()->with('error','Data has already been taken');
        }else{
            return redirect()->back()->with('error','Something error taken !');
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
        $input=User::findOrFail($id);

        DB::beginTransaction();
        try {

            $input->delete();

            if (file_exists($input->image)){
                unlink($input->image);
            }


            $bug = 0;
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
        }

        if ($bug == 0) {
            return redirect()->back()->with('success', ' Users Deleted Successfully.');
        }elseif ($bug==1451){
            return redirect()->back()->with('error', 'Sorry this users can not be delete due to used another module');
        }
        else {
            return redirect()->back()->with('error', 'Something Error Found! ' . $bug1);
        }
    }


    public function password(Request $request){
        $input=$request->all();
        $newPass=$input['password'];
        $data=User::findOrFail($request->id);
        $validator = Validator::make($request->all(),[
            'password' => 'required|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $input['password']=bcrypt($newPass);
        try{
            $data->update($input);
            $bug=0;
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
        if($bug==0){
            return redirect()->back()->with('success','Password Changed Successfully !');
        }else{
            return redirect()->back()->with('error','Something is wrong !');

        }
    }


    public function profile(){
        $id=Auth::user()->id;
        $data=User::findOrFail($id);
        $type=DB::table('user_type')->where('type',Auth::user()->type)->pluck('type_name','type');
        return view('profile.show',compact('data','type'));
    }

    public function changePass()
    {
        $id=Auth::user()->id;
        $data=User::findOrFail($id);
        return view('profile.password',compact('data'));
    }




}
