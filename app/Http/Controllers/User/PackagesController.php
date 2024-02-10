<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\Packages;
use DB;
use Auth;

use App\Http\Controllers\User\BalanceController;
use App\Http\Controllers\User\UserController;


class PackagesController extends Controller
{
    
  
    public function package($id){
        
        $Package = Packages::find($id);
        if(!$Package) abort(404);
               
        return view('package', ['Package' => $Package]);
        
    }

    public static function addPackageUser($User,$Package)
    {
        //date_default_timezone_set('Europe/Kiev');
        
        DB::table('packages_users')->insert([
            'user_id'=>$User->id,
            'package'=>json_encode($Package,JSON_UNESCAPED_UNICODE),
            'date_start'=>Carbon::now(),
            'date_end'=>Carbon::now()->addMonths(1)->addDays($Package->free_days)
        ]);
        
    }
    
     public function buy($id){
        
        $User = Auth::user();
        $Package = Packages::find($id);
        if(!$Package) abort(404);
        
        if(BalanceController::checkBalance($User,$Package->price)){
        
            
            self::addPackageUser($User,$Package);
            
            //Списание оплаты
            BalanceController::MinBalance($User,$Package->price);
            
            UserController::addReport($User,'Вы купили пакет ID-'.$Package->id.'. Списано -'.$Package->price.'грн.');        
            
            $with=['success'=>'Вы купили пакет ID-'.$Package->id.'. Списано -'.$Package->price.'грн.'];
            
        }else{
            UserController::addReport($User,'Недостаточно средств для покупки пакета.');
            
            $with=['error'=>'Недостаточно средств для покупки пакета.'];
        } 
        
        
        return redirect()->route('package',$id)->with($with);       
        
    }
    
    
    
}
