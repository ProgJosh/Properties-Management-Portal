<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Models\PaymentReminder;
use Carbon\Carbon;

class SetupExistingBookingReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:setup-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup payment reminders for existing accepted bookings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Setting up payment reminders for existing bookings...');
        
        $bookings = Booking::where('status', 'accepted')
            ->whereNull('monthly_rent')
            ->with(['property', 'leaseAgreement'])
            ->get();
        
        if ($bookings->isEmpty()) {
            $this->info('No bookings need setup.');
            return Command::SUCCESS;
        }
        
        $this->info("Found {$bookings->count()} bookings to setup");
        
        foreach ($bookings as $booking) {
            $this->processBooking($booking);
        }
        
        $this->info('✓ Payment reminders setup complete!');
        return Command::SUCCESS;
    }
    
    private function processBooking($booking)
    {
        $leaseAgreement = $booking->leaseAgreement;
        
        if ($leaseAgreement) {
            // Use lease agreement data
            $booking->monthly_rent = $leaseAgreement->monthly_rent;
            $booking->rent_due_date = $leaseAgreement->start_date;
            $booking->next_payment_date = $leaseAgreement->start_date;
            $booking->save();
            
            $this->line("  Booking #{$booking->id}: Using lease agreement");
            
            // Create reminders for each month
            $startDate = Carbon::parse($leaseAgreement->start_date);
            $endDate = Carbon::parse($leaseAgreement->end_date);
            $currentDate = $startDate->copy();
            $count = 0;
            
            while ($currentDate->lte($endDate)) {
                PaymentReminder::create([
                    'booking_id' => $booking->id,
                    'user_id' => $booking->user_id,
                    'property_id' => $booking->property_id,
                    'due_date' => $currentDate->copy(),
                    'amount' => $booking->monthly_rent,
                    'status' => 'pending',
                    'reminder_type' => 'advance',
                    'days_before_due' => 5,
                ]);
                
                $currentDate->addMonth();
                $count++;
            }
            
            $this->line("    Created {$count} monthly reminders");
        } else {
            // Use property price
            $booking->monthly_rent = $booking->property->price;
            $booking->rent_due_date = $booking->checkin;
            $booking->next_payment_date = $booking->checkin;
            $booking->save();
            
            $this->line("  Booking #{$booking->id}: Using property price");
            
            PaymentReminder::create([
                'booking_id' => $booking->id,
                'user_id' => $booking->user_id,
                'property_id' => $booking->property_id,
                'due_date' => $booking->rent_due_date,
                'amount' => $booking->monthly_rent,
                'status' => 'pending',
                'reminder_type' => 'advance',
                'days_before_due' => 5,
            ]);
            
            $this->line("    Created 1 reminder");
        }
    }
}
