<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->role == "adminuser"){
            
             $priviledge=auth()->user()->privileges;
             $priviledges=explode(',',$priviledge);
             $route = $request->route();
             $route=$route->uri;
             $route=explode('/',$route);
             $route=$route[0];
         
    // Redirect to custom page if it doesn't relate to a profile
        if (in_array($route, $priviledges)) {
            
            return $next($request);
        }   
        }
         

       return abort(403, 'Access denied');
    }
}
