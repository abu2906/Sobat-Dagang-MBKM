<?php

namespace App\Console;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\ImportWilayah;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\CopyYesterdayPrice;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        ImportWilayah::class,
        CopyYesterdayPrice::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Menjadwalkan command untuk jalan setiap pagi jam 00:00
        $schedule->command('copy:yesterday-price')->dailyAt('00:00');

        $schedule->call(function () {
            app(\App\Http\Controllers\DirectoryBookController::class)->periksaKadaluarsa();
        })->dailyAt('06:00');
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
