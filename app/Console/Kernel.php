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
        // Send advance payment reminders daily at 8 AM
        $schedule->command('reminders:send advance')
            ->dailyAt('08:00')
            ->withoutOverlapping()
            ->onSuccess(function () {
                \Illuminate\Support\Facades\Log::info('Advance payment reminders sent successfully');
            })
            ->onFailure(function () {
                \Illuminate\Support\Facades\Log::error('Failed to send advance payment reminders');
            });

        // Send overdue reminders daily at 2 PM
        $schedule->command('reminders:send overdue')
            ->dailyAt('14:00')
            ->withoutOverlapping()
            ->onSuccess(function () {
                \Illuminate\Support\Facades\Log::info('Overdue payment reminders sent successfully');
            })
            ->onFailure(function () {
                \Illuminate\Support\Facades\Log::error('Failed to send overdue payment reminders');
            });
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
