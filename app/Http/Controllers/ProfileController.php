<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use DB;

use Crypter;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
     
    private const TELEGRAM_TOKEN = '6106644969:AAEDR6n9gVN-tXa2-pqTJeuQ8E4a7Q_b-ZY';
     
     
    public function login_tg(Request $request)
    {
      
        $random = Str::random(40);
      
        return view('auth.login_tg',['random'=>$random]);      
      
      
      
    }   

    public function check_auth(Request $request)
    {

            $result = '';
    
            $getData = file_get_contents('https://api.telegram.org/bot'.self::TELEGRAM_TOKEN.'/getUpdates');
            
            if(isset($getData)){
                
                $Data = json_decode($getData);
                
                if($Data->ok){

                    //print_r($Data->result); die;

                    foreach($Data->result as $key=>$value){
                        if(isset($value->message)){
                            foreach($value->message as $key2=>$value2){
                                if($key2=='text' && $value2=='/start '.$_POST['key']){
                                    //echo 'ok';
                                    
                                    
                        $checkUser = DB::table('users')
                        ->where('telegram_id', $Data->result[$key]->message->from->id)
                        //->where('catalog_id', $column[0])
                        ->first(); 
                        
                        if($checkUser){
                            Auth::loginUsingId($checkUser->id);
                        }else{
                            $id = DB::table('users')->insertGetId([
                                'telegram_id'=>$Data->result[$key]->message->from->id,
                                'name'=>$Data->result[$key]->message->from->first_name,
                                'password'=>Hash::make(10),
                                'email'=>Str::random(10).'@t.me'
                            ]);
                            Auth::loginUsingId($id);
                        }        
                        
                        
                        $result = 'ok';
                            
                                    
/*                                    
                                    
                                    $_POST['telegram_id']=$Data->result[$key]->message->from->id;
                                    
                                    
                                    $_POST['login']=$Data->result[$key]->message->from->username;
                                    $_POST['password']=$Data->result[$key]->message->from->username.'333';
                                    //$_POST['password2']='';
                                    //$_POST['email']='';
                                    $_POST['name']=$Data->result[$key]->message->from->first_name;
                                    //$_POST['phone']='';
                                    //$_POST['dop_info']='';
                                    
                                    
                                    //print_r($_POST);
                                    
                                    $result = $Auth->RegisterTG();
                                    
                                    
*/                                    
                                }
                            }
                        }
                    }
                    
                }
                
                //print_r($getData);
            }
            
            
            //print_r($getData);
            
            echo json_encode([
                'result'=>$result, 
                //'data'=>'test'
            ]);
    
   
      
    }   
    
  
      
     

    public function admin(Request $request)
    {
        //echo 'admin';
       // die;
       return view('admin/index');
    }
     
    public function edit(Request $request): View
    {
        
        $user = $request->user();
        
        //echo $user->password; die;
        
        //$password = Hash::decrypt($user->password);
        
        return view('profile.edit', [
            'user' => $request->user(),
           // 'password'=>$password
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
