<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Workerman\Worker;

use App\Http\Controllers\TelegramController;

use \Auth;

use DB;

class Workerman extends Command
{
    protected $signature = 'workerman {action} {--daemonize}';
    protected $description = 'Command description';
    //private $user;
    
    //public $user;
    
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        //$user = Auth::user();
        
        
        //global $argv;//?????? 
        //$arg = $this->argument('action');
        //$argv[1] = $arg;
        //$argv[2] = $this->option('daemonize') ? '-d' : '';//?????daemon(????)????
 
        
$ws_worker = new Worker("websocket://127.0.0.1:8080");
$ws_worker->count = 1;

//$connections = [];
//global $user;

//$user_id = optional(Auth::user())->id;


$ws_worker->onConnect = function($connection) use($ws_worker)
{
    //global $user;
    
    echo 'New connect '.$connection->id; //.$user->id;
        
        //$connection->userColor='#000000';
   
        //$connections[$connection->id] = $connection;
        
        
/////////////////// Собираем список всех уже подключенных пользователей
/*
        $users = [];
        foreach ($ws_worker->connections as $c) {
            $users[] = [
                'userId' => $c->id,
                //'userName' => $c->userName,
                //'gender' => $c->gender,
                //'userColor' => $c->userColor,
            ];
        }   
*/
/////////////////////////////    
   
   
   
//////////////// Отправляем новому пользователю данные авторизации
/*

        $messageData = [
            'action' => 'Authorized',
            'userId' => $connection->id,
            //'userName' => $connection->userName,
            //'gender' => $connection->gender,
            //'userColor' => $connection->userColor,
            'userColor' => $connection->userColor,
            
            'users' => $users
        ];
        $connection->send(json_encode($messageData));

*/
////////////////////
        
        

/////////////////// Оповещаем всех подключенным пользователей о новом участнике в чате
/*
        //$messages = TelegramController::getChatMessages(8);  
        $messages = '';
        
        $messageData = [
            'action' => 'Connected',
            'userId' => $connection->id,
            //'userName' => $connection->userName,
            //'gender' => $connection->gender,
            //'userColor' => $connection->userColor
            //'users' => $users,
            'messages'=>$messages
        ];
        $message = json_encode($messageData);
        
        foreach ($ws_worker->connections as $c) {
            $c->send($message);
        }   
   
*///////////////////////   
   
   
    
    
    
};


/////////// Когда клиент отправляет сообщение

$ws_worker->onMessage = function($connection, $sendData) use ($ws_worker) {
 
/*
    $users = [];
    foreach ($ws_worker->connections as $id => $clientConnection) {
        
        //if ($connection->id == $id) {
            $ws_worker->connections[$connection->id]->sendData=json_decode($sendData);
            
            $users[$id] = $ws_worker->connections[$connection->id]->sendData;
        //}
        
        
    }

*/

     $data = json_decode($sendData);
     //print_r($data);
     
     $messages = TelegramController::getChatMessages($data->order_id,$data->user_id,$data->view);  

     $messageData = [
        'action' => 'Message',
        'connection_id' => $connection->id,
        //'user_id' => $user->id,
        //'userName' => $connection->userName,
        //'gender' => $connection->gender,
        //'userColor' => $connection->userColor,
        //'users' => $users,
        'messages'=>$messages
    ];
    $sendMessage = json_encode($messageData);

    foreach ($ws_worker->connections as $id => $clientConnection) {
        
        $clientConnection->send($sendMessage);
    }    
    

    //return redirect()->route('chat.get_chat_messages',['order_id'=>$data->order_id]);


};

/////////////////


$ws_worker->onClose = function($connection)
{
    echo 'Connection closed \n';
};       
        

        Worker::runAll();
    }
    
   
    
}