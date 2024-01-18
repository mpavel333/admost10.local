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

use Illuminate\Database\Query\JoinClause;

use Illuminate\Support\Facades\Cookie;

use DB;

use App\Models\User;



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
        
        //print_r($result);
 
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
         date_default_timezone_set('Europe/Kiev');
         
         $published= date('Y-m-d H:i').':00';
         echo 'time on server :'.$published;
         
         echo '<br><br>';
         
         
         
         /*
         $orders = DB::table('orders')
             ->join('channels', 'orders.channel_id', '=', 'channels.id')
             //->where(['orders.status' => 1,'orders.published'=>$published])
             ->where(['orders.status' => 1])
             ->select('orders.*','channels.link as channel_link')
         ->get();       
         
         print_r($orders);
         
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
        */
        
        
        
         $publications = DB::table('publications')
            ->where(['status' => 1])
            
            ->where(function ($query) use ($published) {
                $query->where('date_published', $published)
                      ->orWhere('date_repeat', $published);
            })            
          
         ->get();       
         
         //print_r($publications);        


        
         foreach($publications as $key=>$publication){
            

/*

    <option value="1">Изображение и описание</option>
    <option value="2">Группа изображений и описание</option>
    <option value="3">Изображение и кнопки(ссылки)</option>
    <option value="4">Опрос и описание</option>
    <option value="5">Простое сообщение</option>
    <option value="6">Документ</option>
*/
        
        
         
        
        $images = DB::table('publications_files')->where('publications_files.publication_id', $publication->id)
                                              ->join('files', function (JoinClause $join) {
                                                    $join->on('files.id', '=', 'publications_files.file_id')
                                                         ->where('files.status', '=', 1)
                                                         ->whereIn('files.extension', ['jpeg','jpg','png','gif']);
                                                    })                                   
                                              ->select('publications_files.*','files.filename','files.path')
                                              ->get();  

        
        $files = DB::table('publications_files')->where('publications_files.publication_id', $publication->id)
                                              ->join('files', function (JoinClause $join) {
                                                    $join->on('files.id', '=', 'publications_files.file_id')
                                                         ->where('files.status', '=', 1)
                                                         ->whereIn('files.extension', ['doc','docx','pdf','txt','xls','xlsx']);
                                                    })                                   
                                              ->select('publications_files.*','files.filename','files.path')
                                              ->get();  
                                              

                                              
        $channels = DB::table('channels')->whereIn('id',json_decode($publication->channels_id))->get();
        
            if($channels):  
                
                foreach($channels as $key=>$channel){
                    
                    $chat_id = str_replace('https://t.me/','',$channel->link);
                    
                    switch ($publication->type) {
                        case 1:
                           
                           //Изображение и описание
                            
                           $params = array(
                                'chat_id' => '@'.$chat_id,
                                
                                'photo' => (isset($images[0]))? env('APP_URL_DEV').'/'.$images[0]->path.'/'. $images[0]->filename : '', // режим отображения сообщения HTML (не все HTML теги работают)
                                //'photo'=>'https://w.wallhaven.cc/full/zy/wallhaven-zyvwyy.jpg',
                                
                                'caption'=> $publication->message,
                                'parse_mode' => 'HTML',
                           ); 
                           
                           //print_r($params);  
                                                      
                           $sendTelegram = self::post($params,'sendPhoto');     
                                              

                           break;
                        case 2:
                            
                          //Группа изображений и описание  
                            
                            $media = [];
                            $media_img = [];
                            foreach($images as $key=>$image){
                                if($key==0):
                                    array_push($media,['type' => 'photo', 'media' => 'attach://image_'.$key, 'caption'=>$publication->message, 'parse_mode' => 'HTML']);
                                else:
                                    array_push($media,['type' => 'photo', 'media' => 'attach://image_'.$key]);
                                endif;
                                $media_img['image_'.$key] = curl_file_create(env('APP_URL_DEV').'/'.$image->path.'/'. $image->filename);
                            }
                            
                            $params = [
                                'chat_id' => '@'.$chat_id,
                                'media' => json_encode($media),
                            ];                             
                            
                            $params = array_merge($params, $media_img);
                            

                            $sendTelegram = self::post_media($params,'sendMediaGroup');     
                            
                            //print_r($sendTelegram);                     
                           

                            break;
                        case 3:
                            
                        //Изображение и кнопки(ссылки)    
                        
                        $replyMarkup = [];
                        
                            if($publication->links){
                                $links = json_decode($publication->links);
                                $buttons=[];
                                foreach($links->links as $key=>$value){
                                    $buttons[]=['text'=>$links->links_text[$key],"url"=>$value];
                                }           
                                $replyMarkup = json_encode(["inline_keyboard"=>[$buttons]]);                            
                            
                            
                            //print_r($replyMarkup); //die;
                             
                            $params = array(
                                //'chat_id' => '@1001823070497', // id получателя
                                'chat_id' => '@'.$chat_id,
                                //'message_thread_id' => $result->result->message_thread_id, // текст сообщения
                                'photo' => (isset($images[0]))? env('APP_URL_DEV').'/'.$images[0]->path.'/'. $images[0]->filename : '', // режим отображения сообщения HTML (не все HTML теги работают)
                                'caption'=> $publication->message,
                                'parse_mode' => 'HTML',
                                
                                "reply_markup"=>$replyMarkup,
                            );                            
                            
                            $sendTelegram = self::post($params,'sendPhoto');   
                            
                            }
                            
                            break;
                        case 4:
                            
                            // Опрос и описание
                            if($publication->question){
                                $question = json_decode($publication->question);          
                                
                                //print_r($question);
                                
                                $params = array(
                                    'chat_id' => '@'.$chat_id,
                                    'question'=> $question->question,
                                    'options' => $question->variant,
                                );    
                                
                                //if($question->anonim==0) $params = array_merge($params, ['is_anonymous'=>'False']);
                                if($question->several==1) $params = array_merge($params, ['allows_multiple_answers'=>1]);
                                if($question->quiz==1):
                                    $params = array_merge($params, ['type'=>'quiz']);
                                    $params = array_merge($params, ['correct_option_id'=>0]);
                                endif;
    
                                $sendTelegram = self::post($params,'sendPoll');   
                                
                            }
                            
                            
                            break;
                            
    
                        case 5:
                        
                        //Простое сообщение
                        
                           $params = array(
                                //'chat_id' => '@1001823070497', // id получателя
                                'chat_id' => '@'.$chat_id,
                                'text' => $publication->message.' <a href="'.$publication->link.'">'.$publication->link.'</a>', // текст сообщения
                                'parse_mode' => 'HTML', // режим отображения сообщения HTML (не все HTML теги работают)
                           );
                                           
                            $sendTelegram = self::post($params,'sendMessage');                        
                        
                        
                        break;
                        
                        case 6:
                        
                        //Документ
                            
                            foreach($files as $key=>$file){
                            
                                $params = [
                                    'chat_id' => '@'.$chat_id,
                                    //'caption' => $publication->message,
                                    'document' => curl_file_create(env('APP_URL_DEV').'/'.$file->path.'/'. $file->filename)                                
                                ];                             
                                
                                $sendTelegram = self::post_media($params,'sendDocument'); 
                            
                            }                       
                            
                            //print_r($sendTelegram);
                        
                        break;
                        
                        
                        
                        
                    }
                    
                    
                    
                    
////////////////////////                 

                    if(isset($sendTelegram) && $sendTelegram->ok==1):
                        
                        if(is_array($sendTelegram->result)){
                            $message_ids = [];
                            foreach($sendTelegram->result as $message) $message_ids[]=$message->message_id;
                            $message_id = implode(',',$message_ids);
                        }else{
                            $message_id = $sendTelegram->result->message_id;
                        }
                        
                        DB::table('publications_telegram')->insert(['publication_id'=>$publication->id,
                                                                    //'channel_id'=>$channel->id,
                                                                    'message_id'=>$message_id,
                                                                    "created_at"=>now(),
                                                                    "updated_at"=>now()
                                                                 ]);    
                                                                 
                    
                        $User = User::find($publication->user_id);
                        DB::table('users')
                        ->where('id', $publication->user_id)
                        ->update(['balance'=>($User->balance - 300)]);                                                                 
                                                                                        
                    
                    else:
                        print_r($params);
                        print_r($sendTelegram);
                    endif;
                    
//////////////////////////                    
                      
                   
                 } 
                  
             endif;  
            
         
         }
        
        
        
        
    
    }

 
    public static function autopostingdelete()
    {   

         date_default_timezone_set('Europe/Kiev');
         
         $date= date('Y-m-d H:i').':00';
         echo 'time on server :'.$date;
          
         echo '<br><br>';
         
                 
        
         $publications = DB::table('publications')
         
         ->rightJoin('publications_telegram', 'publications.id', '=', 'publications_telegram.publication_id')
         ->where(['publications.status' => 1,'publications.date_delete'=>$date])
         //->where(['publications.status' => 1])
         ->select('publications_telegram.*','publications.channels_id')
         ->get();       
         
         //print_r($publications);    
         
         //die;    

             foreach($publications as $key=>$publication){
                
                if($publication->channels_id):
                    $channels = DB::table('channels')->whereIn('id',json_decode($publication->channels_id))->get();
    
                    if($channels):  
                        
                        foreach($channels as $key=>$channel){
                            
                            $chat_id = str_replace('https://t.me/','',$channel->link);
                            
                            $params = array(
                                'chat_id' => '@'.$chat_id,
                                'message_ids' => explode(',',$publication->message_id), // текст сообщения
                            );    
                        
                            $sendTelegram = self::post($params,'deleteMessages');  
                        
                        }
                    
                    endif;
               endif; 
               
               DB::delete('delete from publications_telegram where id = ?',[$publication->id]);
        
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

    public static function post_media($params,$method)
    {
    
        $curl = curl_init('https://api.telegram.org/bot'. env('TELEGRAM_TOKEN') .'/'.$method);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $result = curl_exec($curl);
        curl_close($curl);    
        
        return json_decode($result);
    }

    
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
        'message_id' => 152, // текст сообщения
        //'message_ids' => [134,135,136],
        //'parse_mode' => 'HTML', // режим отображения сообщения HTML (не все HTML теги работают)
    );
    
    $post = json_encode($params);  
      
    //$post = 'chat_id=@proitteh&message=ddddddddd&parse_mode=markdown';
      
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://api.telegram.org/bot'.env('TELEGRAM_TOKEN').'/deleteMessage'); // адрес вызова api функции телеграм
    //curl_setopt($curl, CURLOPT_URL, 'https://api.telegram.org/bot'.env('TELEGRAM_TOKEN').'/deleteMessages'); // адрес вызова api функции телеграм

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
