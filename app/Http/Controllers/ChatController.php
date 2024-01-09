<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\App;

use Illuminate\Console\Command;
use Workerman\Worker;

use Illuminate\Support\Facades\Cookie;

use DB;


use Crypter;

class ChatController extends Controller
{


    public function sendMessage(Request $request)
    {
        
        $user = Auth::user();

        if(hash('sha256', $request->input('order_id').$request->input('user_id').env('CHAT_HASH_SOLT')) !== $request->input('hash')){
            //echo 'hello hack:)'; 
            //die;
            return;
        }
        
        DB::table('orders_chat')->insert(['order_id'=>$request->input('order_id'),
                                          'user_id'=>$user->id,
                                          'message'=>$request->input('message'),
                                          //'view'=>now(),
                                          "created_at"=>now(),
                                          "updated_at"=>now()
                                         ]);

        
        return response()->json(['result'=>'ok']);

    } 
    
    
 
    public static function getChatMessages($order_id,$user_id,$hash,$view=0)
    {
    
        if(hash('sha256', $order_id.$user_id.env('CHAT_HASH_SOLT')) !== $hash){
            //echo 'hello hack:)'; 
            //die;
            return;
        }

        $messages = DB::table('orders_chat')->where('order_id', $order_id)->get();

        $out = '';
        foreach($messages as $message){
           
           if($message->user_id != $user_id && $view){
               DB::table('orders_chat')->where('id', $message->id)->update(['status'=>1]); 
           }
            
           if($message->user_id == $user_id){
                $message_type = 'my-message';
           }else{
                $message_type = 'user-message';
           }
            
           $out.='<div class="message-row '.$message_type.' '.$message->user_id.'">
                    <div class="message-block">
                        <div class="message">
                            '.$message->message.'
                        </div>
                        <div class="message-info">
                            <div class="time">'.$message->created_at.'</div>
                            <div class="status">'.(($message->status!=1 and $message->user_id != $user_id) ? 'Ще не переглянуто' : '').'</div>
                        </div>
                    </div>
                </div>';
        }

        return $out;
        
    }

}
