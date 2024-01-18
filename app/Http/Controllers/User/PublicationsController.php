<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Auth;
use App\Models\Publications;

use App\Http\Controllers\DropzoneController;

use Illuminate\Database\Query\JoinClause;

use App\Models\Files;

use File;

class PublicationsController extends Controller
{
    
    
    public function add()
    {   
        $user = Auth::user();
        $channels = DB::table('channels')->where('user_id', $user->id)->where('tg_status', 1)->where('status', 1)->get();
        
        return view('user.publications.add',['channels'=>$channels]);      
    }       


    public function submit(Request $request)
    {
      
        $user = Auth::user();

        $Publication = new Publications;
        $Publication->user_id = $user->id;
        
        if($request->input('channels_id')) $Publication->channels_id = json_encode($request->input('channels_id'));
        
        $Publication->link = $request->input('link');
        $Publication->message = $request->input('message');
        $Publication->hide_text = $request->input('hide_text');
        
        
        if($request->input('links')){
            $links['links'] = $request->input('links');
            $links['links_text'] = $request->input('links_text');
            $Publication->links = json_encode($links,JSON_UNESCAPED_UNICODE);
        }
        
        if($request->input('question')){
            $Publication->question = json_encode($request->input('question'),JSON_UNESCAPED_UNICODE);
        }
        
        
        $Publication->notifications = $request->input('notifications') ? 1 : 0;
        $Publication->place = $request->input('place') ? 1 : 0;
        
        $Publication->type = $request->input('type');
        
        
        $Publication->date_published = date('Y-m-d H:i:s',strtotime($request->input('date-1').' '.$request->input('time-1')));
        $Publication->date_repeat = date('Y-m-d H:i:s',strtotime($request->input('date-2').' '.$request->input('time-2')));
        $Publication->date_delete = date('Y-m-d H:i:s',strtotime($request->input('date-3').' '.$request->input('time-3')));
        
        $Publication->save();
        
        
        //die;
                        
        
        $files = $request->input('files');
        
        if($files){
            foreach($files as $file){
                DB::table('publications_files')->insert(['publication_id'=>$Publication->id,'file_id'=>$file,"created_at"=>now(),"updated_at"=>now()]);
                DB::table('files')->where('id',$file)->update(['status'=>1]);
            }
        }
        
        
        $with=['success'=>'Публикация создана'];
        
        //die; 
        
        return redirect()->route('user.publications')->with($with);        
    
    }    
    


