<?php

namespace App\Console\Commands;

use App\Services\ReminderService;
use Illuminate\Console\Command;

class SendPaymentReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:send {type?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send payment reminders to tenants (advance, due_date, overdue)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reminderService = new ReminderService();
        $type = $this->argument('type') ?? 'advance';

        $this->info("Starting payment reminder service ({$type} reminders)...");

        try {
            switch ($type) {
                case 'advance':
                    $count = $reminderService->sendPendingReminders();
                    $this->info("✓ Sent {$count} advance payment reminders");
                    break;

                case 'overdue':
                    $count = $reminderService->sendOverdueReminders();
                    $this->info("✓ Sent {$count} overdue payment reminders");
                    break;

                case 'all':
                    $advanceCount = $reminderService->sendPendingReminders();
                    $overdueCount = $reminderService->sendOverdueReminders();
                    $this->info("✓ Sent {$advanceCount} advance reminders");
                    $this->info("✓ Sent {$overdueCount} overdue reminders");
                    break;

                default:
                    $this->error("Invalid reminder type. Use: advance, overdue, or all");
                    return Command::FAILURE;
            }

            // Show statistics
            $stats = $reminderService->getReminderStats();
            $this->line("\n📊 Reminder Statistics:");
            $this->line("  Total Reminders: {$stats['total_reminders']}");
            $this->line("  Pending: {$stats['pending_reminders']}");
            $this->line("  Sent: {$stats['sent_reminders']}");
            $this->line("  Failed: {$stats['failed_reminders']}");
            $this->line("  Acknowledged: {$stats['acknowledged_reminders']}");
            $this->line("  Overdue: {$stats['overdue_reminders']}");

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
