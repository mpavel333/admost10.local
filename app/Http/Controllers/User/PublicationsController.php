<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Auth;
use App\Models\Publications;
use Illuminate\Pagination\Paginator;

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


    public function submit(Request $request,$id=false)
    {
        
        $new = false;
        
        $user = Auth::user();
        $Publication = Publications::find($id);
        
        if(!$Publication): $Publication = new Publications; $new = true; endif;
        

        //$Publication = new Publications;
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
        
        if($request->input('date-2') && $request->input('time-2')){
            $Publication->date_repeat = date('Y-m-d H:i:s',strtotime($request->input('date-2').' '.$request->input('time-2')));
        }else{
            $Publication->date_repeat = NULL;
        }

        if($request->input('date-3') && $request->input('time-3')){
            $Publication->date_delete = date('Y-m-d H:i:s',strtotime($request->input('date-3').' '.$request->input('time-3')));
        }else{
            $Publication->date_delete = NULL;
        }
        
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
        
        
        if($new):
            $with=['success'=>'Публикация создана'];
        else:
            $with=['success'=>'Публикация обновлена'];
        endif;
        
        return redirect()->route('user.publications')->with($with);        
    
    }    
    
    
    public function publications()
    {
        Paginator::defaultView('/inc/paginator');
        
        $user = Auth::user();

        $publications = DB::table('publications')
         ->where('publications.user_id', $user->id)
         ->orderBy('id', 'DESC')
         ->paginate(10);       

        $published = DB::table('publications')
         ->where('publications.user_id', $user->id)
         ->where('publications.status', 1)
         ->orderBy('id', 'DESC')
         ->count();       
        
        

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

        }
        
        return view('user.publications.publications',['publications'=>$publications,'published'=>$published]);      
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
        
        $user = Auth::user();

        $published = DB::table('publications')
         ->where('publications.user_id', $user->id)
         ->where('publications.status', 1)
         ->orderBy('id', 'DESC')
         ->count(); 
        
        if($published < $user->PackageInfo()->count_channels_post){
            
            DB::table('publications')->where('id', $id)->update(['status' => 1]); 
            $with=['success'=>'Пост №'.$id.' опубликован в работу'];
        
        }else{
            $with=['error'=>'На вашем тарифе доступно максимум '.$user->PackageInfo()->count_channels_post.' каналов'];
        }
        
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
    
    
    public static function setStatus($id,$status)
    {
    
        DB::table('publications')->where('id', $id)->update(['status'=>$status]);
    
    }
    
    
    
    
    public static function addPublicationsTelegramDB($id,$message_id)
    {
    
        DB::table('publications_telegram')->insert(['publication_id'=>$id,
                                                    //'channel_id'=>$channel->id,
                                                    'message_id'=>$message_id,
                                                    "created_at"=>now(),
                                                    "updated_at"=>now()
                                                 ]);    
 
    
    }
    
    
    
    public static function getFiles($id,$extensions)
    {

        $files = DB::table('publications_files')->where('publications_files.publication_id', $id)
                                              ->join('files', function (JoinClause $join) use ($extensions) {
                                                    $join->on('files.id', '=', 'publications_files.file_id')
                                                         ->where('files.status', '=', 1)
                                                         ->whereIn('files.extension', $extensions);
                                                    })                                   
                                              ->select('publications_files.*','files.filename','files.path')
                                              ->get();  
    
        return $files;
    }
    
    
}
