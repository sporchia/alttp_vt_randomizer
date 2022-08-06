<?php

namespace App\Console;

use ALttP\Jobs\UpdateStreams;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\JsonToCsv::class,
        Commands\MakeTranslation::class,
        Commands\Randomize::class,
        Commands\Sprites::class,
        Commands\UpdateBuildRecord::class,
    ];

    protected function commands()
    {
        require base_path('routes/console.php');
    }

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new UpdateStreams)->everyMinute();
    }
}
