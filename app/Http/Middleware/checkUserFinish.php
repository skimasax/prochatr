<?php

namespace App\Http\Middleware;

use Closure;
//Session
use Session;
use App\Connection;
use App\Interest;
use App\Subscribe;
use App\Personal_detail;

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

        $thisuser = Personal_detail::where('user_id', session('prochatr_login_id'))->first();

        // Check if User has Active subscription

        $checkSub = Subscribe::where('email', $thisuser->email)->first();

        $today = date('Y-m-d', strtotime(now()));

        if($checkConnection < 1 || $checkInterest < 1)
        { 
            return redirect()->route('main.userinterest', '_connection=false&interest=true');
        }

        if(isset($checkSub->expiry) && $checkSub->expiry < $today){
            return redirect()->route('main.userinterest', '_connection=false&interest=true');
        }

        if(!$checkSub){
            return redirect()->route('main.userinterest', '_connection=false&interest=true');
        }

        return $next($request);
    }
}
