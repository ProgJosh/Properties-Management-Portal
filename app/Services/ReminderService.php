<?php

namespace App\Services;

use App\Models\PaymentReminder;
use App\Models\Booking;
use App\Models\NotificationLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ReminderService
{
    /**
     * Create a payment reminder for a booking
     */
    public function createReminder(Booking $booking, $daysBeforeDue = 5)
    {
        try {
            // Get the due date from booking (assuming it has a rent_due_date or similar)
            $dueDate = $booking->rent_due_date ?? now()->addMonth();

            $reminder = PaymentReminder::create([
                'booking_id' => $booking->id,
                'user_id' => $booking->user_id,
                'property_id' => $booking->property_id,
                'due_date' => $dueDate,
                'amount' => $booking->rent_amount ?? $booking->amount,
                'status' => 'pending',
                'reminder_type' => 'advance',
                'days_before_due' => $daysBeforeDue,
            ]);

            Log::info("Payment reminder created for booking {$booking->id}");
            return $reminder;
        } catch (\Exception $e) {
            Log::error("Error creating reminder: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Send reminders for upcoming payments
     * Should be triggered by cron job
     */
    public function sendPendingReminders()
    {
        try {
            // Get reminders due in 5 days
            $reminders = PaymentReminder::pending()
                ->dueInDays(5)
                ->get();

            foreach ($reminders as $reminder) {
                $this->sendReminder($reminder);
            }

            Log::info("Sent " . count($reminders) . " payment reminders");
            return count($reminders);
        } catch (\Exception $e) {
            Log::error("Error sending reminders: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Send all notifications for a reminder
     */
    public function sendReminder(PaymentReminder $reminder)
    {
        // Send email
        $this->sendEmailNotification($reminder);

        // Send SMS
        $this->sendSmsNotification($reminder);

        // Send in-app notification
        $this->sendInAppNotification($reminder);

        // Update reminder status if all sent successfully
        if ($reminder->allNotificationsSent()) {
            $reminder->update(['status' => 'sent']);
        }

        return $reminder;
    }

    /**
     * Send email notification
     */
    public function sendEmailNotification(PaymentReminder $reminder)
    {
        try {
            $user = $reminder->user;
            
            if (!$user->email) {
                throw new \Exception("User email not found");
            }

            $message = $this->buildEmailMessage($reminder);

            // Send email using Laravel's Mail facade
            Mail::send('emails.payment-reminder', [
                'reminder' => $reminder,
                'user' => $user,
                'message' => $message,
            ], function ($m) use ($user) {
                $m->to($user->email)
                  ->subject('Payment Reminder: Rent Due Soon');
            });

            // Log notification
            NotificationLog::create([
                'payment_reminder_id' => $reminder->id,
                'channel' => 'email',
                'status' => 'sent',
                'recipient' => $user->email,
                'message' => $message,
                'sent_at' => now(),
            ]);

            // Update reminder
            $reminder->update([
                'email_sent' => true,
                'email_sent_at' => now(),
            ]);

            Log::info("Email sent to {$user->email} for reminder {$reminder->id}");
        } catch (\Exception $e) {
            $this->logFailedNotification($reminder, 'email', $e->getMessage());
        }
    }

    /**
     * Send SMS notification
     * Integrate with your SMS provider (Twilio, AWS SNS, etc.)
     */
    public function sendSmsNotification(PaymentReminder $reminder)
    {
        try {
            $user = $reminder->user;
            $userDetail = $user->userDetail;

            if (!$userDetail || !$userDetail->phone) {
                throw new \Exception("User phone number not found");
            }

            $message = $this->buildSmsMessage($reminder);

            // TODO: Integrate with SMS provider
            // Example with Twilio:
            // $twilio = new Twilio\Rest\Client(env('TWILIO_AUTH_SID'), env('TWILIO_AUTH_TOKEN'));
            // $twilio->messages->create($userDetail->phone, [
            //     'from' => env('TWILIO_PHONE_NUMBER'),
            //     'body' => $message
            // ]);

            // For now, we'll just log it
            Log::info("SMS would be sent to {$userDetail->phone}: {$message}");

            // Log notification
            NotificationLog::create([
                'payment_reminder_id' => $reminder->id,
                'channel' => 'sms',
                'status' => 'sent',
                'recipient' => $userDetail->phone,
                'message' => $message,
                'sent_at' => now(),
            ]);

            $reminder->update([
                'sms_sent' => true,
                'sms_sent_at' => now(),
            ]);
        } catch (\Exception $e) {
            $this->logFailedNotification($reminder, 'sms', $e->getMessage());
        }
    }

    /**
     * Send in-app notification
     */
    public function sendInAppNotification(PaymentReminder $reminder)
    {
        try {
            // Create in-app notification record
            // You can use Laravel's notification system or create custom in-app notifications
            
            $message = $this->buildInAppMessage($reminder);

            NotificationLog::create([
                'payment_reminder_id' => $reminder->id,
                'channel' => 'in_app',
                'status' => 'sent',
                'recipient' => $reminder->user_id,
                'message' => $message,
                'sent_at' => now(),
            ]);

            $reminder->update([
                'in_app_sent' => true,
                'in_app_sent_at' => now(),
            ]);

            Log::info("In-app notification created for user {$reminder->user_id}");
        } catch (\Exception $e) {
            $this->logFailedNotification($reminder, 'in_app', $e->getMessage());
        }
    }

    /**
     * Build email message
     */
    private function buildEmailMessage(PaymentReminder $reminder)
    {
        $daysUntilDue = $reminder->due_date->diffInDays(now());
        
        return "
            Dear {$reminder->user->name},
            
            This is a friendly reminder that your rent payment of ₱" . number_format($reminder->amount, 2) . " is due on {$reminder->formatted_due_date}.
            
            Days remaining: {$daysUntilDue} days
            Property: {$reminder->property->title}
            
            Please ensure timely payment to avoid any late fees.
            
            Thank you!
        ";
    }

    /**
     * Build SMS message
     */
    private function buildSmsMessage(PaymentReminder $reminder)
    {
        $daysUntilDue = $reminder->due_date->diffInDays(now());
        
        return "Rent Reminder: ₱" . number_format($reminder->amount, 2) . " due on {$reminder->due_date->format('M d')}. ({$daysUntilDue} days left). Reply CONFIRM to acknowledge.";
    }

    /**
     * Build in-app message
     */
    private function buildInAppMessage(PaymentReminder $reminder)
    {
        return "Your rent of ₱" . number_format($reminder->amount, 2) . " for {$reminder->property->title} is due on {$reminder->formatted_due_date}.";
    }

    /**
     * Log failed notification
     */
    private function logFailedNotification(PaymentReminder $reminder, $channel, $error)
    {
        NotificationLog::create([
            'payment_reminder_id' => $reminder->id,
            'channel' => $channel,
            'status' => 'failed',
            'error_message' => $error,
        ]);

        $reminder->update([
            $channel . '_error' => $error,
        ]);

        Log::error("Failed to send {$channel} notification for reminder {$reminder->id}: {$error}");
    }

    /**
     * Send overdue reminders
     */
    public function sendOverdueReminders()
    {
        try {
            // Get overdue bookings
            $overdueBookings = Booking::where('rent_due_date', '<', now()->toDateString())
                ->whereDoesntHave('payments', function ($query) {
                    $query->whereMonth('created_at', now()->month);
                })
                ->get();

            foreach ($overdueBookings as $booking) {
                $reminder = PaymentReminder::where('booking_id', $booking->id)
                    ->where('reminder_type', 'overdue')
                    ->first();

                if (!$reminder) {
                    $reminder = PaymentReminder::create([
                        'booking_id' => $booking->id,
                        'user_id' => $booking->user_id,
                        'property_id' => $booking->property_id,
                        'due_date' => $booking->rent_due_date,
                        'amount' => $booking->rent_amount ?? $booking->amount,
                        'status' => 'pending',
                        'reminder_type' => 'overdue',
                    ]);
                }

                $this->sendReminder($reminder);
            }

            return count($overdueBookings);
        } catch (\Exception $e) {
            Log::error("Error sending overdue reminders: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Get reminder statistics
     */
    public function getReminderStats()
    {
        return [
            'total_reminders' => PaymentReminder::count(),
            'pending_reminders' => PaymentReminder::pending()->count(),
            'sent_reminders' => PaymentReminder::where('status', 'sent')->count(),
            'failed_reminders' => PaymentReminder::where('status', 'failed')->count(),
            'acknowledged_reminders' => PaymentReminder::where('status', 'acknowledged')->count(),
            'overdue_reminders' => PaymentReminder::overdue()->count(),
        ];
    }
}