    public function edit_submit(Request $request,$id)
    {
      
        $user = Auth::user();

        $Publication = Publications::find($id);
        //$Publication->user_id = $user->id;
        
        if($request->input('channels_id')) $Publication->channels_id = json_encode($request->input('channels_id'));
        
        
        
        //$Order->name = $request->input('name');
        $Publication->link = $request->input('link');
        $Publication->message = $request->input('message');

        $Publication->hide_text = $request->input('hide_text');
        
        
        if($request->input('links')){
            $links['links'] = $request->input('links');
            $links['links_text'] = $request->input('links_text');
            //print_r($links); die;
            $Publication->links = json_encode($links,JSON_UNESCAPED_UNICODE);
        }
        
        if($request->input('question')){
            $Publication->question = json_encode($request->input('question'),JSON_UNESCAPED_UNICODE);
        }
        
        $Publication->notifications = $request->input('notifications') ? 1 : 0;
        $Publication->place = $request->input('place') ? 1 : 0;
        
        $Publication->type = $request->input('type');
        
        
        $Publication->date_published = date('Y-m-d H:i:s',strtotime($request->input('date-1').' '.$request->input('time-1')));
        $Publication->date_repeat = date('Y-m-d H:i:s',strtotime($request->input('date-2').' '.$request->input('time-2')));
        $Publication->date_delete = date('Y-m-d H:i:s',strtotime($request->input('date-3').' '.$request->input('time-3')));

        $Publication->save();
        
        //////////////////
        if($request->input('del_files')){
            foreach($request->input('del_files') as $id){
                
            $File = Files::find($id);
            
                if($File){
                    DB::delete('delete from files where id = ?',[$File->id]);
                    DB::delete('delete from publications_files where file_id = ?',[$File->id]);
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
                DB::table('publications_files')->insert(['publication_id'=>$Publication->id,'file_id'=>$file,"created_at"=>now(),"updated_at"=>now()]);
                DB::table('files')->where('id',$file)->update(['status'=>1]);
            }
        }
        
        
        $with=['success'=>'Публикация обновлена'];
        
        //die; 
        
        return redirect()->route('user.publications.edit',$id)->with($with);        
    
    }  

    
    
    public function publications()
    {
        $user = Auth::user();

        $publications = DB::table('publications')
                                     //->join('orders', 'channels.id', '=', 'orders.channel_id')
                                     //->leftjoin('channels', 'channels.id', '=', 'publications.channel_id')
                                     
        //->join('orders', function ($join) {
        //    $join->on('channels.id', '=', 'orders.channel_id')
        //         ->where('contacts.user_id', '>', 5);
       // })                                     
                                     
         ->where('publications.user_id', $user->id)
         
         //->select('publications.*','channels.name as channel_name','channels.image as channel_image')
         ->orderBy('id', 'DESC')
         ->get();        
        
        
        
        foreach($publications as $key=>$order){
            
            
            if($order->channels_id){
                $channels = DB::table('channels')->whereIn('id',json_decode($order->channels_id))->get();
                if(!empty($channels)) $publications[$key]->channels = $channels;
            }
            
            
            
            
            $files = DB::table('publications_files')->where('publications_files.publication_id', $order->id)
                                              ->join('files', function (JoinClause $join) {
                                                    $join->on('files.id', '=', 'publications_files.file_id')
                                                         ->where('files.status', '=', 1)
                                                         ->where('files.extension', '=', 'jpg');
                                                    })                                   
                                              ->select('publications_files.*','files.filename','files.path')
                                              ->get();
            
            if(!empty($files)) $publications[$key]->images = $files;
            
            
            //$orders[$key]->chat_messages_count = DB::table('orders_chat')->where('order_id', $order->id)->count();
        }
        
        return view('user.publications.publications',['publications'=>$publications]);      
    }   
    
    
    
    
    
    public function edit($id)
    {   
        $user = Auth::user();
        
        $publication = DB::table('publications')->where('user_id', $user->id)->where('id', $id)->first(); 
        if(!$publication) return redirect()->route('user.publications')->with(['warning'=>'Такой пост не найден']); 

        $publication->media = DB::table('publications_files')->where('publications_files.publication_id', $id)
                                              ->join('files', function (JoinClause $join) {
                                                    $join->on('files.id', '=', 'publications_files.file_id')
                                                         ->where('files.status', '=', 1)
                                                         ->whereIn('files.extension', ['jpeg','jpg','png','gif']);
                                                    })                                   
                                              ->select('publications_files.*','files.filename','files.path')
                                              ->get();        

        
        
        $publication->files = DB::table('publications_files')->where('publications_files.publication_id', $id)
                                              ->join('files', function (JoinClause $join) {
                                                    $join->on('files.id', '=', 'publications_files.file_id')
                                                         ->where('files.status', '=', 1)
                                                         ->whereIn('files.extension', ['doc','docx','pdf','txt','xls','xlsx']);
                                                    })                                   
                                              ->select('publications_files.*','files.filename','files.path')
                                              ->get();        
        
        
        
        
        $channels = DB::table('channels')->where('user_id', $user->id)->where('tg_status', 1)->where('status', 1)->get();
        
        return view('user.publications.edit',['publication'=>$publication, 'channels'=>$channels]);      
    } 



    
    
    
    
    
    public function published($id,$hash)
    {
        

        if(hash('sha256', $id.env('ORDERS_SOLT')) !== $hash){
            echo 'hello hack:)'; die;
        }

        DB::table('publications')->where('id', $id)->update(['status' => 1]); 
       
        $with=['success'=>'Пост №'.$id.' опубликован в работу'];
        
        return redirect()->route('user.publications')->with($with);        
               
    }     
    
    
    
    public function cancel($id,$hash)
    {
        
        if(hash('sha256', $id.env('ORDERS_SOLT')) !== $hash){
            echo 'hello hack:)'; die;
        }

        DB::table('publications')->where('id', $id)->update(['status' => 0]); 
       
        $with=['success'=>'Пост №'.$id.' отключен'];
        
        return redirect()->route('user.publications')->with($with);        
               
    
    
    }       
    
    
    
    
    
    
    
    
    
}
