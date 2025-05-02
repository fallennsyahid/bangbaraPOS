<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers\StoreController;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        // Call function untuk buka toko
        Schedule::call(function () {
            app(StoreController::class)->checkAutoUpdateStatus();
        })->dailyAt('10:00');

        // Call function untuk tutup toko
        Schedule::call(function () {
            app(StoreController::class)->checkAutoUpdateStatus();
        })->dailyAt('23:00');
    }
}
