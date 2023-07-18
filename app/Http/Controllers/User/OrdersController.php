<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Orders;

use Auth;
use DB;

class OrdersController extends Controller
{
    public function orders()
    {
        //$user = Auth::user();
        $orders = Orders::getUserOrders();        
        
        return view('user.orders.orders',['orders'=>$orders]);      
    } 

    public function submit(Request $request)
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
        
        return redirect()->route('user.orders')->with($with);        
               
    } 
    
    
    
}
