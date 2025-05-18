<?php

namespace App\Console;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\ImportWilayah;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\PerbaruiIndexHarga;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        ImportWilayah::class,
        PerbaruiIndexHarga::class,
    ];

    protected function schedule(Schedule $schedule)
    {
         $schedule->command('index-harga:perbarui')
        ->dailyAt('05:00') // jam 5 pagi server time
        ->timezone('Asia/Makassar'); // WITA (GMT+8)
        // $schedule->command('index-harga:perbarui')->everyMinute();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
