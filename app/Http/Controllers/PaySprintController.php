<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Transaction;
use App\Subscribe;
use App\Personal_detail;

class PaySprintController extends Controller
{




    public function user(Request $req){

    


        $data = $req->all();
       

        if(env('APP_ENV') == "local"){
            $url = "http://localhost:3000/api/v1/customers";
            $data['mode'] = 'test';

        }
        else{
            $url = env('PAYSPRINT_BASE_URL')."/api/v1/customers";
            $data['mode'] = 'live';

        }
        
        
        
        $resp = $this->curlPost($url, $data);
        
        
        
        
        try {
            
            if($resp->status == 200){

                $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                $thisuser = Personal_detail::where('user_id', session('prochatr_login_id'))->first();




                $respData = [
                    'user_id' => session('prochatr_login_id'), 'ref' => date('dmYhis').time(), 'transaction' => $resp->data->paymentToken, 'email' =>  $thisuser->email, 'amount' => $resp->data->amount, 'description' => $req->purpose, 'currency' => $resp->data->currency, 'status' => 'success', 'message' => 'Payment successfull', 'channel' => 'PaySprint', 'referrer' => $actual_link, 'domain' => $data['mode']
                ];

                // dd($respData['user_id']);
                Transaction::insert($respData);

                $purpose = explode(": ", $req->purpose);



                $Date = date('Y-m-d', strtotime(now()));

                $expiry=date('Y-m-d', strtotime($Date. ' + 30 days'));

                if($purpose[0] == 'Annually'){
                    $expiry = date('Y-m-d', strtotime($Date. ' + 365 days'));
                }
        

                Subscribe::updateOrCreate(
                    ['email' => $thisuser->email],
                    ['login_id' => 1, 'amount' => $resp->data->amount, 'plan' =>$purpose[0], 'expiry'=>$expiry]
                );
                
                $data = $resp;
                $status = 200;
                $message = 'Payment made successfully!';
                $info = 'success';
            }
            else{
                $data = [];
                $status = 400;
                $message = $resp->message;
                $info = 'error';
            }



        } catch (\Throwable $th) {
            $data = [];
            $status = 400;
            $message = $th->getMessage();
            $info = 'error';
        }


           

        // $resData = ['data' => $data, 'message' => $message, 'status' => $status];

        $req->session()->put([$info => $message]);


        return redirect()->route('main.dashboard')->with($message, $info);

   }

    
    public function guest(Request $req){


        try {
            $data = $req->all();

            if(env('APP_ENV') == "local"){
               
                $url = "http://localhost:3000/api/v1/visitors";
                $data['mode'] = 'test';
            }
            else{
                $url = env('PAYSPRINT_BASE_URL')."/api/v1/visitors";
                $data['mode'] = 'live';
            }
    
            // dd($data);
    
            $resp = $this->curlPost($url, $data);

            // dd($resp);
    
            if($resp->status == 200){
    
                $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                $thisuser = Personal_detail::where('user_id', session('prochatr_login_id'))->first();

               
    
                $respData = [
                    'user_id' => session('prochatr_login_id'), 'ref' => date('dmYhis').time(), 'transaction' => $resp->data->paymentToken, 'email' => $thisuser->email, 'amount' => $resp->data->amount, 'description' => $req->purpose, 'currency' => $resp->data->currency, 'status' => 'success', 'message' => 'Verification successfull', 'channel' => 'PaySprint', 'referrer' => $actual_link, 'domain' => $data['mode'], 'created_at' => now(), 'updated_at' => now()
                ];
                //  dd($respData);
                 Transaction::insert($respData);

                 $purpose = explode(": ", $req->purpose);



                    $Date = date('Y-m-d', strtotime(now()));

                    $expiry=date('Y-m-d', strtotime($Date. ' + 30 days'));

                    if($purpose[0] == 'Annually'){
                        $expiry = date('Y-m-d', strtotime($Date. ' + 365 days'));
                    }


                    Subscribe::updateOrCreate(
                        ['email' => $thisuser->email],
                        ['login_id' => 1, 'amount' => $resp->data->amount, 'plan' =>$purpose[0], 'expiry'=>$expiry]
                    );
    
                $data = $resp;
                $status = 200;
                $message = 'Payment made successfully!';
                $info ='success';
            }
            else{
                $data = [];
                $status = 400;
                $message = $resp->message;
                $info ='error';
            }
        } catch (\Throwable $th) {
            

            $data = [];
                $status = 400;
                $message = $th->getMessage();
                $info ='error';
        }




        // $resData = ['data' => $data, 'message' => $message, 'status' => $status];
        $req->session()->put([$info => $message]);


        return redirect()->route('main.dashboard')->with($message, $info);

    }


    public function curlPost($url, $data){


        $token = env('PAYSPRINT_TOKEN');

        $curl = curl_init();
        // dd($curl);
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$token
        ),
        ));
        

        $response = curl_exec($curl);
        
       
       
        curl_close($curl);

        return json_decode($response);
    }


    public function returnJSON($data, $status)
    {
        return response()->json($data, $status);
    }

}
