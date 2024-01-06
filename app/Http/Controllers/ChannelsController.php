<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Channels;
use DB;

class ChannelsController extends Controller
{
    public function channels()
    {
        return view('channels.channels',['channels'=>Channels::where('tg_status', 1)->where('status', 1)->get()]);      
    } 
    
    public function channel($id)
    {

        $channel = DB::table('channels')->where('id', $id)->where('tg_status', 1)->where('status', 1)->first();        
        $tariffs = DB::table('tariffs')->where('channel_id', $id)->get();         
        
        return view('channels.channel',['channel'=>$channel,'tariffs'=>$tariffs]);      
    }  
    
    
    
}
