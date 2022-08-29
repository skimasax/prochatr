<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
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
use App\Exports\ProchatrinvitesExport;
use App\Imports\ProchatrinvitesImport;
use Maatwebsite\Excel\Facades\Excel;
//Models
use App\Personal_detail;
use App\Account;
use App\Contact;
use App\Subscribe;
use App\Setting;
use App\Connection;
use App\Setting as Settings;
use App\Reset;
use App\Chat;
use App\Chat_info;
use App\Prochatrinvite;
use App\Interest;
use App\Transaction;
use App\Badge;
use \App\Companylogo as Companylogo;

class AjaxController extends Controller
{
    public $sendmessageUrl = "https://web.prochatr.com/Daemon/sendmessage";
    public $profession = "";
    public $company = "";
    public $username = "";
    public $password = "";
    public $login_id = "";
    public $name = "";
    public $email = "";
    public $subject = "";
    public $message = "";
    public $city = "";
    public $state = "";
    public $country = "";
    public $token = "";
    public $security = "";
    public $inviteid = "";
    public $action = "";

    public $sheetName;
    public $purpose;
    public $insert;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExportView()
    {
       return view('import');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export()
    {
        return Excel::download(new ProchatrinvitesExport, 'users.xlsx');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import()
    {
        $s = Excel::import(new ProchatrinvitesImport,request()->file('file'));

       $resData = ['res' => '1', 'type' => 'UploadExcel'];
       return $this->returnJSON($resData);


    }

    public function register(Request $req){
      //Validator
      $validator = Validator::make($req->all(),
         array(
             'login_id' => 'required',
             'register_firstname' => 'required',
             'register_lastname' => 'required',
             'register_email' => 'required|email',
             'register_phone' => 'required',
             'register_profession' => 'required',
             'register_position' => 'required',
             'register_company' => 'required',
             'register_industry' => 'required',
             'register_country' => 'required',
             'register_city' => 'required',
             'register_state' => 'required',
             'gender' => 'required',
         ));

      if ($validator->fails()) {
         $resData = ['res' => 'Failed: Data Error', 'type' => 'Registration'];
         return $this->returnJSON($resData);
      }

      //Insert to Personal Details
      $insertData = Personal_detail::firstOrCreate(
          ['email' => $req->register_email, 'user_id' => $req->login_id, 'firstname' => $req->register_firstname, 'lastname' => $req->register_lastname,'phone' => $req->register_phone, 'profession' => $req->register_profession, 'company' => $req->register_company, 'cstate' => $req->register_state, 'city' => $req->register_city, 'country' => $req->register_country, 'industry' => $req->register_industry, 'position' => $req->register_position, 'state' => 'Offline', 'gender' => $req->gender, 'created_at' => date('Y-m-d h:i:s')]
        );

      if($insertData){
        $resData = ['res' => 'Success', 'type' => 'Registration'];
        return $this->returnJSON($resData);
      }
      else{
        $resData = ['res' => 'Failed: Data Error', 'type' => 'Registration'];
        return $this->returnJSON($resData);
      }
    }

    public function createaccount(Request $req){
      // return 1;
      //Validator
      $validator = Validator::make($req->all(),
         array(
             'login_id' => 'required',
             'password' => 'required',
             'username' => 'required',
             'security' => 'required',
             'answer' => 'required',
             'email' => 'required|email',
         ));

      if ($validator->fails()) {
         $resData = ['res' => 'Failed: Account Error', 'type' => 'Account'];
         return $this->returnJSON($resData);
      }

      //Insert to Personal Details
      $insertData = Account::firstOrCreate(
          ['login_id' => $req->login_id, 'username' => $req->username, 'password' => bcrypt($req->password), 'security' => $req->security, 'answer' => $req->answer]
      );

      //Settings Options
      Setting::insert(['user_id' => $req->login_id]);
      Interest::insert(['login_id' => $req->login_id]);
      Badge::insert(['login_id' => $req->login_id]);

      if($insertData){
        //Perform Badge Operation
        $getAllInvitees = Prochatrinvite::select('inviteid')->where('email', $req->email)->distinct()->get();
        if(count($getAllInvitees) > 0){
          foreach ($getAllInvitees as $invitees) {
            $getBadge = Badge::where('login_id', $invitees->inviteid)->get();
            if(count($getBadge) > 0){
              //Add Badge
              Badge::where('login_id', $invitees->inviteid)->update(['Invite' => $getBadge[0]->Invite+5]);

              //Remove Invite
              Prochatrinvite::where('inviteid', $invitees->inviteid)->where('email', $req->email)->delete();
            }
          }
        }

        $resData = ['res' => 'Success', 'type' => 'Account'];

        $this->username = $req->username;
        $this->password = $req->password;
        $this->login_id = $req->login_id;
        $this->security = $req->security;

        $this->sendEmail($req->email, 'welcome');
        // $this->sendEmail('ebenezer@git-associates.com', 'welcome');
      }
      else{
        $resData = ['res' => 'Failed: Data Error', 'type' => 'Account'];
      }
      return $this->returnJSON($resData);
    }

    public function addconnection(Request $req){
      //Validator
      $validator = Validator::make($req->all(),
         array(
             'id' => 'required'
         ));

      if ($validator->fails()) {
         $resData = ['res' => 'Failed', 'type' => 'AddConnection'];
         return $this->returnJSON($resData);
      }

      //Insert to Personal Details
      $insertData = Connection::updateOrInsert(['login_id' => session('prochatr_login_id'), 'connection_id' => $req->id],['connection_id' => $req->id]);

      if($insertData){
        //Send Mail Invitation
        $checkU = Personal_detail::where('user_id', $req->id)->get();
        $this->inviteid = $req->id;

        if(count($checkU) > 0 && null == $checkU[0]->username)
        {
          $this->action = "Add";
          $this->subject = ucwords(session('prochatr_firstname').' added you to connections');
          $this->sendEMail($checkU[0]->email, 'inviteAdded');  //Send link
          //Send invitation
          $this->action = "AddInvite";
          $this->subject = ucwords(session('prochatr_firstname').' has sent you an invite link');
          $this->sendEMail($checkU[0]->email, 'inviteAdded'); //Send user added
        }
        else{
          $this->action = "Add";
          $this->subject = ucwords(session('prochatr_firstname').' added you to connections');
          $this->sendEMail($checkU[0]->email, 'inviteAdded');
        }


        $resData = ['res' => '1', 'type' => 'AddConnection'];
        return $this->returnJSON($resData);
      }
      else{
        $resData = ['res' => '0', 'type' => 'AddConnection'];
        return $this->returnJSON($resData);
      }
    }

    public function addConSetup(Request $req){
      //Validator
      $validator = Validator::make($req->all(),
         array(
             'id' => 'required'
         ));

      if ($validator->fails()) {
         $resData = ['res' => '1', 'type' => 'addConSetup', 'state' => 0];
         return $this->returnJSON($resData);
      }

      //Insert to Personal Details
      $insertData = Connection::updateOrInsert(['login_id' => session('prochatr_login_id'), 'connection_id' => $req->id],['connection_id' => $req->id]);

      if($insertData){
        //Send Mail Invitation
        $checkU = Personal_detail::where('user_id', $req->id)->get();
        $this->inviteid = $req->id;

        if(count($checkU) > 0 && null == $checkU[0]->username)
        {
          $this->action = "Add";
          $this->subject = ucwords(session('prochatr_firstname').' added you to connections');
          $this->sendEMail($checkU[0]->email, 'inviteAdded');  //Send link
          //Send invitation
          $this->action = "AddInvite";
          $this->subject = ucwords(session('prochatr_firstname').' has sent you an invite link');
          $this->sendEMail($checkU[0]->email, 'inviteAdded'); //Send user added
        }
        else{
          $this->action = "Add";
          $this->subject = ucwords(session('prochatr_firstname').' added you to connections');
          $this->sendEMail($checkU[0]->email, 'inviteAdded');
        }


        $resData = ['res' => '1', 'type' => 'addConSetup', 'state' => 1];
        return $this->returnJSON($resData);
      }
      else{
        $resData = ['res' => '1', 'type' => 'addConSetup', 'state' => 0];
        return $this->returnJSON($resData);
      }
    }

    public function accept(Request $req){
      //Validator
      $validator = Validator::make($req->all(),
         array(
             'aim' => 'required'
         ));

      if ($validator->fails()) {
         $resData = ['res' => 'Failed', 'type' => 'Accept'];
         return $this->returnJSON($resData);
      }

      //Insert to Personal Details
      $updateData = Connection::where('connection_id', session('prochatr_login_id'))->where('login_id', $req->aim)->update(['action' => 1]);
      $insertData = Connection::updateOrInsert(['login_id' => session('prochatr_login_id'), 'connection_id' => $req->aim],['connection_id' => $req->aim, 'action' => 1]);

      if($insertData){
        $resData = ['res' => '1', 'type' => 'Accept'];
        return $this->returnJSON($resData);
      }
      else{
        $resData = ['res' => '0', 'type' => 'Accept'];
        return $this->returnJSON($resData);
      }
    }

    public function removeconnection(Request $req){
      //Validator
      $validator = Validator::make($req->all(),
         array(
             'id' => 'required'
         ));

      if ($validator->fails()) {
         $resData = ['res' => 'Failed', 'type' => 'RemoveConnection'];
         return $this->returnJSON($resData);
      }

      //Insert to Personal Details
      $deleteData = Connection::where(['connection_id' => $req->id, 'login_id' => session('prochatr_login_id')])->delete();

      if($deleteData){
        $resData = ['res' => '1', 'type' => 'RemoveConnection'];
        return $this->returnJSON($resData);
      }
      else{
        $resData = ['res' => '0', 'type' => 'RemoveConnection'];
        return $this->returnJSON($resData);
      }
    }

    public function updateaccount(Request $req){
      //Insert to Personal Details
      $updateaccount = Personal_detail::where('user_id', session('prochatr_login_id'))->update(['firstname' => $req->firstname, 'lastname' => $req->lastname, 'email' => $req->email, 'phone' => $req->phone, 'profession' => $req->profession, 'company' => $req->company, 'country' => $req->country, 'cstate' => $req->cstate, 'position' => $req->position]);

      if($updateaccount){
        $resData = ['res' => '1', 'type' => 'UpdateAccount'];
        $req->session()->put(['firstname' => $req->firstname, 'lastname' => $req->lastname]);
      }
      else{
        $resData = ['res' => '0', 'type' => 'UpdateAccount'];
      }
      return $this->returnJSON($resData);
    }

    public function updatepassword(Request $req){
      //Validator
      $validator = Validator::make($req->all(),
         array(
             'prev_password' => 'required',
             'new_password' => 'required'
         ));

      if ($validator->fails()) {
         $resData = ['res' => '1', 'type' => 'updatePassword', 'msg' => 'Error! Please Fill The Form'];
         return $this->returnJSON($resData);
      }

      $checkPass = Account::select('password')->where('login_id', session('prochatr_login_id'))->get();

      if (Hash::check($req->prev_password, $checkPass[0]->password)){
        //Insert to Personal Details
        $updateaccount = Account::where('login_id', session('prochatr_login_id'))->update(['password' => bcrypt($req->new_password)]);

        if($updateaccount){
          $resData = ['res' => '1', 'type' => 'updatePassword', 'msg' => 'Password updated'];
        }
        else{
          $resData = ['res' => '1', 'type' => 'updatePassword', 'msg' => 'Update Failed'];
        }
      }
      else{
        $resData = ['res' => '1', 'type' => 'updatePassword', 'msg' => 'Previous password does not match!'];
      }

      return $this->returnJSON($resData);
    }

    public function updatesecurity(Request $req){
      //Validator
      $validator = Validator::make($req->all(),
        array(
           'security' => 'required',
           'answer' => 'required'
        ));

      if ($validator->fails()) {
        $resData = ['res' => '1', 'type' => 'Security', 'msg' => 'Error! Please Fill The Form'];
        return $this->returnJSON($resData);
      }

      $updatesecurity = Account::where('login_id', session('prochatr_login_id'))->update(['security' => $req->security, 'answer' => $req->answer]);

      if($updatesecurity){
        $resData = ['res' => '1', 'type' => 'Security', 'msg' => 'Security updated'];
      }
      else{
        $resData = ['res' => '1', 'type' => 'Security', 'msg' => 'Update Failed'];
      }

      return $this->returnJSON($resData);
    }

    public function updateimage(Request $req){
      $file = "profile.png";

      if($req->file != 0){
        //Upload File
        $image = $req->file('file');
        $name = rand().session('prochatr_login_id').'.'.$image->getClientOriginalExtension();
        // $image->move(public_path('profile/'.session('prochatr_login_id')), $name);
        $image->move(public_path('../../profile/'.session('prochatr_login_id')), $name);
        $file = $_SERVER['HTTP_ORIGIN']."/profile/".session('prochatr_login_id')."/".$name;
      }

      //Insert to Personal Details
      $UpdateImage = Personal_detail::where('user_id', session('prochatr_login_id'))->update(['image' => $file]);

      if($UpdateImage){
          if($file == "profile.png"){$file = $_SERVER['HTTP_ORIGIN']."/asset/img/logo/pname.png";}
            $resData = ['res' => '1', 'type' => 'UpdateImage', 'image' => $file];
            $req->session()->put(['prochatr_image' => $file]);
      }
      else{
        $resData = ['res' => '0', 'type' => 'UpdateImage', 'image' => $file];
      }
      return $this->returnJSON($resData);
    }

    public function dosettings(Request $req){
      //Validator
      $validator = Validator::make($req->all(),
         array(
             'action' => 'required',
             'val' => 'required'
         ));

      if ($validator->fails()) {
         $resData = ['res' => 'Failed', 'type' => 'Settings'];
         return $this->returnJSON($resData);
      }

      if($req->action == "chatmode" && $req->val == "light")
      {
        $doSet = Settings::where('user_id', session('prochatr_login_id'))->update(['my_chat_color' => '#ffffff', 'others_chat_color' => '#9ad2f8' , 'background_color' => '#eef5f9']);
      }
      elseif($req->action == "chatmode" && $req->val == "dark"){
        $doSet = Settings::where('user_id', session('prochatr_login_id'))->update(['my_chat_color' => '#0000', 'others_chat_color' => '#ffff' , 'background_color' => '#eeee']);
      }

      if($req->action == "mail")
      {
        $doSet = Settings::where('user_id', session('prochatr_login_id'))->update(['mail_alert' => $req->val]);
      }

      if($req->action == "desktop")
      {
        $doSet = Settings::where('user_id', session('prochatr_login_id'))->update(['desktop_prompt' => $req->val]);
      }

      if($req->action == "block")
      {
        $doSet = Settings::where('user_id', session('prochatr_login_id'))->update(['block' => $req->val]);
      }

      if($doSet){
        $resData = ['res' => '1', 'type' => 'Settings', 'msg' => ucwords($req->action)." updated"];
      }
      else{
        $resData = ['res' => '0', 'type' => 'Settings', 'msg' => ucwords($req->action)." update failed"];
      }
      return $this->returnJSON($resData);
    }

    public function checkEmail(Request $req){
      //Insert to Personal Details
      $checkData = Personal_detail::where('email', $req->register_email)->get();

      if(count($checkData) < 1){
        $resData = ['res' => 'Verified', 'type' => 'CheckEmail'];
        return $this->returnJSON($resData);
      }
      else{
        $resData = ['res' => 'Email Already Exist', 'type' => 'CheckEmail'];
        return $this->returnJSON($resData);
      }
    }

    public function checkAccount(Request $req){
      //Insert to Personal Details
      $checkData = Account::where('username', $req->account_username)->orWhere('login_id', $req->login_id)->get();

      if(count($checkData) < 1){
    $resData = ['res' => 'Verified', 'type' => 'Account'];
    return $this->returnJSON($resData);
      }
      else{
    $resData = ['res' => 'Username Already Exist', 'type' => 'Account'];
    return $this->returnJSON($resData);
      }
    }

    public function getprofile(Request $req){
      //Insert to Personal Details
      $checkData = Personal_detail::select('state')->where('user_id', $req->id)->get();
      if(count($checkData) < 1){
        $resData = ['res' => '1', 'type' => 'getProfile', 'msg' => 'Offline'];
      }
      else{
        $resData = ['res' => '1', 'type' => 'getProfile', 'msg' => $checkData[0]->state];
      }
      return $this->returnJSON($resData);
    }

    public function chatdetails(Request $req){
      //Insert to Personal Details
      $checkData = Personal_detail::select('email', 'user_id')->where('user_id', session('prochatr_login_id'))->get();
      if(count($checkData) < 1){
        $resData = ['res' => '0', 'type' => 'chatdetails', 'msg' => 'Account Error'];
      }
      else{
        $resData = ['res' => '1', 'type' => 'chatdetails', 'msg' => 'Success', 'property' => $checkData[0]];
      }
      return $this->returnJSON($resData);
    }

    public function Logout(Request $req){
        $req->session()->flush();
      if(null == session('prochatr_login_id')){
        $resData = ['res' => '1', 'type' => 'Logout'];
      }
      else{
        $resData = ['res' => '0', 'type' => 'Logout'];
      }
      return $this->returnJSON($resData);
    }

    public function Login(Request $req){
      // dd(auth()->user());

      //Insert to Personal Details
      $checkData = Account::select('login_id', 'firstname', 'lastname', 'password', 'accounts.username', 'image')->join('personal_details', 'personal_details.user_id', '=', 'accounts.login_id')->where('accounts.username', $req->username)->orWhere('personal_details.user_id', $req->username)->limit(1)->get();




      if(count($checkData) > 0){
        //Check Password
        if (Hash::check($req->password, $checkData[0]->password)){

          //Set Session
          $req->session()->put(['prochatr_login_id' => $checkData[0]->login_id, 'prochatr_firstname' => $checkData[0]->firstname, 'prochatr_lastname' => $checkData[0]->lastname, 'prochatr_image' => $checkData[0]->image]);
          $resData = ['res' => 'Success', 'type' => 'Login'];
          return $this->returnJSON($resData);
        }
        else{
          $resData = ['res' => 'Credentials Mis-match', 'type' => 'Login'];
          return $this->returnJSON($resData);
        }
      }
      else{
        $resData = ['res' => 'Credentials Mis-match', 'type' => 'Login'];
        return $this->returnJSON($resData);
      }
    }

    public function contact(Request $req){
      //Validator
      $validator = Validator::make($req->all(),
         array(
             'name' => 'required',
             'email' => 'required|email',
             'subject' => 'required',
             'message' => 'required',
             'city' => 'required',
             'state' => 'required',
             'country' => 'required',
         ));

      if ($validator->fails()) {
         $resData = ['res' => 'Failed: Contact Form Error', 'type' => 'Contact'];
         return $this->returnJSON($resData);
      }

      //Insert to Personal Details
      $insertData = Contact::insert(
        ['login_id' => 1, 'name' => $req->name, 'email' => $req->email, 'subject' => $req->subject, 'message' => $req->message, 'city' => $req->city, 'state' => $req->state, 'country' => $req->country]
      );

      if($insertData){
        $resData = ['res' => 'OK', 'type' => 'Contact'];

        $this->name = $req->name;
        $this->email = $req->email;
        $this->subject = $req->subject;
        $this->message = $req->message;
        $this->city = $req->city;
        $this->state = $req->state;
        $this->country = $req->country;
        $this->sendEmail('info@prochatr.com', 'contact');
      }
      else{
        $resData = ['res' => 'Failed to Send Request', 'type' => 'Contact'];
      }
      return $this->returnJSON($resData);
    }

    public function subscribe(Request $req){
      //Validator
      $validator = Validator::make($req->all(),
         array(
             'email' => 'required|email',
         ));

        //  dd($validator);

      if ($validator->fails()) {
         $resData = ['res' => 'Address Error', 'type' => 'Subscribe'];
         return $this->returnJSON($resData);
      }

      if($req->email && ($this->isEmail($req->email) == 1)){
        //Insert to Personal Details
        // $amount=Transaction::where('id',Auth::id())->first();
        // dd($amount);
        $insertData = Subscribe::firstOrCreate(
          ['email' => $req->email],
          ['login_id' => 1]
        );

        if($insertData){
          $resData = ['res' => 'Success', 'type' => 'Subscribe'];
          $this->sendEMail($req->email, 'subscribe');
        //   $this->sendEMail('ebenezer@git-associates.com', 'subscribe');
        }
        else{
          $resData = ['res' => 'Failed', 'type' => 'Subscribe'];
        }
      }
      else{
        $resData = ['res' => 'Wrong Email', 'type' => 'Subscribe'];
      }
      return $this->returnJSON($resData);
    }

    public function sendMessage(Request $req){
      //Validator
      $validator = Validator::make($req->all(),
         array(
             'message' => 'required',
             'aim' => 'required',
         ));

      if ($validator->fails()) {
         $resData = ['res' =>  0, 'type' => 'sendMessage', 'msg' => 'Error'];
         return $this->returnJSON($resData);
      }

      $sentto = Personal_detail::where('user_id', $req->aim)->get();
      if(count($sentto) > 0)
      {
        //Send Mail
        $this->message = $req->message;
        $this->name = $sentto[0]->firstname." ".$sentto[0]->lastname;
        // $this->sendEMail($sentto[0]->email, 'sendMessage');
        $this->sendEMail('babalolaebenezertaiwo@gmail.com', 'sendMessage');
        $resData = ['res' => '1', 'type' => 'sendMessage', 'msg' => 'Sent'];

        $chatid = mt_rand(10, 100).time();

        $chatinfo_id = Chat_info::where('owner', session('prochatr_login_id'))->where('prepared_for', $req->aim)->get();

        if(count($chatinfo_id) > 0){
          $chatid = $chatinfo_id[0]->chat_id;
        }
        else{
          Chat_info::insert(['chat_id' => $chatid, 'owner' => session('prochatr_login_id'), 'prepared_for' => $req->aim]);
        }

        Chat::insert(['chat_id' => $chatid, 'message' => $req->message, 'user_id' => session('prochatr_login_id')]);

      }
      else{
         $resData = ['res' => '0', 'type' => 'sendMessage', 'msg' => 'User Error'];
      }

      return $this->returnJSON($resData);
    }

    public function resetlink(Request $req){
      //Validator
      $validator = Validator::make($req->all(),
         array(
             'email' => 'required|email',
         ));

      if($validator->fails()) {
         $resData = ['res' => '1', 'type' => 'Resetlink', 'msg' => 'Invalid Email Provided'];
         return $this->returnJSON($resData);
      }

      if($req->email && ($this->isEmail($req->email) == 1)){
        $tok = bcrypt($req->email);
        $settoken = Reset::insert(['token' => $tok, 'email' => $req->email]);

        if($settoken){
          $this->token = $tok;
        //   $this->sendEMail($req->email, 'resetlink');
          $this->sendEMail('babalolaebenezertaiwo@gmail.com', 'resetlink');
           $resData = ['res' => '1', 'type' => 'Resetlink', 'msg' => 'Link sent'];
        }
        else{
           $resData = ['res' => '1', 'type' => 'Resetlink', 'msg' => 'Failed'];
        }

      }
      else{
         $resData = ['res' => '1', 'type' => 'Resetlink', 'msg' => 'Invalid Address'];
      }
        return $this->returnJSON($resData);
    }

    public function getQuestion(Request $req){
      //Validator
      $validator = Validator::make($req->all(),
         array(
             'username' => 'required',
         ));

      if($validator->fails()) {
         $resData = ['res' => '1', 'type' => 'GetQuestion', 'msg' => 'Invalid Details Provided'];
         return $this->returnJSON($resData);
      }

      $getQuestion = Account::select('security')
                                ->where('accounts.username', $req->username)
                                ->get();

      if(count($getQuestion) > 0 && null != $getQuestion[0]->security){
        $resData = ['res' => '1', 'type' => 'GetQuestion', 'msg' => 'Success', 'data' => $getQuestion[0]->security];
      }
      else{
        $getQuestion = Personal_detail::select('user_id')
                                ->where('email', $req->username)
                                ->get();
        if(count($getQuestion) > 0)
        {
          $getQuestion = Account::select('security')
                                ->where('accounts.login_id', $getQuestion[0]->user_id)
                                ->get();
          if(count($getQuestion) > 0)
          {
            $resData = ['res' => '1', 'type' => 'GetQuestion', 'msg' => 'Success', 'data' => $getQuestion[0]->security];
          }
          else{
            $resData = ['res' => '1', 'type' => 'GetQuestion', 'msg' => 'Invalid Account'];
          }

        }
        else{
          $resData = ['res' => '1', 'type' => 'GetQuestion', 'msg' => 'Invalid Account'];
        }

      }

      return $this->returnJSON($resData);

    }

    public function activateSpace(Request $req){
        // update user
        $updtLogo = Companylogo::where('login_id', $req->login_id)->update(['status' => 1]);
        if($updtLogo == 1){
            // Send Mail

            $resData = ['res' => 'Successfully activated', 'message' => 'success'];
        }
        else{
            $resData = ['res' => 'Looks like something went wrong', 'message' => 'erro'];
        }

        return $this->returnJSON($resData);
    }

    public function trylogin(Request $req){
      //Validator
      $validator = Validator::make($req->all(),
         array(
             'accusername' => 'required',
             'answer' => 'required',
         ));

      if($validator->fails()) {
         $resData = ['res' => '1', 'type' => 'Trylogin', 'msg' => 'Invalid Details Provided'];
         return $this->returnJSON($resData);
      }

      $getUser = Account::select('login_id', 'firstname', 'lastname', 'accounts.username', 'image', 'answer')
                                ->join('personal_details', 'personal_details.user_id', '=', 'accounts.login_id')
                                ->where('accounts.username', $req->accusername)
                                ->get();

      if(count($getUser) > 0){
        if($req->answer == $getUser[0]->answer){
          $req->session()->put(['prochatr_login_id' => $getUser[0]->login_id, 'prochatr_firstname' => $getUser[0]->firstname, 'prochatr_lastname' => $getUser[0]->lastname, 'prochatr_image' => $getUser[0]->image]);
          $resData = ['res' => '1', 'type' => 'Trylogin', 'msg' => 'Success'];
        }
        else{
          $resData = ['res' => '1', 'type' => 'Trylogin', 'msg' => 'Failed to Login'];
        }
      }
      else{
        $resData = ['res' => '1', 'type' => 'Trylogin', 'msg' => 'Invalid Account'];
      }

      return $this->returnJSON($resData);

    }

    public function doreset(Request $req){
      //Validator
      $validator = Validator::make($req->all(),
         array(
             'password' => 'required',
             'token' => 'required',
         ));

      if($validator->fails()) {
         $resData = ['res' => '1', 'type' => 'Reset', 'msg' => 'Bad Password'];
         return $this->returnJSON($resData);
      }

        $checktoken = Reset::where('token', $req->token)->get();

        if(count($checktoken) > 0){
          Reset::where('token', $req->token)->delete();

          $getID = Personal_detail::select('user_id')->where('email', $checktoken[0]->email)->get();
          Account::where('login_id', $getID[0]->user_id)->update(['password' => bcrypt($req->password)]);

        //   $this->sendEMail($checktoken[0]->email, 'reset');
          $this->sendEMail('ebenezer@git-associates.com', 'reset');

          $resData = ['res' => '1', 'type' => 'Reset', 'msg' => 'Success'];
        }
        else{
           $resData = ['res' => '1', 'type' => 'Reset', 'msg' => 'Failed'];
        }

        return $this->returnJSON($resData);
    }

    public function Invite(Request $req){
      //Validator
      $validator = Validator::make($req->all(),
         array(
             'email' => 'required',
         ));

      if($validator->fails()) {
         $resData = ['res' => '0', 'type' => 'Invite'];
         return $this->returnJSON($resData);
      }

       //Send to Test Email
      $failed_mails = array();
      $doinvite = 0;

      $this->getActiveUserDetails();

       $splitted = explode(",", $req->email);
        foreach($splitted as $email){
          if($email && ($this->isEmail($email) == 1)){
            //Add to Database
            $doinsert = Prochatrinvite::insert(['inviteid' => session('prochatr_login_id'), 'email' => $email, 'name' => "Unknown", 'image' => $_SERVER['HTTP_ORIGIN'].'/asset/img/user.png']);

            $doinvite = 1;
            $this->sendEMail($email, 'invite');
            // $this->sendEMail('ebenezer@git-associates.com', 'invite');
          }
          else{
            array_push($failed_mails, trim($email));
          }
        }

      if($doinvite == 1){
        $resData = ['res' => '1', 'data' => $failed_mails, 'type' => 'Invite'];
      }
      else{
        $resData = ['res' => '0', 'type' => 'Invite'];
      }
      return $this->returnJSON($resData);
    }

    public function InviteContact(Request $req){
      $doinvite = 0;
      $count = 0;

      if($req->email && ($this->isEmail($req->email) == 1)){
        if($req->from == "google"){
          Prochatrinvite::updateOrCreate(['email' => $req->email, 'inviteid' => session('prochatr_login_id')], ['name' => $req->name, 'image' => $_SERVER['HTTP_ORIGIN'].'/asset/img/google.png']);
        }
        else{
          $getcount = Prochatrinvite::select('count')->where('email', $req->email)->get();
          $count = $getcount[0]->count+1;
        }

        $doupdate = Prochatrinvite::where('email', $req->email)->update(['count' => $count]);
        if($doupdate)
        {
          $doinvite = 1;
           $this->sendEMail($req->email, 'invite');
        //   $this->sendEMail('ebenezer@git-associates.com', 'invite');
        }
      }

      if($doinvite == 1){
        $resData = ['res' => '1', 'pos' => $req->pos, 'fail' => 0, 'count' => $count, 'type' => 'InviteContact'];
      }
      else{
        $resData = ['res' => '1', 'pos' => $req->pos, 'fail' => 1, 'count' => $count, 'type' => 'InviteContact'];
      }
      return $this->returnJSON($resData);
    }

    public function alternate_email(Request $req){
      //Validator
      $validator = Validator::make($req->all(),
         array(
             'alternate_email' => 'required|email',
         ));

      if($validator->fails()) {
         $resData = ['res' => '1', 'type' => 'alternate_email', 'msg' => 'Provide correct email'];
         return $this->returnJSON($resData);
      }

      $doinvite = 0;

      if($req->alternate_email && ($this->isEmail($req->alternate_email) == 1)){
        $save = Personal_detail::where('user_id', session('prochatr_login_id'))->update(['alternate_email' => $req->alternate_email]);
        if($save){
          $doinvite = 1;
        //   $this->sendEMail($req->alternate_email, 'alternate_email');
          $this->sendEMail('ebenezer@git-associates.com', 'alternate_email');

          //Get Other Email
          $other = Personal_detail::select('email')->where('user_id', session('prochatr_login_id'))->get();
        //   $this->sendEMail($other[0]['email'], 'alternate_email');
          $this->sendEMail('ebenezer@git-associates.com', 'alternate_email');
        }
      }

      if($doinvite == 1){
        $resData = ['res' => '1', 'msg' => 'Saved', 'type' => 'alternate_email'];
      }
      else{
        $resData = ['res' => '1', 'msg' => 'Email Error', 'type' => 'alternate_email'];
      }
      return $this->returnJSON($resData);
    }

    public function saveInterest(Request $req){
      //Validator
      $validator = Validator::make($req->all(),
         array(
             'about' => 'required',
             'offer' => 'required',
             'need' => 'required',
         ));

      if($validator->fails()) {
         $resData = ['res' => '1', 'type' => 'saveInterest', 'msg' => 'Kindly fill the form'];
         return $this->returnJSON($resData);
      }

      $insertData = Interest::updateOrInsert(['login_id' => session('prochatr_login_id')],['about' => $req->about, 'experience' => $req->experience, 'offer' => $req->offer, 'need' => $req->need]);

      if($insertData){
        $checkInterest = Connection::where('login_id', session('prochatr_login_id'))->get()->count();
        if($checkInterest > 0){
          $resData = ['res' => '1', 'msg' => 'Saved', 'type' => 'saveInterest'];
        }
        else{
          $resData = ['res' => '1', 'msg' => 'Please add users to your connection', 'type' => 'saveInterest'];
        }
      }
      else{
        $resData = ['res' => '1', 'msg' => 'Process failed', 'type' => 'saveInterest'];
      }
      return $this->returnJSON($resData);
    }

    public static function getUser($login_id){
      //Get other information for session user
      return $myInfo = Personal_detail::select('*')->where('email', $login_id)->get();
    }

    public function getActiveUserDetails(){
      //Get other information for session user
      $myInfo = Personal_detail::select('company', 'profession')->where('user_id', session('prochatr_login_id'))->limit(1)->get();
      $this->company = $myInfo[0]->company;
      $this->profession = $myInfo[0]->profession;
    }

    public function setBadge(Request $req){
      $state = 0;
      $resData = ['state' => $state, 'type' => ''];

      if($req->cat == "Voice"){
        $getBadge = Badge::where('login_id', session('prochatr_login_id'))->get();
        if(count($getBadge) > 0){
          Badge::where('login_id', session('prochatr_login_id'))->update(['Voice' => $getBadge[0]->Voice+5]);
        }
        else{
          Badge::insert(['login_id' => session('prochatr_login_id'), 'Voice' => 5]);
        }

        $resData = ['state' => 1, 'type' => $req->cat];
      }
      elseif($req->cat == "Video"){
        $getBadge = Badge::where('login_id', session('prochatr_login_id'))->get();
        if(count($getBadge) > 0){
          Badge::where('login_id', session('prochatr_login_id'))->update(['Video' => $getBadge[0]->Video+5]);
        }
        else{
          Badge::insert(['login_id' => session('prochatr_login_id'), 'Video' => 5]);
        }

        $resData = ['state' => 1, 'type' => $req->cat];
      }
      elseif($req->cat == "Contact"){
        $getBadge = Badge::where('login_id', session('prochatr_login_id'))->get();
        if(count($getBadge) > 0){
          Badge::where('login_id', session('prochatr_login_id'))->update(['Contact' => $getBadge[0]->Contact+5]);
        }
        else{
          Badge::insert(['login_id' => session('prochatr_login_id'), 'Contact' => 5]);
        }

        $resData = ['state' => 1, 'type' => $req->cat];
      }
      elseif($req->cat == "Invite"){
        $getBadge = Badge::where('login_id', session('prochatr_login_id'))->get();
        if(count($getBadge) > 0){
          Badge::where('login_id', session('prochatr_login_id'))->update(['Invite' => $getBadge[0]->Invite+5]);
        }
        else{
          Badge::insert(['login_id' => session('prochatr_login_id'), 'Invite' => 5]);
        }

        $resData = ['state' => 1, 'type' => $req->cat];
      }
      elseif($req->cat == "Groups"){
        $getBadge = Badge::where('login_id', session('prochatr_login_id'))->get();
        if(count($getBadge) > 0){
          Badge::where('login_id', session('prochatr_login_id'))->update(['Groups' => $getBadge[0]->Groups+5]);
        }
        else{
          Badge::insert(['login_id' => session('prochatr_login_id'), 'Groups' => 5]);
        }

        $resData = ['state' => 1, 'type' => $req->cat];
      }
      elseif($req->cat == "Conference"){
        $getBadge = Badge::where('login_id', session('prochatr_login_id'))->get();
        if(count($getBadge) > 0){
          Badge::where('login_id', session('prochatr_login_id'))->update(['Conference' => $getBadge[0]->Conference+5]);
        }
        else{
          Badge::insert(['login_id' => session('prochatr_login_id'), 'Conference' => 5]);
        }

        $resData = ['state' => 1, 'type' => $req->cat];
      }
      elseif($req->cat == "Messaging"){
        $getBadge = Badge::where('login_id', session('prochatr_login_id'))->get();
        if(count($getBadge) > 0){
          Badge::where('login_id', session('prochatr_login_id'))->update(['Messaging' => $getBadge[0]->Messaging+5]);
        }
        else{
          Badge::insert(['login_id' => session('prochatr_login_id'), 'Messaging' => 5]);
        }

        $resData = ['state' => 1, 'type' => $req->cat];
      }

      return $resData;
    }

    public function isEmail($email){
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return 1;
      } else {
        return 0;
      }
    }
























    // Web worker processes
    public function getcontacts(Request $req){
      //Insert to Personal Details
      $checkData = Personal_detail::join('accounts', 'accounts.login_id', '=', 'personal_details.user_id')->where('accounts.login_id', '!=', session('prochatr_login_id'))->get();

      $resData = 0;
      if(count($checkData) > 0){

        //Return Object
        $contact  = array();
        foreach($checkData as $user)
        {
          $NonConnected = Connection::where('connection_id', $user->user_id)->orwhere('connections.login_id', session('prochatr_login_id'))->get();
          if(count($NonConnected) < 1){
            array_push($contact, $user);
          }
        }

      }
      else{
        $resData = 1;
      }

      if($resData < 1){
        //Available Connections
        $resData = ['res' => 'Success', 'type' => 'getcontacts', 'data' => $contact];
      }
      else{
        //No Conncetions
        $resData = ['res' => 'Success', 'type' => 'getcontacts', 'data' => 0];
      }

      return $this->returnJSON($resData);
    }

    public function getConnections(Request $req){
      //Insert to Personal Details
      $checkData = Personal_detail::join('connections', 'connections.connection_id', '=', 'personal_details.user_id')->where('connections.connection_id', session('prochatr_login_id'))->orwhere('connections.login_id', session('prochatr_login_id'))->get();

      if(count($checkData) > 0){
        $resData = ['res' => 'Success', 'type' => $req->type, 'data' => $checkData];
      }
      else{
        $resData = ['res' => 'Success', 'type' => $req->type, 'data' => 0];
      }

      return $this->returnJSON($resData);
    }

    //END Of Web worker

























   function sendToApi($url, $data){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'Prochatr Application',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $data
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            $resData = ['res' => 'Thread Exception', 'title' => 'Error', 'state' => 3];
            return $this->returnJSON($resData);
        } else {
          // return $response;
            $data = json_decode($response);
            // return $data[0]->status;
            return $this->returnJSON($data[0]);
        }
   }

