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

use Illuminate\Support\Facades\App;

use Illuminate\Console\Command;
use Workerman\Worker;

use Illuminate\Support\Facades\Cookie;

use DB;


use Crypter;

class TelegramController extends Controller
{
/*     
    public function login_tg(Request $request)
    {
      
        $random = Str::random(40);
        return view('auth.login_tg',['random'=>$random]);      
      
    }   

*/

    public static function getTelegramUserData() {
      if (isset($_COOKIE['tg_user'])) {
        $auth_data_json = urldecode($_COOKIE['tg_user']);
        $auth_data = json_decode($auth_data_json, true);
        return $auth_data;
      }
      return false;
    }




    private function checkTelegramAuthorization($request) {
        
      $auth_data = $request->all();
        
      $check_hash = $auth_data['hash'];
      unset($auth_data['hash']);
      $data_check_arr = [];
      
      
      foreach ($auth_data as $key => $value) {
        $data_check_arr[] = $key . '=' . $value;
      }
      sort($data_check_arr);
      $data_check_string = implode("\n", $data_check_arr);
      $secret_key = hash('sha256', env('TELEGRAM_TOKEN'), true);
      $hash = hash_hmac('sha256', $data_check_string, $secret_key);
      if (strcmp($hash, $check_hash) !== 0) {
        throw new Exception('Data is NOT from Telegram');
      }
      if ((time() - $auth_data['auth_date']) > 86400) {
        throw new Exception('Data is outdated');
      }
      return $auth_data;
    }
    
    private function saveTelegramUserData($auth_data) {
        
      //print_r($auth_data);  
      //die;
      
        $checkUser = DB::table('users')
        ->where('telegram_id', $auth_data['id'])
        //->where('catalog_id', $column[0])
        ->first(); 
        
        if($checkUser){
            Auth::loginUsingId($checkUser->id);
        }else{
            $id = DB::table('users')->insertGetId([
                'telegram_id'=>$auth_data['id'],
                'name'=>$auth_data['first_name'],
                'password'=>Hash::make(10),
                'email'=>Str::random(10).'@t.me'
            ]);
            Auth::loginUsingId($id);
        }         
      
      
        
      $auth_data_json = json_encode($auth_data);
      //setcookie('tg_user', $auth_data_json,);
      
      Cookie::queue('tg_user', $auth_data_json, env('SESSION_LIFETIME', 120));
      
      
    }

    
    public function check_auth(Request $request)
    {        
        
        try {
          $auth_data = $this->checkTelegramAuthorization($request);
          $this->saveTelegramUserData($auth_data);
        } catch (Exception $e) {
          die ($e->getMessage());
        }
        
        //header('Location: login_example.php');
        
        return redirect()->route('login');

    }


    public static function getUpdates()
    {     

                   
        $result = self::post([],'getUpdates');
        
        print_r($result);
 
        //return $result;    
            
    
    }

    public static function getChannelInfo($chat_id)
    {     

        $params = [
            'chat_id' => $chat_id
        ];                   
                   
                   

        $result = self::post($params,'getChat');
        
        //print_r($result);
 
        return $result;    
            
    
    }


