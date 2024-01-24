<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;


class BalanceController extends Controller
{


    public function index()
    {
        $user = Auth::user();
        //$channels = DB::table('channels')->where('user_id', $user->id)->get();        
        $history = [];
        return view('user.balance.index',['history'=>$history]);      
    }       
    

    public function submit(Request $request)
    {
        
        $user = Auth::user();
        
        $amount = $request->input('amount');
        
        if($amount && is_numeric($amount)){

            //DB::table('users')
            //->where('id', $user->id)
            //->update(['balance'=>($user->balance + $amount)]);         
            
            
            self::AddBalance($user,$amount);
            UserController::addReport($user,'Ваш баланс пополнен на '.$amount.'грн.');
                    
            $with=['success'=>'Ваш баланс пополнен на '.$amount.' грн'];
        
        }
        
        
        return redirect()->route('user.balance.index')->with($with); 
        
        
    } 
    
    
    public static function AddBalance($user,$amount)
    {
            
            DB::table('users')->where('id', $user->id)
            ->update(['balance'=>($user->balance + $amount)]);        
        
    }
    
    public static function MinBalance($user,$amount)
    {
        
            DB::table('users')->where('id', $user->id)
            ->update(['balance'=>($user->balance - $amount)]);         
            
    }


    public static function checkBalance($user,$amount)
    {
            
            if($user->balance<$amount):
                return false;
            else:
                return true;
            endif;
        
    }



        
    
    
}
