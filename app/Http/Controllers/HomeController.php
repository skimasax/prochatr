<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SocialGoogleAccountService;
use Session;
use Socialite;

use Illuminate\Support\Facades\DB;

use App\Prochatrinvite;
use App\Connection;
use App\Personal_detail;
use App\interests;
use App\Companylogo as Companylogo;

class HomeController extends Controller
{
    //
    public $par = 0;
    public $company = 0;
    public $profession = 0;
    public $city = 0;
    public $country = 0;
    public $position = 0;
    public $gender = 0;
    public $need = 0;
    public $offer = 0;
    public $logo;

    public function index(){

        $getLogos = Companylogo::where('status', 1)->orderBy('created_at', 'DESC')->LIMIT(8)->get();
        return view('pages.index')->with(['title' => 'Prochatr - Instant Message and Notifications to your connections', 'companylogo' => $getLogos]);
    }
    public function professionalspace(){
        $getLogos = Companylogo::where('status', 1)->orderBy('created_at', 'DESC')->get();
        return view('pages.professionalspace')->with(['title' => 'Prochatr - Professional Space', 'companylogo' => $getLogos]);
    }

    public function dashboard(Request $req){
        $getInvites = Prochatrinvite::where('inviteid', session('prochatr_login_id'))->distinct()->get();
        // Check if logo is available
        $getLogo = Companylogo::where('login_id', session('prochatr_login_id'))->get();
        if(count($getLogo) > 0){
            $this->logo = $getLogo;
        }
        else{
            $this->logo = "";
        }


        $linkedinlist = $this->linkedInList();

        return view('pages.dashboard')->with('title', 'Prochatr - Dashboard')->with(['data' => $getInvites, 'companylogo' => $this->logo, 'linkedinlist' => $linkedinlist]);
    }

    public function userinterest(Request $req){
        return view('pages.userinterest')->with('title', 'Prochatr - Setup Finish')->with('data', $this->getConn(3, 3));
    }

    public function setup(Request $req){

        $linkedinlist = $this->linkedInList();


        return view('pages.setup')->with('title', 'Prochatr - Setup')->with(['data' => $this->getConn(3, 3), 'linkedinlist' => $linkedinlist]);
    }


    public function linkedInList(){

        $data = DB::table('linkedinlist')->where('status', 0)->inRandomOrder()->limit(500)->get();
        return $data;
    }

    public function myindustrylist(Request $req){
        return view('pages.myindustrylist')->with('title', 'Prochatr - Industry Personalized List')->with('data', $this->getList(10, 10));
    }

    public function getList($limit, $offset){
        $this->getActiveUserDetails();

        if($offset != 0){
        //For fresh set up
            return $ress = Personal_detail::select(DB::raw("Contact, Invite, Voice, Video, Messaging, Groups, Conference, interests.*, personal_details.*"))->join('interests', 'interests.login_id', '=', 'personal_details.user_id')
            ->join('badges', 'badges.login_id', '=', 'personal_details.user_id')
                                        ->where('position', $this->position)
                                        ->orWhere('company', $this->company)
                                        ->orWhere('profession', $this->profession)
                                        ->orWhere('city', $this->city)
                                        ->orWhere('country', $this->country)
                                        ->orWhere('gender', $this->gender)
                                        ->orWhere('interests.offer', $this->offer)
                                        ->orWhere('interests.need', $this->need)
                                        ->orderBy('Voice', 'desc')
                                        ->orderBy('Video', 'desc')
                                        ->orderBy('Invite', 'desc')
                            // ->offset($limit-$offset)->limit($limit)
                                ->get();
        }
        //To process fetchCalc for single industry
        else{
            $ress = Personal_detail::select(DB::raw("Contact, Invite, Voice, Video, Messaging, Groups, Conference, interests.*, personal_details.*"))->join('interests', 'interests.login_id', '=', 'personal_details.user_id')
            ->join('badges', 'badges.login_id', '=', 'personal_details.user_id')
                                        ->where('personal_details.user_id', $limit)
                                ->get();
            return $resData = ['state' => 1, 'type' => 'fetchCalc', 'res' => $ress, 'cat' => $offset];
        }

    }

    public function fetchCalc(Request $req){
      return $this->getList($req->userVal, $req->cat);
    }

    public function moreDetails(Request $req){
      return $this->getActiveUserDetails($req->userVal);
    }


    public function uploadCompanyLogo(Request $req){

        if($req->file('my_companylogo'))
        {
            //Get filename with extension
            $filenameWithExt = $req->file('my_companylogo')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);
            // Get just extension
            $extension = $req->file('my_companylogo')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = rand().'_'.time().'.'.$extension;
            //Upload Image
            // $path = $req->file('file')->storeAs('public/companylogo', $fileNameToStore);

            // $path = $req->file('my_companylogo')->move(public_path('/companylogo/'), $fileNameToStore);

            $path = $req->file('my_companylogo')->move(public_path('../../companylogo/'), $fileNameToStore);
        }
        else
        {
            $fileNameToStore = 'noImage.png';
        }

        // Check if image exist
        $checkImg = Companylogo::where('login_id', $req->login_id)->get();

