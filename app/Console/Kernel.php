<?php

namespace App\Console;

use App\Jobs\UpdateStreams;
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

    protected function commands(): void
    {
        require base_path('routes/console.php');
    }

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->job(new UpdateStreams)->everyMinute();
        // $schedule->command('cache:prune-stale-tags')->hourly();
    }
}
