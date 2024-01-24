<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

use Auth;
use DB;

class UserController extends Controller
{


    public static function getNewMessageCount()
    {
        
        $user = Auth::user();
        
        return DB::table('users_report')->where(['user_id'=>$user->id,'status'=>1])->count();

       
    } 




    public static function getReport()
    {
        
        Paginator::defaultView('/inc/paginator');
        
        $user = Auth::user();
        
        DB::table('users_report')->where('user_id', $user->id)->update(['status'=>0]);
        
        $report = DB::table('users_report')->where('user_id',$user->id)->orderBy('id', 'DESC')->paginate(10);
       
        return view('user.report.index',['report'=>$report]);
        
    } 

    
    
    public static function addReport($user,$message)
    {
        DB::table('users_report')->insert(['user_id'=>$user->id,
                                           'message'=>$message,
                                           'created_at'=>now(),
                                           'updated_at'=>now()
                                          ]);
    } 
    
}