        if($req->website == ""){
                $website = "#";
                $todo = "no website";
            }
            else{
                 $website = $req->website;
                 $todo = "yes website";
            }

        if(count($checkImg) > 0){
            // Update
            $updtLogo = Companylogo::where('login_id', $req->login_id)->update(['logo' => $fileNameToStore, 'website' => $website]);
            if($updtLogo == 1){
                return $resData = ['message' => 'Success', 'res' => 'Updated successfully', 'todo' => $todo];
            }
            else{
                return $resData = ['message' => 'error', 'res' => 'Looks like something went wrong'];
            }
        }
        else{

            // Insert
            $insLogo = Companylogo::insert(['login_id' => $req->login_id, 'logo' => $fileNameToStore, 'website' => $website, 'status' => 0]);


            if($insLogo == true){
                return $resData = ['message' => 'Success', 'res' => 'Updated successfully', 'todo' => $todo];
            }
            else{
                return $resData = ['message' => 'error', 'res' => 'Looks like something went wrong'];
            }
        }

    }

    public function getActiveUserDetails($userVal = 0){
      //Get other information for session user
        if($userVal == 0){
            $myInfo = Personal_detail::select('company', 'profession', 'city', 'country', 'position', 'gender', 'experience', 'offer', 'need')->join('interests', 'interests.login_id', '=', 'personal_details.user_id')->where('user_id', session('prochatr_login_id'))->limit(1)->get();

          $this->company = $myInfo[0]->company;
          $this->profession = $myInfo[0]->profession;
          $this->city = $myInfo[0]->city;
          $this->country = $myInfo[0]->country;
          $this->position = $myInfo[0]->position;
          $this->gender = $myInfo[0]->gender;
          $this->offer = $myInfo[0]->offer;
          $this->need = $myInfo[0]->need;

        }
        else{
            $myInfo = Personal_detail::select('company', 'profession', 'city', 'country', 'position', 'gender', 'experience', 'offer', 'need')->join('interests', 'interests.login_id', '=', 'personal_details.user_id')->where('user_id', $userVal)->limit(1)->get();
            return $resData = ['state' => 1, 'type' => 'moreDetails', 'res' => $myInfo, 'node' => $userVal];
        }
    }

    public function getConn($limit, $offset){
        //For fresh set up
        return $ress = DB::table('personal_details')
            ->whereNotIn('user_id', function($query)
            {
                $query->select(DB::raw('connection_id'))
                      ->from('connections')
                      ->whereRaw("connections.login_id = '".session('prochatr_login_id')."' ");
            })
            ->offset($limit-$offset)->limit($limit)->get();
    }

    public function getCon($limit, $offset, $param){
        $this->par = $param;
        //For fresh set up

            if(null != $this->par){
                $ress = DB::table('personal_details')
                    ->whereNotIn('user_id', function($query)
                    {
                        $query->select(DB::raw('connection_id'))
                              ->from('connections')
                              ->whereRaw("connections.login_id = '".session('prochatr_login_id')."' ");
                    })
                    ->whereIn('user_id', function($query)
                    {
                        $query->select(DB::raw('login_id'))
                              ->from('interests')
                              ->whereRaw("offer LIKE '%".$this->par."%' ");
                    })
                    ->offset($limit-$offset)->limit($limit)->get();
            }
            else{
                $ress = DB::table('personal_details')
                    ->whereNotIn('user_id', function($query)
                    {
                        $query->select(DB::raw('connection_id'))
                              ->from('connections')
                              ->whereRaw("connections.login_id = '".session('prochatr_login_id')."' ");
                    })
                    ->offset($limit-$offset)->limit($limit)->get();
            }

        $res = "";
        $i = 0;
        foreach($ress as $user){
              if(strlen($user->company) > 4 && strlen($user->profession) > 4){
                $str = $user->profession." At ".$user->company;}
              elseif(strlen($user->company) > 4 && strlen($user->position) > 4){
                $str = $user->position." At ".$user->company;}
              elseif(strlen($user->company) > 4 && !$user->position){
                $str = "Works At ".$user->company; }
              elseif(!$user->company && strlen($user->position) > 4){
                $str = "Works As ".$user->position;}
              elseif(strlen($user->company) > 4 && !$user->profession){
                $str = "Works At ".$user->company;}
              elseif(!$user->company && strlen($user->profession) > 4){
                $str = "Works As ".$user->profession;}
              else{
                $str = "Employed";
              }

            $res .= "
            <div class='col-md-4 wow load_result' id='result".$user->user_id."' data-wow-duration='1.4s'>
                <div class='box'>
                  <div class='icon'><img src='asset/img/logo/plogo.png' class='iconImg'></div>
                  <h4 class='title' title='".$user->firstname." ".$user->lastname."'><span>".str_limit($user->firstname." ".$user->lastname, 14)."</span></h4>
                  <p class='description'>".str_limit($str, 18)."</p>
                 <button type='button' class='btn btn-sm btn-primary pull-right addCon' data='".$user->user_id."' title='Add to connection' style='margin-top: 5px;' onclick=addCon('".$user->user_id."')><img src='asset/img/loading.gif' alt='' class='loading disp-0'>Add +</button>
                </div>
            </div>";
        }

        return $res;
    }

    public function loadMoreConnection(Request $req){
      return $this->getCon($req->get('limit'), $req->get('offset'), $req->param);
    }

    public function privacy(){
        return view('pages.privacy')->with('title', 'Prochatr - Privacy')->with('section', 'Privacy');
    }

    public function terms(){
        return view('pages.terms')->with('title', 'Prochatr - Terms of Use')->with('section', 'Terms Of Use');
    }

    public function resetpassword(){
        return view('pages.reset')->with('title', 'Reset Password')->with('section', 'Reset Password');
    }

    public function doresetpassword(){
        return view('pages.doreset')->with('title', 'Reset Password')->with('section', 'Reset Password');
    }

    public function googlecontact(Request $req){
        // return session('data')['entry'][2]['gd$email'][0]['address'];
        // dd(session('data')['author'][0]['email']['$t']);
        // dd(session('data'));
        return view('pages.googlecontact')->with('title', 'Google Contacts')->with('section', 'Contacts')->with('data', session('data'));
    }

    public function invites(Request $req){
        $getInvites = Prochatrinvite::where('inviteid', session('prochatr_login_id'))->distinct()->get();
        return view('pages.invites')->with('title', 'Invites')->with('section', 'Invites')->with('data', $getInvites);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        return $user = Socialite::driver('google')->user();

        // $user->token;
    }

    /**
     * Obtain the user information from provider.
     *
     * @return \Illuminate\Http\Response
     */
    // public function handleProviderCallback($driver)
    // {
    //     try {
    //         $user = Socialite::driver($driver)->user();
    //     } catch (\Exception $e) {
    //         return redirect()->route('login');
    //     }

    //     $existingUser = User::where('email', $user->getEmail())->first();

    //     if ($existingUser) {
    //         auth()->login($existingUser, true);
    //     } else {
    //         $newUser                    = new User;
    //         $newUser->provider_name     = $driver;
    //         $newUser->provider_id       = $user->getId();
    //         $newUser->name              = $user->getName();
    //         $newUser->email             = $user->getEmail();
    //         $newUser->email_verified_at = now();
    //         $newUser->avatar            = $user->getAvatar();
    //         $newUser->save();

    //         auth()->login($newUser, true);
    //     }

    //     return redirect($this->redirectPath());
    // }

    public function oauth(Request $req){
        if($req->get('error')){
            return view('pages.oauthfail')->with('title', 'Google Signin Error')->with('error', $req->get('error'))->with('section', 'Signin');
        }
        else{
        // return $req->all();
        $currentUrl = $_SERVER['REQUEST_URI'];
        $currentUrl = explode('?', $currentUrl);
        $client_id='950089246071-4n54jjosvme0oufrgh3huq362rra7uqg.apps.googleusercontent.com';
        $client_secret='Um66uHxVokwTfRBAIWwEPy-m';
        $redirect_uri='https://prochatr.com/app/oauth';
        $max_results = "100000000";
        if(isset($_GET["code"]))
        {
            $auth_code = $_GET["code"];
            $fields=array(
                'code'=>  urlencode($auth_code),
                'client_id'=>  urlencode($client_id),
                'client_secret'=>  urlencode($client_secret),
                'redirect_uri'=>  urlencode($redirect_uri),
                'grant_type'=>  urlencode('authorization_code'),
                'scheme'=>  urlencode('authorization_code')
            );
            $post = '';
            foreach($fields as $key=>$value)
            {
                $post .= $key.'='.$value.'&';
            }
            $post = rtrim($post,'&');
            $result = $this->curl('https://accounts.google.com/o/oauth2/token',$post);
            $response = json_decode($result);

            $accesstoken = $response->access_token;
            $url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results='.$max_results.'&alt=json&v=3.0&oauth_token='.$accesstoken;
            $xmlresponse =  $this->curl($url);
            $temp = json_decode($xmlresponse,true);
            // dd($temp['feed']['title']['$t']);
            return redirect()->route('main.app.oauth.list')->with('data', $temp['feed'])->with('title', 'Google Contacts')->with('section', 'Contacts');
            }
        }
    }

    public function curl($url,$post=""){
        $curl = curl_init();
        $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
        curl_setopt($curl,CURLOPT_URL,$url);    //The URL to fetch. This can also be set when initializing a session with curl_init().
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE); //TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
        curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,5);    //The number of seconds to wait while trying to connect.
        if($post!="")
        {
            curl_setopt($curl,CURLOPT_POST,5);
            curl_setopt($curl,CURLOPT_POSTFIELDS,$post);
        }
        curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);  //The contents of the "User-Agent: " header to be used in a HTTP request.
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);   //To follow any "Location: " header that the server sends as part of the HTTP header.
        curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);  //To automatically set the Referer: field in requests where it follows a Location: redirect.
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);    //The maximum number of seconds to allow cURL functions to execute.
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);  //To stop cURL from verifying the peer's certificate.
        $contents = curl_exec($curl);
        curl_close($curl);
        return $contents;
    }

}
