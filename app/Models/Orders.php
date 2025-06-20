<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Query\JoinClause;

use Auth;
use DB;

class Orders extends Model
{
    use HasFactory;
    
    
    public static function getUserInOrdersCount(){
        
        $user = Auth::user();
        
        $orders = DB::table('channels')->where('channels.user_id', $user->id)
                                     
                                     ->join('orders', 'orders.channel_id', '=', 'channels.id')
                                     ->join('tariffs', 'orders.tariff_id' , '=', 'tariffs.id')
                                     
                                     ->select('orders.*','channels.name as channel_name','tariffs.format as tariff_format','tariffs.price as tariff_price')
                                     
                                     ->orderBy('id', 'DESC')
                                     ->count();  
                                     
                                                                                                               
        return $orders;                             
    }   
    
    public static function getUserOutOrdersCount(){
        
        $user = Auth::user();
        
        $orders = DB::table('orders')->where('orders.user_id', $user->id)
                                     ->leftjoin('channels', 'channels.id', '=', 'orders.channel_id')
                                     //->join('channels', 'channels.id', '=', 'orders.channel_id')
                                     ->select('orders.*','channels.name as channel_name')
                                     ->orderBy('id', 'DESC')
                                     ->count();   
        return $orders;                             
    }   
     
    
    
    public static function getUserInOrders(){
        
        $user = Auth::user();
        
        $orders = DB::table('channels')->where('channels.user_id', $user->id)
                                     ->join('orders', 'channels.id', '=', 'orders.channel_id')
                                     
                                     ->leftjoin('tariffs', 'orders.tariff_id' , '=', 'tariffs.id')
                                     
                                     //->join('channels', 'channels.id', '=', 'orders.channel_id')
                                     
        //->join('orders', function ($join) {
        //    $join->on('channels.id', '=', 'orders.channel_id')
        //         ->where('contacts.user_id', '>', 5);
       // })                                     
                                     
                                     
                                     ->select('orders.*','channels.name as channel_name','channels.image as channel_image',
                                              'tariffs.format as tariff_format','tariffs.price as tariff_price')
                                     ->orderBy('id', 'DESC')
                                     ->paginate(10);       
        
        foreach($orders as $key=>$order){
           
            $files = DB::table('orders_files')->where('orders_files.order_id', $order->id)
                                              ->join('files', function (JoinClause $join) {
                                                    $join->on('files.id', '=', 'orders_files.file_id')
                                                         ->where('files.status', '=', 1)
                                                         ->where('files.extension', '=', 'jpg');
                                                    })                                   
                                              ->select('orders_files.*','files.filename','files.path')
                                              ->get();
            
            if(!empty($files)) $orders[$key]->images = $files;
            
            
            $orders[$key]->chat_messages_count = DB::table('orders_chat')->where('order_id', $order->id)->count();
        }
        
        
        
                
        return $orders;
        
    }
    
    
    public static function getUserOutOrders(){
    
    
        $user = Auth::user();
        
        $orders = DB::table('orders')->where('orders.user_id', $user->id)
                                     ->leftjoin('channels', 'channels.id', '=', 'orders.channel_id')
                                     //->join('channels', 'channels.id', '=', 'orders.channel_id')
                                     ->leftjoin('tariffs', 'orders.tariff_id' , '=', 'tariffs.id')
                                     
                                     ->select('orders.*','channels.name as channel_name','channels.image as channel_image','tariffs.format as tariff_format', 'tariffs.price as tariff_price')
                                     ->orderBy('id', 'DESC')
                                     ->paginate(10);        
        
        foreach($orders as $key=>$order){
           
            $files = DB::table('orders_files')->where('orders_files.order_id', $order->id)
                                              ->join('files', function (JoinClause $join) {
                                                    $join->on('files.id', '=', 'orders_files.file_id')
                                                         ->where('files.status', '=', 1)
                                                         ->where('files.extension', '=', 'jpg');
                                                    })                                   
                                              ->select('orders_files.*','files.filename','files.path')
                                              ->get();
            
            if(!empty($files)) $orders[$key]->images = $files;
            
            $orders[$key]->chat_messages_count = DB::table('orders_chat')->where('order_id', $order->id)->count();
            
        }
        
        
        
                
        return $orders;    
    
    }
    
    
    
}
