<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $sellers = Seller::all();

            foreach ($sellers as $seller) {
                $salesToday = $seller->sales()->whereDate('created_at', today())->get();
                $totalSales = $salesToday->sum('value');
                $totalCommission = $salesToday->sum('commission');

                Mail::to($seller->email)->send(new SalesSummary($totalSales, $totalCommission));
            }
        })->daily();

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
