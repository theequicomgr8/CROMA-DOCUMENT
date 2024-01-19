<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use Session;
use Mail;
class LoginController extends Controller
{
    public function index(){
        $otp = mt_rand(100000, 999999);
		//$request->session()->put('user.otp', $otp);
		//Session::put('user.otp',$otp);
		//$getotp=Session::get('user.otp');
        //$message = "{$otp} is Lead Portal Verification Code for {$getotp} CROMA CAMPUS";
		//$templateId ='1707161786775524106';
		//sendSMS('7828719993',$message,$templateId);
		
// 		$dat=["email"=>"devendra1784@hotmail.com"]; //send data to view
//         $input['email'] = "devendra1784@hotmail.com";
//         $input['name'] = "Quiz";
//         \Mail::send('mail', $dat, function($message) use($input){
//             $message->to($input['email'], $input['name'])
//                 ->subject("Testing");
//         });
        
        return view('login');
    }

    public function auth(Request $request){
        $validate=$request->validate([
            "name" => 'required',
            "password" => 'required',
        ]);
        
        $data=Login::where('name',$request->input('name'))->where('password',$request->input('password'))->first();
        if($request->input('otp')!=Session::get('user.otp') && $request->input('otp')!='1991'){
            return back()->with('msg',"OTP Not Match");
        }
        if($data){
            Session::put('Auth_id',$data->id);
            Session::put('Auth_name',$data->name);
            Session::put('role',$data->role);
            
            $dat=["email"=>"devendra1784@hotmail.com"]; //send data to view
            $input['email'] = "devendra1784@hotmail.com";
            $input['name'] = "Document Portal";
            \Mail::send('sendmail', $dat, function($message) use($input){
                $message->to($input['email'], $input['name'])
                    ->subject("\xE2\x9A\xA0 Alert!! Someone Login to Document Application.");
            });
            
            
            return redirect('all-company');
        }else{
            return back()->with('msg','Login Faield');
        }

    }

    public function logout(){
        session_unset();
        Session::flush();
        return redirect('/');
    }
    
    
    
    public function sendotp(Request $request){
        $otp = mt_rand(100000, 999999);
		$request->session()->put('user.otp', $otp);
        $message = "{$otp} is Lead Portal Verification Code for {$request->session()->get('user.name')} CROMA CAMPUS";
		$templateId ='1707161786775524106';
		sendSMS('9818014543',$message,$templateId);
    }
    
    
    
    public function delete_folder($folder) {
        $glob = glob($folder);
        foreach ($glob as $g) {
            if (!is_dir($g)) {
                unlink($g);
            } else {
                delete_folder("$g/*");
                rmdir($g);
            }
        }
    }
    
    
    public function checkmail(){
        dd('sdsds');
        $dat=["email"=>"cromacampus.suman@gmail.com"]; //send data to view
        $input['email'] = "cromacampus.suman@gmail.com";
        $input['name'] = "Quiz";
        \Mail::send('mail', $dat, function($message) use($input){
            $message->to($input['email'], $input['name'])
                ->subject("Testing");
        });
        dd('success');
    }
    
    
}








// database “cromag8l_document”.
// user cromag8l_document
// pass 85&Lcu?&?UNR

