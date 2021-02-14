<?php

namespace App\Http\Middleware;

use Closure;

class RedirectHttps
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
        $pathArray = explode('://',$request->fullUrl());
        $http = $pathArray[0];
        if($http=='http'){
            return redirect('https://'.$pathArray[1]);
        }

        return $next($request);
    }
}
