<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Illuminate\Support\Facades\Log;

class APItgstatController extends Controller
{
    //https://api.tgstat.ru/channels/stat?token=aa3fda42d37be6dd0d75bb9921ceebea&channelId=@figma_templates

    public static function getStat()
    {    
        date_default_timezone_set('Europe/Kiev');
        //echo date('Y-m-d H:i:s',strtotime("+1 day")); 
        
        $channels = DB::table('channels')
        ->where('tg_status', 1)
        ->where('status', 1)
        
        ->where(function ($query) {
            //$query->whereRaw('tgstat_last_update > (NOW() + INTERVAL ? DAY)', 1)
            $query->where('tgstat_last_update', '>', date('Y-m-d H:i:s',strtotime("-1 day")))
                ->orWhereNull('tgstat_last_update');
        })
        
        ->skip(0)->take(50)
        ->get(); 
         
        foreach($channels as $key => $channel):
            
            $channel_info = self::get('stat',$channel->link);
            $channel_views = self::get('views',$channel->link,'month');
            
            if(!empty($channel_info)){
                
                DB::table('channels')->where('id', $channel->id)
                ->update(['name'=>$channel_info->title,
                          'subscribers'=>$channel_info->participants_count,
                          'er'=>$channel_info->er_percent,
                          'views'=>(isset($channel_views))? $channel_views[0]->views_count : 0,
                          'cpv'=>$channel_info->ci_index,  
                          'tgstat'=>json_encode($channel_info,JSON_UNESCAPED_UNICODE), 
                          'tgstat_last_update'=>now()
                         ]);                   
                
            }
        
        endforeach; 
        
            
    }
    
    public static function get($method,$channel,$group='')
    {    
        
        if($group) $group = '&group='.$group;
        
        $channelId = str_replace('https://t.me/','',$channel);
      
        $curl = curl_init('https://api.tgstat.ru/channels/'.$method.'?token='. env('API_TGSTAT_TOKEN') .'&channelId=@'.$channelId.$group);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $result = curl_exec($curl);
        
        if (curl_errno($curl)){
            Log::error($channel.' Couldn\'t send request: ' . curl_error($curl));
            return false;
        }
            
        curl_close($curl);    
        $data = json_decode($result);
        
        if($data->status=='error'):
            Log::error($channel.' ' . $data->error);
            return false;
        else:
            return $data->response;
        endif;
      
    } 
    
    
    
    
}
