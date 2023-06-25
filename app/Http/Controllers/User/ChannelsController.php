<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class ChannelsController extends Controller
{
    private const TELEGRAM_TOKEN = '6106644969:AAEDR6n9gVN-tXa2-pqTJeuQ8E4a7Q_b-ZY';
    
    public function channels()
    {
        $user = Auth::user();
        $channels = DB::table('tg_channels')->where('user_id', $user->id)->get();        
        
        return view('user.index',['channels'=>$channels]);      
    }       
    

    public function channel($id)
    {
        $user = Auth::user();
        $channel = DB::table('tg_channels')->where('id', $id)->where('user_id', $user->id)->first();        
        
        return view('user.channels.channel',['channel'=>$channel]);      
    }       
        
    
    public function add()
    {
        return view('user.channels.add');      
    }       


    public function submit(Request $request)
    {
      
        $user = Auth::user();

        $check = DB::table('tg_channels')
            ->where('user_id', $user->id)
            ->where('link', $request->input('link'))
            ->first();

        if(!$check){
        
            DB::table('tg_channels')->insert([
                'user_id'=>$user->id,
                'link'=>$request->input('link'),
                'description'=>$request->input('description')
            ]); 
            
            $with=['success'=>'Канал добавлен'];
        
        }else{
            
            $with=['error'=>'Такой канал уже существует'];
            
        }
                  
      
        return redirect()->route('user.index')->with($with)->withInput();
    }       

    public function check_tg_status()
    {

            $result = '';
            $with = [];
            
            $user = Auth::user();
            $channels = DB::table('tg_channels')->where('user_id', $user->id)->where('tg_status', 0)->get();
            
            if($channels){
            
                $links = [];
                foreach($channels as $channel){
                    $links[] = $channel->link;
                }
                
                $messages = [];
                
                $getData = file_get_contents('https://api.telegram.org/bot'.self::TELEGRAM_TOKEN.'/getUpdates');
                
                if(isset($getData)){
                    
                    $Data = json_decode($getData);
                    if($Data->ok){
                        //print_r($Data); die;
                        
                       foreach($channels as $channel){
    
                            foreach($Data->result as $key=>$value){
                                
                                if(isset($value->my_chat_member) && 
                                   $value->my_chat_member->chat->type == 'channel' &&
                                   (isset($value->my_chat_member->chat->username) && $value->my_chat_member->chat->username == $channel->link) &&
                                   $value->my_chat_member->new_chat_member->user->username == 'admost333_bot' &&
                                   $value->my_chat_member->new_chat_member->status == 'administrator'
                                   
                                   ){
                                    
                                    DB::table('tg_channels')
                                    ->where('id', $channel->id)
                                    ->update([
                                        'tg_status' => 1
                                    ]);   
                                    
                                    $messages[] = $channel->link; //.'('.$channel->link.')';                                  
                                    
                                }
                            }
                        
                        }
                        
                        if($messages)
                            $with=['success' =>'Канал(ы) '.implode(',',$messages).' подтверждены. Ожидайте подтверждения канал(а/ов) администратором.'];  
                        
                    }
                    
                }
            
            }else{
                
            }
                
        
        return redirect()->route('user.index')->with($with)->withInput();
    
    }
}
