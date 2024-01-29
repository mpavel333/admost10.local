<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

use Illuminate\Database\Query\JoinClause;

use Image;
use File;

use App\Http\Controllers\TelegramController;



use Illuminate\Support\Facades\Storage;


class ChannelsController extends Controller
{
    //private const TELEGRAM_TOKEN = '6106644969:AAEDR6n9gVN-tXa2-pqTJeuQ8E4a7Q_b-ZY';


      

    
    public function channels()
    {
        $user = Auth::user();
        $channels = DB::table('channels')->where('user_id', $user->id)->get();        
        
        return view('user.index',['channels'=>$channels]);      
    }       
    

    public function edit($id)
    {
        $user = Auth::user();
        $channel = DB::table('channels')->where('id', $id)->where('user_id', $user->id)->first();        
        $categories = DB::table('categories')->where('published', 1)->get(); 
        $tariffs = DB::table('tariffs')->where('channel_id', $id)->get(); 
        
        return view('user.channels.edit',['channel'=>$channel,'categories'=>$categories,'tariffs'=>$tariffs]);      
    }     
    
    
    public function edit_submit($id,Request $request)
    {
        $user = Auth::user();
        //$channel = DB::table('channels')->where('id', $id)->where('user_id', $user->id)->first();        
        
        
        
        $check = DB::table('channels')
            ->where('id', $id)
            ->where('user_id', $user->id)
            //->where('link', $request->input('link'))
            ->first();

        if($check){


///////////// DELETE

            $formats_del = $request->input('format_del');
            if($formats_del){
                //print_r($formats_del); 
                //echo implode(',',$formats_del);
                //die;
                DB::table('tariffs')->where('channel_id', $check->id)->whereIn('id', $formats_del)->delete(); 
            }
                        
//////////////// UPDATE            

            DB::table('channels')->where('id', $check->id)->update([
                'category_id'=>$request->input('category_id'),
                'description'=>$request->input('description'),
                'status'=>0
            ]);

            $formats = $request->input('format');
            $prices = $request->input('price');

            if($formats){
                foreach($formats as $key=>$format){            
                
                    $price = $prices[$key];
                    
                    if($format && is_numeric($price)){
                        
                        DB::table('tariffs')->where('id', $key)->where('channel_id', $check->id)->update([
                            'format'=>$format,
                            'price'=>$price,
                            //"updated_at"=>now()
                        ]); 
                        
                    }
                
                }            
            }               
            
///////////// ADD NEW

            $formats_new = $request->input('format_new');
            $prices_new = $request->input('price_new');
        
            if($formats_new){
                foreach($formats_new as $key=>$format){            
                
                    $price = $prices_new[$key];
                    
                    if($format && is_numeric($price)){
                        DB::table('tariffs')->insertGetId([
                            'channel_id'=>$id,
                            'format'=>$format,
                            'price'=>$price
                        ]); 
                    }
                
                }            
            }
                        
////////////////

            
            
            $with=['success'=>'Канал обновлен и ожидает подтверждения администратором'];
        
        }else{
            
            $with=['error'=>'Такой канал ненайден'];
            
        }        
        
        
        
     return redirect()->route('user.channels')->with($with)->withInput();   
        
        
        //return view('user.channels.edit',['channel'=>$channel]);      
    }     
    
      
        
    
    public function add()
    {
        
        $categories = DB::table('categories')->where('published', 1)->get();  
        return view('user.channels.add',['categories'=>$categories]);      
    }       


