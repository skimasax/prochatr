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
//Models
use \App\Account;
use \App\Connection;
use \App\Subscription;
use \App\Personal_detail;
use \App\Companylogo as Companylogo;

class AdminController extends Controller
{
    public $logo;

  public function index(){
    return view('admin.pages.index');
  }

  //Logout Code
  public function logout(Request $req){
      $req->session()->flush();
      return redirect()->route('main.index');
  }

  //getRegistered Code
  public function getRegistered(){
    return view('admin.pages.report_today');
  }

  public function unregistered(){
    $userDetails = Personal_detail::join('accounts', 'accounts.login_id', '=', 'personal_details.user_id')->where('accounts.username', '=', null)->get();
    return view('admin.pages.unregistered')->with(['result' => $userDetails]);
  }

  public static function getAll(){
    return Personal_detail::join('accounts', 'accounts.login_id', '=', 'personal_details.user_id')->where('accounts.username', '!=', NULL)->get();
  }

  public function details(Request $req){
    $userDetails = Personal_detail::where('personal_details.user_id', $req->get('profile_id'))->get();
    $connections = Connection::where('login_id', $req->get('profile_id'))->get();
    $getlogo = Companylogo::where('login_id', $req->get('profile_id'))->get();
    if(count($getlogo) > 0){
        $this->logo = $getlogo;
    }
    else{
        $this->logo = "";
    }
    return view('admin.pages.view_all')->with(['result' => $userDetails, 'user_connections' => $connections, 'companylogo' => $this->logo]);
  }

  public function returnJSON($data){
    return response()->json($data);
  }

  public function makePayment(Request $request)
  {
    $data = Subscription::where('id', $request->os0)->first();

    return view('includes.paysprint_payment', compact('data'));
  }
  
  public function paysprintPayment(Request $request)
  {
    $data = Subscription::where('id', $request->os0)->first();
    // dd($data);

    return view('includes.paysprint_payment', compact('data'));
  }
  //END
}
