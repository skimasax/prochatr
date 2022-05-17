<?php

namespace App\Http\Middleware;

use Closure;
//Session
use Session;
use App\Connection;
use App\Interest;

class checkUserFinish
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
        $checkConnection = Connection::where('login_id', session('prochatr_login_id'))->get()->count();
        $checkInterest = Interest::where('login_id', session('prochatr_login_id'))->get()->count();
        if($checkConnection < 1 || $checkInterest < 1)
        { 
            return redirect()->route('main.userinterest', '_connection=false&interest=true');
        }

        return $next($request);
    }
}
