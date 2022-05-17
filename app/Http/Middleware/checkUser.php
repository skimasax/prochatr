<?php

namespace App\Http\Middleware;

use Closure;
//Session
use Session;
use App\Connection;

class checkUser
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
        if(null == session('prochatr_login_id')){
            return redirect()->route('main.index', '_access=err');
        }

        //Check if user is setup
        // $checkConnection = Connection::where('login_id', session('prochatr_login_id'))->get()->count();
        // if(null != $checkConnection)
        // {
        //     return redirect()->route('main.setup', '_connection=true');
        // }

        return $next($request);
    }
}
