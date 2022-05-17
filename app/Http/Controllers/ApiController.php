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
use App\Prochatrinvite;

class ApiController extends Controller
{
    public $valid = 0;
    public $platform = "d455167924436a19e50282c2a8250688";
    public $useragent = "Profilr cURL Request";
    public $userid = "";

    public function __construct(Request $req){
        $this->gettrust($req);
    }
    
    public function index(Request $req){
        // return $this->returnJSON($req->all());
        if($this->valid != 0)
        {
            //Proceed
            switch($req->action){
                case 'fetch_all':
                    return $this->returnJSON($this->getUser());
                break;                
                
                case 'validateimage':
                    return $this->returnJSON(array('validateimage' => $this->validateImage($req->image)));
                break;    
                
                case 'connection':
                    return $this->returnJSON($this->getConnections());
                break;    
                
                case 'get_profile':
                    return $this->returnJSON(array($this->getProfile($req->getuserId)));
                break;
                
                default:
                    return $this->returnJSON($req->all());
                    break;
            }
        }
        else{
            //Terminate
            $this->returnJSON(array('err', 'Failed to connect'));
        }
    }
    
    // //Verify platform originator and domain
    public function gettrust($platform){
        $useragent = $platform->headers->all()['user-agent'][0];
        $theplatform = $platform['platform'];

        if($theplatform == $this->platform && $useragent == $this->useragent)
        {
            $this->valid = 1;
            $this->userid = $platform['userid'];
        }
        else{
            $this->valid = 0;
        }
    }

    public function getUser(){
        //Get this user's information
        return Personal_detail::where('user_id', $this->userid)->get();
    }    
    
    public function getConnections(){
        //Get this user's information
        return Personal_detail::select('user_id As login_id', 'firstname', 'lastname', 'email', 'image As photo')->join('connections', 'connections.connection_id', '=', 'personal_details.user_id')->where('connections.connection_id', '!=', $this->userid)->where('connections.login_id', $this->userid)->get();
    }
    
    public function validateImage($image){
        //Validate user's image
        $re = '/[A-Za-z0-9]*\/[A-Za-z0-9]*\.[PNGJPGEIF]{3,4}/m';
        preg_match_all($re, $image, $matches, PREG_SET_ORDER, 0);
        
        $file = "";
        if(isset($matches[0][0]))
        {
            $file = $matches[0][0];
        }
        
        if(file_exists($_SERVER['DOCUMENT_ROOT']."/profile/".$file)){
            return 1;
        }else{
            return 0;
        }
    }    
    
    public function getProfile($user){
        //Get user's profile information
        return Personal_detail::select('city', 'company', 'country', 'email', 'firstname', 'lastname', 'image', 'position', 'profession')->where('user_id', $user)->get()[0];
    }
    
    public function returnJSON($data){
      return response()->json($data);
    }
    
  //END
}
