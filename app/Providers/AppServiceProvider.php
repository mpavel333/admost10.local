<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//use Illuminate\Support\Facades\View;
use App\Models\Orders;

use App\Http\Controllers\User\UserController;

use App\Http\Controllers\PagesController;

use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        
        
        //print_r($request); die;
        
        //echo $request->getRequestUri();
        
        view()->composer('*', function($view){
                
                if( Auth::user()){
                
                    $view->with('in_orders', Orders::getUserInOrdersCount());
                    $view->with('out_orders', Orders::getUserOutOrdersCount());
                    
                    $view->with('report_new_messages', UserController::getNewMessageCount());
                    

                    $request = Request();
                    $uri = $request->getRequestUri();
                    
                        //если главная ставим index
                        if(in_array($uri,['/ru','/en','/ua','/'])){
                            $alias = 'index';
                        }else{
                        //убираем язык из url
                            $alias = str_replace(['/ua/','/ru/','/en/'],'',$uri);
                        }
                        if($alias[0]=='/') $alias = substr($alias, 1);
                    
                    $PageMetaData = PagesController::getPageMetaData($alias);
                    if($PageMetaData) $view->with('Page', $PageMetaData);
                    
                }
            
                       
        });        
        
        
        
        
        
        
    }
}
