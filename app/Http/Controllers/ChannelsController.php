<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;

use Illuminate\Pagination\Paginator;

use Auth;
use App\Models\Channels;
use DB;



class ChannelsController extends Controller
{

    public function getFavData($status=0)
    {
        $user = Auth::user();

        $channels = DB::table('channels_favorite')
                    ->where('channels_favorite.user_id', $user->id)
                    ->where('channels_favorite.status', $status)
                    
                          ->join('channels', function (JoinClause $join){
                                $join->on('channels_favorite.channel_id', '=', 'channels.id');
                          })   
                          
                     ->leftjoin('categories', 'categories.id', '=', 'channels.category_id')
                     ->select('channels.*','channels_favorite.status as favorite_status','categories.name as category_name')
                       
                    //->select('channels.*')
                    //->get();  
                    
                    ->paginate(10);

        foreach($channels as $key => $channel):
            $channels[$key]->tariff = DB::table('tariffs')->where('channel_id', $channel->id)->orderBy('price', 'ASC')->get(); 
            //$channels[$key]->favorite_status = DB::table('channels_favorite')->where('channel_id', $channel->id)->where('user_id', $user->id)->value('status');                               
        endforeach;
                    
        return $channels;     
    }       


    public function favorite()
    {
        Paginator::defaultView('/inc/paginator');
        return view('channels.favorite',['channels'=>self::getFavData(1)]);      
    }       

    public function blacklist()
    {
        Paginator::defaultView('/inc/paginator');
        return view('channels.blacklist',['channels'=>self::getFavData(2)]);      
    } 

    
    public function add_favorite($id,$status=0)
    {
        $user = Auth::user();
        $check = DB::table('channels_favorite')->where('channel_id', $id)->where('user_id', $user->id)->first();
        if($check):
            //DB::table('channels_favorite')->where('id', $check->id)->delete(); 
            if($check->status == $status) $status = 0;
            DB::table('channels_favorite')->where('id', $check->id)->update([
                'status'=>$status,
                "updated_at"=>now()
            ]);            
        else:
            DB::table('channels_favorite')->insert([
                'channel_id'=>$id,
                'user_id'=>$user->id,
                'status'=>$status,
                "created_at"=>now(),
                "updated_at"=>now()
            ]);        
        endif; 
        
        return response()->json(['id'=>$id,'status'=>$status]);
           
    } 
    
    public function channels(Request $request)
    {
        Paginator::defaultView('/inc/paginator');
        $user = Auth::user();
        
        session()->flashInput($request->input());
        
        $form = $request->all();
        //print_r($form);

        $name = '';
        if(!empty($form['name'])) $name = $form['name']; 

        $category = [];
        if(!empty($form['category'])) $category = explode(',',$form['category']);

        $formats = [];
        if(!empty($form['format'])){
            $formats = DB::table('tariffs')->whereIn('id',explode(',',$form['format']))->pluck('format');
        }
        
        $er = [];
        if(!empty($form['er'])) $er = explode(';',$form['er']);
        
        $subscribers = [];
        if(!empty($form['subscribers'])) $subscribers = explode(';',$form['subscribers']);

        $cpv = [];
        if(!empty($form['cpv'])) $cpv = explode(';',$form['cpv']);

        
        $categories = DB::table('categories')->where('published', 1)->get();
        
        $sort = [];
        if(!empty($form['sort'])){
             $sort[] = $form['sort'];        
             foreach($categories as $item): 
                if($item->id!=$form['sort']) $sort[]=$item->id; 
             endforeach;            
        }
        
        $blacklist=[];
        if(!empty($user)) $blacklist = DB::table('channels_favorite')->where('user_id', $user->id)->where('status', 2)->pluck('channel_id');        
        
        
        $where = [];
        $where = array_merge($where,['tg_status'=>1]);
        $where = array_merge($where,['status'=>1]);
        
                    
                    //print_r($blacklist);
        
        $channels = DB::table('channels')->where($where)

                        ->where(function($query) use($name) {
                            if($name) $query->where('channels.name','LIKE','%'.$name.'%');
                        })

                        ->when(!empty($category),function($query) use ($category){
                                $query->whereIn('category_id',$category);
                        })                                        
                        
                        ->when(!empty($formats),function($query) use ($formats){
                        
                            $query->join('tariffs', function (JoinClause $join) use ($formats){
                                $join->on('channels.id', '=', 'tariffs.channel_id')
                                     ->whereIn('tariffs.format',$formats);
                            });
                        })      
                                                
                        ->when(!empty($er),function($query) use ($er){
                                $query->whereBetween('er', $er);
                        })                                        
                        
                        ->when(!empty($subscribers),function($query) use ($subscribers){
                                $query->whereBetween('subscribers', $subscribers);
                        })                                        
                        
                        ->when(!empty($cpv),function($query) use ($cpv){
                                $query->whereBetween('cpv', $cpv);
                        })                                        
                

                        ->when(!empty($user),function($query) use ($blacklist){
                                $query->whereNotIn('channels.id', $blacklist);
                        })                                        
                 
                 
                 
                 ->leftjoin('categories', 'categories.id', '=', 'channels.category_id')
                 
                 
                 //->leftjoin('channels_favorite', ['channels_favorite.channel_id', '=', 'channels.id')

                  //  ->leftjoin('channels_favorite', function ($leftjoin)  use ($user){
                  //      $leftjoin->on('channels_favorite.channel_id', '=', 'channels.id')->on('channels_favorite.user_id', '=', $user->id);
                        
                  //  })
                    
                  //  ->whereNull('channels.id');


                 ->select('channels.*','categories.name as category_name')
        
        ->groupBy('channels.id')
        
            ->when(!empty($sort),function($query) use ($sort){
                $query->orderByRaw("FIELD(category_id, ".implode(',',$sort).")");
            })
                                             
        //->get();
        ->paginate(10);                    

        foreach($channels as $key => $channel):
            $channels[$key]->tariff = DB::table('tariffs')->where('channel_id', $channel->id)->orderBy('price', 'ASC')->get(); 
            
            if(!empty($user)):
            $channels[$key]->favorite_status = DB::table('channels_favorite')->where('channel_id', $channel->id)->where('user_id', $user->id)->value('status');                               
            endif;
        endforeach;

        //$categories = DB::table('categories')->where('published', 1)->get(); 
        $tariffs = DB::table('tariffs')->get()->unique('format'); 
        

        
        return view('channels.channels',['channels'=>$channels,'categories'=>$categories,'tariffs'=>$tariffs,'form'=>$form]);      
    } 
    
    public function channel($id)
    {

        $channel = DB::table('channels')->where('id', $id)->where('tg_status', 1)->where('status', 1)->first();        
        $tariffs = DB::table('tariffs')->where('channel_id', $id)->get();         
        
        return view('channels.channel',['channel'=>$channel,'tariffs'=>$tariffs]);      
    }  
    
    
    
}
