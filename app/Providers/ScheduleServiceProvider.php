<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class ScheduleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->callAfterResolving(Schedule::class, function (Schedule $schedule) {
            $schedule->command('backup:google-drive')
                ->everyThirtyMinutes()
                ->appendOutputTo(storage_path('logs/backup.log'));
        });
    }
}
