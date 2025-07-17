<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\BackupDatabase; // <-- Import your custom command

class Kernel extends ConsoleKernel
{
    /**
     * Register the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Run the backup command daily at 2:00 AM
        $schedule->command('backup:mysql')->dailyAt('02:00');
        
        // Or for testing, run every minute
        // $schedule->command('backup:mysql')->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        // Alternatively, register manually if needed
        // $this->commands([
        //     BackupDatabase::class,
        // ]);
        
        require base_path('routes/console.php');
    }
}
