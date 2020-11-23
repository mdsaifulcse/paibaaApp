<?php

namespace App\Http\Middleware;

use Closure;

class ClientMiddleware
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
        $authRole=\MyHelper::userRole()->role;
        if (\Auth::check() && $authRole=='client'){
             redirect('/');
        }
        else{
            //\Auth::logout();
             redirect('/');
        }

        return $next($request);
    }
}