   public function sendEMail($to, $purpose){
      $objDemo = new \stdClass();
      $objDemo->purpose = $purpose;

      if($purpose == "invite"){
        $objDemo->profession = $this->profession;
        $objDemo->company = $this->company;
      }

      if($purpose == "inviteAdded"){
        $objDemo->profession = $this->profession;
        $objDemo->company = $this->company;
        $objDemo->action = $this->action;
        $objDemo->subject = $this->subject;
      }

      if($purpose == "welcome"){
        $objDemo->username = $this->username;
        $objDemo->password = $this->password;
        $objDemo->pin = $this->login_id;
        $objDemo->security = $this->security;
      }

      if($purpose == "resetlink"){
        $objDemo->token = $this->token;
      }

      if($purpose == "sendMessage"){
        $objDemo->message = $this->message;
        $objDemo->to = $this->name;
        $objDemo->from = session('prochatr_firstname')." ".session('prochatr_lastname');
      }

      if($purpose == "contact"){
        $objDemo->name = $this->name;
        $objDemo->email = $this->email;
        $objDemo->subject = $this->subject;
        $objDemo->message = $this->message;
        $objDemo->city = $this->city;
        $objDemo->state = $this->state;
        $objDemo->country = $this->country;
        $objDemo->pin = session('prochatr_login_id');
      }

      Mail::to($to)
            ->send(new sendEmail($objDemo));
   }

    public function returnJSON($data){
      return response()->json($data);
    }

   //END
}
