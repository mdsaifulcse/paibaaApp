<?php

namespace App\Http\Middleware;
use Closure;
use Auth;
use App\Model\UserInfo;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(\Auth::check()){

            if($authRole=\MyHelper::userRole()->role=='client'){
                return redirect('/');
            }


        }else{
          return redirect('user-login');
        }
        return $next($request);
    }
}
