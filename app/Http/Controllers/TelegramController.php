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

use Illuminate\Console\Command;
use Workerman\Worker;

use DB;


use Crypter;

class TelegramController extends Controller
{
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
                                 
                                }
                            }
                        }
                    }
                    
                }
                
            }
            
            
            echo json_encode([
                'result'=>$result, 
                //'data'=>'test'
            ]);
    
    }  
    
    
    
    public static function autoposting()
    {
         //2023-07-25 19:23:00
         $published= date('Y-m-d H:i').':00';
         echo $published;
         
         $orders = DB::table('orders')
             ->join('channels', 'orders.channel_id', '=', 'channels.id')
             ->where(['orders.status' => 1,'orders.published'=>$published])
             ->select('orders.*','channels.link as channel_link')
         ->get();       
         
         //print_r($orders);
         
         //die;
        
        if($orders){
            
            foreach($orders as $key=>$order){
                
               $text = $order->message.'<a href="'.$order->link.'">'.$order->link.'</a>'; 
                

               $params = array(
                    //'chat_id' => '@1001823070497', // id получателя
                    'chat_id' => '@'.$order->channel_link,
                    'text' => $text, // текст сообщения
                    'parse_mode' => 'HTML', // режим отображения сообщения HTML (не все HTML теги работают)
               );
                    
               self::post($params);
                
            }
            
            
        }
    
    }
    
    public static function post($params)
    {

    
    //$tg_user = '1371820205'; // id пользователя, для отправки сообщения
    //$bot_token = '5265136546:AOG0bRakk4gApuJDRLdHL9J6tg_FUCSnlVA'; // токен бота
      
    //$text = "Первая строка сообщения со ссылкой \n Вторая строка с жирным текстом";
    
    /*  
    // параметры, которые отправятся в api телеграм
    $params = array(
        //'chat_id' => '@1001823070497', // id получателя
        'chat_id' => '@proitteh',
        'text' => 'test', // текст сообщения
        //'parse_mode' => 'HTML', // режим отображения сообщения HTML (не все HTML теги работают)
    );
    */
    
    $post = json_encode($params);  
      
    //$post = 'chat_id=@proitteh&message=ddddddddd&parse_mode=markdown';
      
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://api.telegram.org/bot'.self::TELEGRAM_TOKEN.'/sendMessage'); // адрес вызова api функции телеграм

    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    
    curl_setopt($curl, CURLOPT_POST, true); // отправка методом POST
    curl_setopt($curl, CURLOPT_TIMEOUT, 10); // время выполнения запроса
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION , true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post); // параметры запроса
    $result = curl_exec($curl); // запрос к api
    curl_close($curl);
      
    var_dump(json_decode($result));





    }
    

    
    public function del_post()
    {

    
    //$tg_user = '1371820205'; // id пользователя, для отправки сообщения
    //$bot_token = '5265136546:AOG0bRakk4gApuJDRLdHL9J6tg_FUCSnlVA'; // токен бота
      
    //$text = "Первая строка сообщения со ссылкой \n Вторая строка с жирным текстом";
      
    // параметры, которые отправятся в api телеграм
    $params = array(
        //'chat_id' => '@1001823070497', // id получателя
        'chat_id' => '@proitteh',
        'message_id' => 7, // текст сообщения
        //'parse_mode' => 'HTML', // режим отображения сообщения HTML (не все HTML теги работают)
    );
    
    $post = json_encode($params);  
      
    //$post = 'chat_id=@proitteh&message=ddddddddd&parse_mode=markdown';
      
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://api.telegram.org/bot'.self::TELEGRAM_TOKEN.'/deleteMessage'); // адрес вызова api функции телеграм

    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    
    curl_setopt($curl, CURLOPT_POST, true); // отправка методом POST
    curl_setopt($curl, CURLOPT_TIMEOUT, 10); // время выполнения запроса
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION , true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post); // параметры запроса
    $result = curl_exec($curl); // запрос к api
    curl_close($curl);
      
    var_dump(json_decode($result));





    }
    
 
 
    public function sendMessage(Request $request)
    {
        
        $user = Auth::user();
        
        
        //echo $request->input('order_id');
        //echo $request->input('user_id');
        //echo env('CHAT_HASH_SOLT');
        //echo '<br>';
        //echo '<br>';
        //echo hash('sha256', $request->input('order_id').$request->input('user_id').env('CHAT_HASH_SOLT'));
        //echo '-'.$request->input('hash');
        
        if(hash('sha256', $request->input('order_id').$request->input('user_id').env('CHAT_HASH_SOLT')) !== $request->input('hash')){
            echo 'hello hack:)'; 
            die;
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
    
    
 
    public static function getChatMessages($order_id,$user_id,$hash,$view=0,)
    {
/*
        echo $order_id;
        echo $user_id;
        echo env('CHAT_HASH_SOLT');
        echo '<br>';
        echo '<br>';
        echo hash('sha256', $order_id.$user_id.env('CHAT_HASH_SOLT'));
        echo '-'.$hash;

*/       

        if(hash('sha256', $order_id.$user_id.env('CHAT_HASH_SOLT')) !== $hash){
            echo 'hello hack:)'; 
            return;
            //die;
        }



        $messages = DB::table('orders_chat')->where('order_id', $order_id)->get();

        $out = '';
        foreach($messages as $message){
           
           if($message->user_id != $user_id && $view){
               DB::table('orders_chat')->where('id', $message->id)->update(['status'=>1]); 
           }
            
           if($message->user_id == $user_id){
                $message_type = 'message-to';
           }else{
                $message_type = 'message-from';
           }
            
           $out.='<div class="message-row '.$message_type.'">
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
        
        //return response()->json(['result'=>'success','messages'=>$messages]);


    } 
            

}
