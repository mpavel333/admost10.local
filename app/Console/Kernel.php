<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Http\Controllers\TelegramController;
use App\Http\Controllers\APItgstatController;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
     
        
        // $schedule->command('inspire')->hourly();
        
        $schedule->call(function () {
            //TelegramController::autoposting();
            
            TelegramController::postingPublications();
            TelegramController::postingOrders();            
            
            
            TelegramController::deletePublications();
            
            
            //TelegramController::autopostingdelete();
            APItgstatController::getStat();
            
        })->everyMinute();      
        
        
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
