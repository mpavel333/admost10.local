<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

use Illuminate\Database\Query\JoinClause;

use App\Models\Orders;

use Auth;
use DB;

use App\Models\Files;

use File;

class OrdersController extends Controller
{
    public function in_orders()
    {
        Paginator::defaultView('/inc/paginator');
        //$user = Auth::user();
        $orders = Orders::getUserInOrders();  
        
        //echo Orders::getUserInOrdersCount(); die;      
        
        return view('user.orders.in-orders',['orders'=>$orders]);      
    } 

    public function submit(Request $request,$id=false)
    {
        $new = false;
        
        $user = Auth::user();
        $Order = Orders::find($id);
        
        if(!$Order): $Order = new Orders; $new = true; endif;
            
        
        $Order->user_id = $user->id;
        $Order->channel_id = $request->input('channel_id');

        $Order->tariff_id = $request->input('tariff_id');
        
        $Order->name = $request->input('name');
        $Order->link = $request->input('link');
        $Order->message = $request->input('message');
        
        $Order->hide_text = $request->input('hide_text');
        
        
        if($request->input('links')){
            $links['links'] = $request->input('links');
            $links['links_text'] = $request->input('links_text');
            $Order->links = json_encode($links,JSON_UNESCAPED_UNICODE);
        }
        
        if($request->input('question')){
            $Order->question = json_encode($request->input('question'),JSON_UNESCAPED_UNICODE);
        }
                
        
        $Order->type = $request->input('type');
        
        
        
        
        $Order->published = date('Y-m-d H:i:s',strtotime($request->input('date-1').' '.$request->input('time-1')));
        $Order->answer = date('Y-m-d H:i:s',strtotime($request->input('date-2').' '.$request->input('time-2')));
        $Order->save();
        
        
        
        //////////////////
        if($request->input('del_files')){
            foreach($request->input('del_files') as $id){
                
            $File = Files::find($id);
            
                if($File){
                    DB::delete('delete from files where id = ?',[$File->id]);
                    DB::delete('delete from orders_files where file_id = ?',[$File->id]);
                    if(File::exists($File->path.'/'.$File->filename)) {
                        File::delete($File->path.'/'.$File->filename);
                        //$result_message = 'file delete';
                    }
                }
            
            }
        }
        /////////////////////        
        
        
        
        
        $files = $request->input('files');
        
        if($files){
            foreach($files as $file){
                DB::table('orders_files')->insert(['order_id'=>$Order->id,'file_id'=>$file,"created_at"=>now(),"updated_at"=>now()]);
                DB::table('files')->where('id',$file)->update(['status'=>1]);
            }
        }
        
        
        if($new):
            $with=['success'=>__('text.text_237', ['ID' => $Order->id])];
        else:
            $with=['success'=>__('text.text_238', ['ID' => $Order->id])];
        endif;
        //die;
        
        
        return redirect()->route('user.orders.out')->with($with);        
               
    } 
    
        
    
    public function edit($id)
    {   
        $user = Auth::user();
        
        $order = DB::table('orders')->where('user_id', $user->id)->where('id', $id)->first(); 
        if(!$order) return redirect()->route('user.orders.out')->with(['warning'=>'Такой пост не найден']); 

        $order->media = DB::table('orders_files')->where('orders_files.order_id', $id)
                                              ->join('files', function (JoinClause $join) {
                                                    $join->on('files.id', '=', 'orders_files.file_id')
                                                         ->where('files.status', '=', 1)
                                                         ->whereIn('files.extension', ['jpeg','jpg','png','gif']);
                                                    })                                   
                                              ->select('orders_files.*','files.filename','files.path')
                                              ->get();        

        
        
        $order->files = DB::table('orders_files')->where('orders_files.order_id', $id)
                                              ->join('files', function (JoinClause $join) {
                                                    $join->on('files.id', '=', 'orders_files.file_id')
                                                         ->where('files.status', '=', 1)
                                                         ->whereIn('files.extension', ['doc','docx','pdf','txt','xls','xlsx']);
                                                    })                                   
                                              ->select('orders_files.*','files.filename','files.path')
                                              ->get();        
        
        
        
        $tariffs = DB::table('tariffs')->where('channel_id', $order->channel_id)->get(); 
        $channel = DB::table('channels')->where('id', $order->channel_id)->first();
        
        return view('user.orders.edit',['publication'=>$order,'channel'=>$channel,'tariffs'=>$tariffs]);      
    } 
    
    

    public function out_orders()
    {
        Paginator::defaultView('/inc/paginator');
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
        
        return redirect()->route('user.orders.in')->with($with);        
               
    }     
    
    
    
    public function cancel($id,$hash)
    {
        
        if(hash('sha256', $id.env('ORDERS_SOLT')) !== $hash){
            echo 'hello hack:)'; die;
        }

        DB::table('orders')->where('id', $id)->update(['status' => 2]); 
       
        $with=['success'=>'Заявка №'.$id.' отменена'];
        
        return redirect()->route('user.orders.in')->with($with);        
               
    
    
    }    



    public static function getFiles($id,$extensions)
    {

        $files = DB::table('orders_files')->where('orders_files.order_id', $id)
                                              ->join('files', function (JoinClause $join) use ($extensions) {
                                                    $join->on('files.id', '=', 'orders_files.file_id')
                                                         ->where('files.status', '=', 1)
                                                         ->whereIn('files.extension', $extensions);
                                                    })                                   
                                              ->select('orders_files.*','files.filename','files.path')
                                              ->get();  
    
        return $files;
    }
    

    public static function addPublicationsTelegramDB($id,$message_id)
    {
    
        DB::table('orders_telegram')->insert(['order_id'=>$id,
                                                //'channel_id'=>$channel->id,
                                                'message_id'=>$message_id,
                                                "created_at"=>now(),
                                                "updated_at"=>now()
                                             ]);    
 
    
    }     
    
    
}
