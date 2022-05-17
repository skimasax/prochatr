<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//Session
use Session;
//Mail
use App\Mail\sendEmail;
use Illuminate\Support\Facades\Mail;
//DB Facade
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
//Hash
use Illuminate\Support\Facades\Hash;
//Models
use App\Active;

class CronController extends Controller
{    
    //CheckUser Subscription
    public function index(Request $req){
    }
    
    //CheckUser Active
    public function checkActive(){
        $checkActive = Active::where('login_id', session('prochatr_login_id'))->get();
        if(count($checkActive) > 0){
            return 'true';
        }
        else{
            return 'false';
        }
    }

    // public function returnJSON($data){
    //   return response()->json($data);
    // }
    
  //END
}
