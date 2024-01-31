<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Workerman\Worker;

use App\Http\Controllers\ChatController;

//use \Auth;

use DB;

class Workerman extends Command
{
    //запуск
    //php artisan workerman server start --daemonize
    
    //https://github.com/walkor/workerman
    /*
    php start.php start  
    php start.php start -d  
    php start.php status  
    php start.php status -d  
    php start.php connections
    php start.php stop  
    php start.php stop -g  
    php start.php restart  
    php start.php reload  
    php start.php reload -g     
       
    */    
    //protected $signature = 'workerman {action} {--daemonize}';
    protected $signature = 'workerman {action} {param} {--daemonize}';
    protected $description = 'Command description';
    
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        
        global $text_worker; 
        global $argv;
        
        $argv[] = $this->option('daemonize') ? '-d' : '';
        
        $text_worker = new Worker("websocket://".env('WEBSOCKET'));
        $text_worker->count = 1;
        
        $text_worker->onConnect = function($connection) use($text_worker)
        {
            echo 'New connect '.$connection->id;
        };
        
        
        /////////// Когда клиент отправляет сообщение
        
        $text_worker->onMessage = function($connection, $sendData) use ($text_worker) {
        
             $data = json_decode($sendData);
             
                 ////////////
                 $check_connect = DB::table('orders_chat_connections')->where(['order_id'=>$data->order_id,'user_id'=>$data->user_id,'connection_id'=>$connection->id])->first(); 
                 if(!$check_connect){
                    DB::table('orders_chat_connections')->insert(['order_id'=>$data->order_id,'user_id'=>$data->user_id,'connection_id'=>$connection->id,'connected'=>now()]); 
                 }
                 ///////////
                 
                 $order_chat_connections = DB::table('orders_chat_connections')->where(['order_id'=>$data->order_id])->orderBy('id', 'ASC')->get(); 
                 
                 $ids=[];
                 foreach($order_chat_connections as $item){
                    $ids[]=$item->connection_id;
                 }
                 
                 foreach ($text_worker->connections as $id => $clientConnection) {
                    
                    if (in_array($id,$ids)) {
                        
                        $user = DB::table('orders_chat_connections')->where(['order_id'=>$data->order_id])->where(['connection_id'=>$id])->orderBy('id', 'ASC')->first(); 
                      
                        $messages = ChatController::getChatMessages($data->order_id,$user->user_id,$data->hash,$data->view,$connection->id);  
                         
                         $messageData = [
                            'action' => 'Message',
                            'order_id' => $data->order_id,
                            'connection_id' => $connection->id,
                            'messages'=>$messages
                        ];
                        $sendMessage = json_encode($messageData);              
                        $clientConnection->send($sendMessage);
                    }
                    
                } 
            
            //}   
            
        };
        
        /////////////////

        $text_worker->onClose = function($connection)
        {
            echo 'Connection closed \n';
            DB::table('orders_chat_connections')->where(['connection_id'=>$connection->id])->delete(); 
            
        };       
                

        Worker::runAll();
    }
    
   
    
}