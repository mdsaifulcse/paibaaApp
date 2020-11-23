<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use DB,Socialite;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {

        $user = Socialite::driver('facebook')->stateless()->user();

        if(!$user){
            return redirect('/login')->with('error','Something went wrong, Please try again later');
        }

        $userData=User::where('social_id','=',$user->getId())->first();

        DB::beginTransaction();
        try{

            if(!$userData){
                $userData=User::create([
                    'name'=>$user->getName(),
                    'social_id'=>$user->getId(),
                    'email'=>$user->getEmail(),
                    'image'=>$user->getAvatar(),
                ]);

                $oldRole=DB::table('role_user')->where('user_id',$userData->id)->first();
                if($oldRole!=null){
                    DB::table('role_user')->where('user_id',$userData->id)->update(['role_id'=>4]);
                }else{
                    DB::table('role_user')->insert(['role_id'=>4,'user_id'=>$userData->id]);
                }



                $userName=str_replace(' , ', '', $userData->name);
                $userName=str_replace(', ', '', $userName);
                $userName=str_replace(' ,', '', $userName);
                $userName=str_replace(',', '', $userName);
                $userName=str_replace('/', '', $userName);
                $userName=rtrim($userName,' ');
                $userName=str_replace(' ', '', $userName);
                $userName=str_replace('.', '', $userName);
                $userName=substr($userName,0,20);
                $userName=strtolower($userName);
                $input['user_name']=$userName.$userData->id;

                User::findOrFail($userData->id)->update(['user_name'=>$input['user_name']]);

            }

            \Auth::login($userData,true);

            DB::commit();
            $bug=0;
        }catch (\Exception $e){
            DB::rollback();
            $bug=$e->errorInfo[1];
            $bug2=$e->errorInfo[1];
        }

        if ($bug==0){
            return redirect($this->redirectTo);
        }else{
            return redirect()->back()->with('error','Something Error Found ! '.$bug2);
        }



        //return $user->token;
    }




    public function username()
    {
        $loginType = request()->input('mobile');
        $this->mobile = filter_var($loginType, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
        request()->merge([$this->mobile => $loginType]);
        return property_exists($this, 'mobile') ? $this->mobile : 'email';
    }
}
