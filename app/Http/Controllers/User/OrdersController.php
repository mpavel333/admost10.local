<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Orders;

use Auth;
use DB;

class OrdersController extends Controller
{
    public function in_orders()
    {
        //$user = Auth::user();
        $orders = Orders::getUserInOrders();  
        
        //echo Orders::getUserInOrdersCount(); die;      
        
        return view('user.orders.in-orders',['orders'=>$orders]);      
    } 

    public function in_submit(Request $request)
    {
        $user = Auth::user();

        $Order = new Orders;
        $Order->user_id = $user->id;
        $Order->channel_id = $request->input('channel_id');
        
        $Order->name = $request->input('name');
        $Order->link = $request->input('link');
        $Order->message = $request->input('message');
        $Order->published = date('Y-m-d H:i:s',strtotime($request->input('date-1').' '.$request->input('time-1')));
        $Order->answer = date('Y-m-d H:i:s',strtotime($request->input('date-2').' '.$request->input('time-2')));
        $Order->save();
        
        $files = $request->input('images');
        
        if($files){
            foreach($files as $file){
                DB::table('orders_files')->insert(['order_id'=>$Order->id,'file_id'=>$file,"created_at"=>now(),"updated_at"=>now()]);
                DB::table('files')->where('id',$file)->update(['status'=>1]);
            }
        }
        
        
        $with=['success'=>'Заказ создан'];
        
        return redirect()->route('user.in-orders')->with($with);        
               
    } 


    public function out_orders()
    {
        //$user = Auth::user();
        $orders = Orders::getUserOutOrders();        
        
        return view('user.orders.out-orders',['orders'=>$orders]);      
    }    
    
    
    
    
    public function confirm($id,$hash)
    {
        

        if(hash('sha256', $id.env('ORDERS_SOLT')) !== $hash){
            echo 'hello hack:)'; die;
        }

        DB::table('orders')->where('id', $id)->update(['status' => 1]); 
       
        $with=['success'=>'Заявка №'.$id.' подтверждена'];
        
        return redirect()->route('user.in-orders')->with($with);        
               
    }     
    
    
    
    public function cancel($id,$hash)
    {
        
        if(hash('sha256', $id.env('ORDERS_SOLT')) !== $hash){
            echo 'hello hack:)'; die;
        }

        DB::table('orders')->where('id', $id)->update(['status' => 2]); 
       
        $with=['success'=>'Заявка №'.$id.' отменена'];
        
        return redirect()->route('user.in-orders')->with($with);        
               
    
    
    }    
     
    
    
}