    public static function getChatAdministrators($chat_id)
    {     
        
        $user = Auth::user();
        
        $params = [
            'chat_id' => '@'.str_replace('https://t.me/','', $chat_id)
        ];                   
                   
        $Administrators = self::post($params,'getChatAdministrators');
        
        $result = false;
        
        if($Administrators->ok && $Administrators->result){
            foreach($Administrators->result as $key=>$item){
                
                if($item->user->id == $user->telegram_id && $item->status=='creator'){
                    $result = true;
                    break;
                }
                
            }
        }
        
        //print_r($result);
 
        return $result;    
            
    
    }


    

//getFile?file_id=the_file_id



    
    public static function autoposting()
    {
         //2023-07-25 19:23:00
         $published= date('Y-m-d H:i').':00';
         echo 'time on server :'.$published;
         
         $orders = DB::table('orders')
             ->join('channels', 'orders.channel_id', '=', 'channels.id')
             ->where(['orders.status' => 1,'orders.published'=>$published])
             ->select('orders.*','channels.link as channel_link')
         ->get();       
         
         //print_r($orders);
         
         //die;
        
        if($orders){
            
            foreach($orders as $key=>$order){
                
               //$text = $order->message.'<a href="'.$order->link.'">'.$order->link.'</a>'; 
                

               $params = array(
                    //'chat_id' => '@1001823070497', // id получателя
                    'chat_id' => '@'.$order->channel_link,
                    'text' => $order->message, // текст сообщения
                    'parse_mode' => 'HTML', // режим отображения сообщения HTML (не все HTML теги работают)
               );
                    
               self::post($params,'sendMessage');
                
            }
            
            
        }
    
    }
    
 
    public static function test_post()
    {
         //2023-07-25 19:23:00
         $published= date('Y-m-d H:i').':00';
         //echo $published;
         
         $orders = DB::table('orders')
             ->join('channels', 'orders.channel_id', '=', 'channels.id')
             ->where(['orders.status' => 1])
             ->select('orders.*','channels.link as channel_link')
         ->get();       
         
         //print_r($orders);
         
         //die;
        
        if($orders){
            
            foreach($orders as $key=>$order){
                
               $text = $order->message.'<a href="'.$order->link.'">'.$order->link.'</a>'; 
                

    $inline_button1 = array("text"=>"Google url","url"=>"http://google.com");
    $inline_button2 = array("text"=>"work plz","callback_data"=>'/plz');
    $inline_button3 = array("text"=>"1","callback_data"=>'/plz');
    $inline_button4 = array("text"=>"2","callback_data"=>'/plz');
    $inline_button5 = array("text"=>"3","callback_data"=>'/plz');
    $inline_button6 = array("text"=>"4","callback_data"=>'/plz');
    $inline_keyboard = [[$inline_button1,$inline_button2,$inline_button3,$inline_button4,$inline_button5,$inline_button6]];
    $keyboard=array("inline_keyboard"=>$inline_keyboard);
    $replyMarkup = json_encode($keyboard);


/*
               $params = array(
                    //'chat_id' => '@1001823070497', // id получателя
                    'chat_id' => '@'.$order->channel_link,
                    'text' => $text, // текст сообщения
                    //'parse_mode' => 'HTML', // режим отображения сообщения HTML (не все HTML теги работают)
                    "reply_markup"=>$replyMarkup,
               );
                    
               
                $result = self::post($params,'sendMessage');
               
              print_r($result); 
               
*/               //if($result->ok==1){
                   //echo $result->result->message_id; 
                   
                   //http://admost10.local/uploads/2023/07/25/8ce370a7a741e653db89_25_07_2023.jpg


//////// фото

                   $params = array(
                        //'chat_id' => '@1001823070497', // id получателя
                        'chat_id' => '@'.$order->channel_link,
                        //'message_thread_id' => $result->result->message_thread_id, // текст сообщения
                        'photo' => 'https://www.ixbt.com/img/n1/news/2022/3/1/62342d1404eb2_large.jpg', // режим отображения сообщения HTML (не все HTML теги работают)
                        'caption'=> $text,
                        'parse_mode' => 'HTML',
                        
                        "reply_markup"=>$replyMarkup,
                   );
                   
                   //print_r($params);
                        
                   //$result = self::post($params,'sendPhoto');
                   
                   //print_r($result);
                   
                   
                   
                   

//////// группа файлов
                   
//https://habr.com/ru/articles/697010/               
                   
$params = [
    'chat_id' => '@'.$order->channel_link,
    'media' => json_encode([
	    ['type' => 'photo', 'media' => 'attach://cat.jpg', 'caption'=>$text, 'parse_mode' => 'HTML'],
	    ['type' => 'photo', 'media' => 'attach://cat_2.jpg'],
	    ['type' => 'photo', 'media' => 'attach://cat_3.jpg'],
    ]),
    'cat.jpg' => curl_file_create('https://www.ixbt.com/img/n1/news/2022/3/1/62342d1404eb2_large.jpg'),
    'cat_2.jpg' => curl_file_create('https://img.freepik.com/free-photo/mountains-lake_1398-1150.jpg'),
    'cat_3.jpg' => curl_file_create('https://img.freepik.com/free-photo/field-at-sunset_1204-65.jpg'),
];                   
                   
                   
                   //print_r($params);
                        
                   //$result = self::post($params,'sendMediaGroup');
                   
                   


//$result = self::post($params,'sendMediaGroup');

//print_r($result);
                   
                  
$ch = curl_init('https://api.telegram.org/bot'. env('TELEGRAM_TOKEN') .'/sendMediaGroup');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
$res = curl_exec($ch);
curl_close($ch);

echo $res;                   
                  
/////////////////                 
                   
                   
                   
                    
               //} 
                
                
            }
            
            
        }
    
    }   
    
    
/*   

    public static function test_post()
    {
        

       $params = array(
            //'chat_id' => '@1001823070497', // id получателя
            'chat_id' => '@proitteh',
            'text' => 1111111, // текст сообщения
            'parse_mode' => 'HTML', // режим отображения сообщения HTML (не все HTML теги работают)
       );
                       
        $sendMessage = self::post($params,'sendMessage');
        

       //print_r($sendMessage); die;
       
       $params = array(
            //'chat_id' => '@1001823070497', // id получателя
            'chat_id' => '@proitteh',
            'message_thread_id' => $sendMessage->result->message_id, // текст сообщения
            'photo' => '/uploads/2023/07/07/04ea858c54cfc661475a_07_07_2023.jpg'
            //'parse_mode' => 'HTML', // режим отображения сообщения HTML (не все HTML теги работают)
       );
        
        
        $sendPhoto = self::post($params,'sendPhoto');
        
        print_r($sendPhoto);
        
    }
*/

    
    public static function post($params,$method)
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
    curl_setopt($curl, CURLOPT_URL, 'https://api.telegram.org/bot'.env('TELEGRAM_TOKEN').'/'.$method); // адрес вызова api функции телеграм

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
      
    //var_dump(json_decode($result));


        return json_decode($result);


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
    
    
 
    public static function getChatMessages($order_id,$user_id,$hash,$view=0,$connection_id)
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

     //   if(hash('sha256', $order_id.$user_id.env('CHAT_HASH_SOLT')) !== $hash){
     //       echo 'hello hack:)'; 
     //       return;
            //die;
     //   }

        
        
        

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
            
           
            $out.='<div class="message-row '.$message_type.'">
                    <div class="message-block">
                        <div class="message">
                            '.$message->message.'
                        </div>
                        <div class="message-info">
                            <div class="time">'.$message->created_at.'</div>
                            
                        </div>
                    </div>
                </div>';
        }   
        
        //<div class="status">'.(($message->status!=1 and $message->user_id != $user_id) ? 'Ще не переглянуто' : '').'</div>

        return $out;
        
        //return response()->json(['result'=>'success','messages'=>$messages]);


    } 
            

}