    public function submit(Request $request)
    {
      
        //$check_link = file_get_contents($request->input('link'));
        
        ///echo $check_link;
        
        //die;
      
        $user = Auth::user();

        $check = DB::table('channels')
            ->where('user_id', $user->id)
            ->where('link', $request->input('link'))
            ->where('tg_status', 1)
            ->first();

        if(!$check){
        
            
            //print_r($format);
            //print_r($price);
            
            
            //die;
        
            $id =  DB::table('channels')->insertGetId([
                'user_id'=>$user->id,
                'category_id'=>$request->input('category_id'),
                'link'=>$request->input('link'),
                'description'=>$request->input('description'),
                "created_at"=>now(),
                "updated_at"=>now()
            ]); 
            

            $formats = $request->input('format');
            $prices = $request->input('price');
        
            if($formats){
                foreach($formats as $key=>$format){            
                
                    $price = $prices[$key];
                    
                    if($format && is_numeric($price)){
                        DB::table('tariffs')->insertGetId([
                            'channel_id'=>$id,
                            'format'=>$format,
                            'price'=>$price
                        ]); 
                    }
                
                }            
            }
            
            
            
            
            $with=['success'=>'Канал добавлен'];
            
            
            return redirect()->route('user.channels')->with($with)->withInput();
            
            
        
        }else{
            
            $with=['error'=>'Такой канал уже добавлен в систему'];
            
            
            return redirect()->route('user.channels.add')->with($with)->withInput();
        }
                  
      
        
    }       

    public function check_tg_status()
    {

            $result = '';
            $with = [];
            
            $user = Auth::user();
            $channels = DB::table('channels')->where('user_id', $user->id)->where('tg_status', 0)->get();
            
            if($channels){
            
                $links = [];
                foreach($channels as $channel){
                    $links[] = $channel->link;
                }
                
                $messages = [];
                
                //$getData = file_get_contents('https://api.telegram.org/bot'.env('TELEGRAM_TOKEN').'/getUpdates');


                //$getMe = TelegramController::post([],'getMe');
                
                //print_r($getMe);

                
                
                //print_r($getChat);
                
                //$getMe = TelegramController::post([],'getMe');

                
                $Data = TelegramController::post([],'getUpdates');
                
                 //print_r($Data); die;
                 
                 
                
                if($Data && $Data->ok){
                    
                    //$Data = json_decode($getData);
                    //if($Data->ok){
                        
                   
                        
                       foreach($channels as $channel){
                        
                        
                            $creator = TelegramController::getChatAdministrators($channel->link);
                        
    
                            foreach($Data->result as $key=>$value){
                                
                                if($creator && isset($value->my_chat_member) && 
                                   $value->my_chat_member->chat->type == 'channel' &&
                                   (isset($value->my_chat_member->chat->username) && 
                                   $value->my_chat_member->chat->username == str_replace('https://t.me/','', $channel->link)) &&
                                   $value->my_chat_member->new_chat_member->user->username == env('BOT_USERNAME') &&
                                   $value->my_chat_member->new_chat_member->status == 'administrator'){
                                    
                                    //echo $key;
                                    
                                    $imageName = $channel->image; 
                                    
////////////////////////////
                                    $ChannelInfo = TelegramController::getChannelInfo($value->my_chat_member->chat->id);
                                    $photo = TelegramController::post(['file_id'=>$ChannelInfo->result->photo->small_file_id],'getFile');
                                    
                                    if($photo->result->file_path){
                                        $file = file_get_contents('https://api.telegram.org/file/bot'.env('TELEGRAM_TOKEN').'/'.$photo->result->file_path);
                                            
                                        $imageName = substr(md5(microtime() . rand(0, 9999)), 0, 20).'_'.date('d_m_Y').'.jpg';
                                        file_put_contents(public_path().'/images/channels/'.$imageName, $file);
                                    }

                                    
                                    if($file && $channel->image && File::exists(public_path().'/images/channels/'.$channel->image)){
                                            File::delete(public_path().'/images/channels/'.$channel->image);
                                    }

///////////////////////////                                    
                                    //die;
                                    
                                    DB::table('channels')
                                    ->where('id', $channel->id)
                                    ->update([
                                        'tg_status' => 1,
                                        'chat_id' => $value->my_chat_member->chat->id,
                                        'image' => $imageName,
                                        'full_info'=>$ChannelInfo->result->description
                                        //"updated_at"=>now()
                                    
                                    ]);   
                                    
                                    $messages[] = $channel->link; //.'('.$channel->link.')';     
                                    
                                    break;                             
                                    
                                }
                            }
                        
                        }
                        
                        if($messages)
                            $with=['success' =>'Канал(ы) '.implode(',',$messages).' подтверждены. Ожидайте подтверждения канал(а/ов) администратором.'];  
                        
                    //}
                    
                }
            
            }else{
                
            }
                
        
        return redirect()->route('user.index')->with($with)->withInput();
    
    }
}
