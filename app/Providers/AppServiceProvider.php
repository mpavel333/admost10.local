<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//use Illuminate\Support\Facades\View;
use App\Models\Orders;

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
        
        view()->composer('*', function($view){
                
                if( Auth::user()){
                
                    $view->with('in_orders', Orders::getUserInOrdersCount());
                    $view->with('out_orders', Orders::getUserOutOrdersCount());
                
                }
            
                       
        });        
        
        
        
        
        
        
    }
}
