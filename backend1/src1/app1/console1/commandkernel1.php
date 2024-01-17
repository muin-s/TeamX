<?php

namespace App\Console1;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class CommandKernel1 extends ConsoleKernel
{
    /**
     * Artisan commands registered by the application.
     *
     * @var array
     */
    protected $commands = [
        // Add your custom commands here
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Uncomment and customize the following line to schedule your commands
        // $schedule->command('your-custom-command')->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        // Load commands from the 'Commands' directory
        $this->load(__DIR__.'/Commands');

        // Load additional commands if needed

        // Include any routes specific to console commands
        require base_path('routes/console.php');
    }
}
