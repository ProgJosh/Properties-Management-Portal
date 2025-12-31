# Payment Reminder System - Complete Implementation Guide

## Overview

The Payment Reminder System is an automated notification system that sends monthly rent payment reminders to tenants through multiple channels (email, SMS, and in-app notifications) to reduce late payments and improve cash flow management.

## System Architecture

### Components

1. **Database Layer**
   - `payment_reminders` table: Stores reminder records
   - `notification_logs` table: Tracks all notification attempts

2. **Models**
   - `PaymentReminder`: Main model with relationships and scopes
   - `NotificationLog`: Notification tracking model

3. **Service Layer**
   - `ReminderService`: Business logic for reminders and notifications

4. **Controller**
   - `ReminderController`: Handles user and admin endpoints

5. **Commands**
   - `SendPaymentReminders`: Console command for scheduled reminders

6. **Scheduler**
   - `app/Console/Kernel.php`: Cron job scheduling

## Features

### 1. Advance Reminders (5 Days Before Due Date)
- Automatically created when booking is made
- Sent via email, SMS, and in-app notification
- Includes payment amount, due date, and property details
- Configurable days before due date

### 2. Overdue Reminders
- Created for payments past due date
- Escalated messaging emphasizing urgency
- Daily reminders until payment is made
- Warning about potential legal action

### 3. Multi-Channel Notifications
- **Email**: Full HTML template with all payment details
- **SMS**: Concise message with due date and amount
- **In-App**: Dashboard notification for quick visibility

### 4. Notification Tracking
- Every notification attempt logged
- Success/failure status tracked
- Error messages stored for debugging
- User acknowledgment recorded

### 5. Admin Dashboard
- Statistics on total, pending, and overdue reminders
- Recent reminders list with quick actions
- Ability to resend or delete reminders
- Notification channel status

### 6. Tenant Dashboard
- View all reminders
- Filter by pending/overdue
- Acknowledge reminders
- View notification history

## Database Schema

### payment_reminders Table
```sql
CREATE TABLE payment_reminders (
    id BIGINT PRIMARY KEY,
    booking_id BIGINT,
    user_id BIGINT,
    property_id BIGINT,
    due_date DATE,
    amount DECIMAL(10, 2),
    status ENUM('pending', 'sent', 'failed', 'acknowledged'),
    reminder_type ENUM('advance', 'due_date', 'overdue'),
    days_before_due INT DEFAULT 5,
    email_sent BOOLEAN DEFAULT FALSE,
    email_sent_at TIMESTAMP NULL,
    email_error TEXT NULL,
    sms_sent BOOLEAN DEFAULT FALSE,
    sms_sent_at TIMESTAMP NULL,
    sms_error TEXT NULL,
    in_app_sent BOOLEAN DEFAULT FALSE,
    in_app_sent_at TIMESTAMP NULL,
    in_app_error TEXT NULL,
    acknowledged_at TIMESTAMP NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP
);
```

### notification_logs Table
```sql
CREATE TABLE notification_logs (
    id BIGINT PRIMARY KEY,
    payment_reminder_id BIGINT,
    channel ENUM('email', 'sms', 'in_app'),
    status ENUM('sent', 'failed'),
    recipient VARCHAR(255),
    message LONGTEXT,
    error_message TEXT NULL,
    sent_at TIMESTAMP NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

## Installation & Setup

### 1. Run Migration
```bash
php artisan migrate
```

This creates the `payment_reminders` and `notification_logs` tables.

### 2. Verify Models
Models are pre-created at:
- `app/Models/PaymentReminder.php`
- `app/Models/NotificationLog.php`

### 3. Verify Service
Service is created at: `app/Services/ReminderService.php`

### 4. Verify Controller
Controller is created at: `app/Http/Controllers/ReminderController.php`

### 5. Verify Command
Command is created at: `app/Console/Commands/SendPaymentReminders.php`

### 6. Verify Scheduler
Scheduler is configured in: `app/Console/Kernel.php`

### 7. Add Routes
Routes are added to: `routes/web.php`

### 8. Create Email Template
Email template is at: `resources/views/emails/payment-reminder.blade.php`

## Configuration

### Email Configuration
In `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS=noreply@propertymanagement.com
MAIL_FROM_NAME="Property Management Portal"
```

### SMS Configuration (Twilio)
In `.env`:
```env
TWILIO_AUTH_SID=your_sid
TWILIO_AUTH_TOKEN=your_token
TWILIO_PHONE_NUMBER=+1234567890
```

Then uncomment Twilio integration in `ReminderService::sendSmsNotification()`

### Scheduling
The system runs two scheduled jobs:

**Advance Reminders:** 08:00 AM daily
```bash
php artisan reminders:send advance
```

**Overdue Reminders:** 02:00 PM daily
```bash
php artisan reminders:send overdue
```

For local development, ensure cron is running:
```bash
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

Or use Laravel Tinker to test:
```bash
php artisan tinker
>>> \Illuminate\Support\Facades\Schedule::call(function() { 
    \App\Services\ReminderService::sendPendingReminders(); 
})->everyMinute();
```

## Usage Examples

### Creating a Reminder Manually
```php
$booking = Booking::find(1);
$reminderService = new ReminderService();
$reminder = $reminderService->createReminder($booking, daysBeforeDue: 5);
```

### Sending All Pending Reminders
```bash
php artisan reminders:send advance
```

### Sending Overdue Reminders
```bash
php artisan reminders:send overdue
```

### Sending All Reminders (Advance + Overdue)
```bash
php artisan reminders:send all
```

### Getting Statistics
```php
$service = new ReminderService();
$stats = $service->getReminderStats();
```

### Acknowledging a Reminder
```php
$reminder = PaymentReminder::find(1);
$reminder->acknowledge();
```

### Viewing Pending Reminders
```php
$pending = PaymentReminder::pending()->get();
```

### Viewing Overdue Reminders
```php
$overdue = PaymentReminder::overdue()->get();
```

## API Endpoints

### Admin Endpoints
```
GET  /admin/reminders/dashboard           - Admin dashboard
GET  /admin/reminders                      - List all reminders with filters
POST /admin/reminders/{reminder}/resend    - Resend notification
DELETE /admin/reminders/{reminder}         - Delete reminder
```

### Tenant Endpoints
```
GET  /reminders                            - List user's reminders
GET  /reminders/pending                    - List pending reminders
GET  /reminders/overdue                    - List overdue reminders
GET  /reminders/{reminder}                 - View reminder details
POST /reminders/{reminder}/acknowledge     - Acknowledge reminder
GET  /api/reminders/statistics             - Get reminder statistics
```

## Views

### Admin Views
- **Dashboard:** `resources/views/admin/reminders/dashboard.blade.php`
- **List:** `resources/views/admin/reminders/index.blade.php` (not created yet, will create on demand)

### Tenant Views
- **Index:** `resources/views/reminders/index.blade.php` (not created yet)
- **Pending:** `resources/views/reminders/pending.blade.php` (not created yet)
- **Overdue:** `resources/views/reminders/overdue.blade.php` (not created yet)
- **Show:** `resources/views/reminders/show.blade.php` (not created yet)

### Email Templates
- **Payment Reminder:** `resources/views/emails/payment-reminder.blade.php`

## Troubleshooting

### Reminders Not Sending

1. **Check schedule is running:**
   ```bash
   php artisan schedule:work
   ```

2. **Check email configuration:**
   ```bash
   php artisan mail:send
   ```

3. **Check logs:**
   ```bash
   tail -f storage/logs/laravel.log
   ```

4. **Test manually:**
   ```bash
   php artisan reminders:send advance
   ```

### Email Not Deliverable

1. Verify SMTP credentials in `.env`
2. Check `from` address is valid
3. Review email logs in `storage/logs/`
4. Check notification_logs table for errors

### SMS Not Sending

1. Verify Twilio credentials
2. Ensure SMS integration is uncommented in `ReminderService`
3. Check user phone number is in correct format
4. Verify phone number has SMS capability

## Scopes and Filters

### PaymentReminder Scopes
```php
// Pending reminders
PaymentReminder::pending()->get();

// Due in 5 days
PaymentReminder::dueInDays(5)->get();

// Overdue
PaymentReminder::overdue()->get();

// Advance reminders
PaymentReminder::where('reminder_type', 'advance')->get();

// By date
PaymentReminder::forDate('2024-12-25')->get();
```

### NotificationLog Scopes
```php
// Failed notifications
NotificationLog::failed()->get();

// Sent notifications
NotificationLog::sent()->get();

// By channel
NotificationLog::byChannel('email')->get();
```

## Performance Considerations

1. **Cron Job Optimization**
   - Set to run during off-peak hours
   - Use `withoutOverlapping()` to prevent duplicate runs
   - Monitor execution time

2. **Database Indexes**
   - Created on foreign keys
   - Created on status fields
   - Consider adding index on due_date

3. **Email Queue**
   - Consider using Laravel's queue system for bulk emails
   - Add to queue in ReminderService:
   ```php
   Mail::queue('emails.payment-reminder', [...], function($m) {
       // ...
   });
   ```

## Security Considerations

1. **Data Privacy**
   - Use soft deletes to preserve records
   - Don't expose payment details in logs
   - Sanitize error messages

2. **Authorization**
   - Use policies to prevent unauthorized access
   - Verify user owns reminder before showing details
   - Admin can only view reminders for their properties

3. **Validation**
   - Validate email addresses
   - Validate phone numbers
   - Validate due dates are in future

## Future Enhancements

1. **Customizable Reminders**
   - Admin can adjust reminder dates
   - Enable/disable specific channels
   - Custom email templates per property

2. **Advanced Scheduling**
   - Multiple reminders at different intervals
   - Weekend/holiday handling
   - Timezone support

3. **Analytics**
   - Payment success rate after reminder
   - Most effective notification channel
   - User engagement metrics

4. **Integrations**
   - WhatsApp notifications
   - Payment gateway integration
   - CRM system sync

## Support & Monitoring

### Key Metrics to Monitor
- Reminder send success rate
- Email delivery rate
- SMS delivery rate
- User acknowledgment rate
- Time to payment after reminder

### Logs Location
```
storage/logs/laravel.log
```

### Database Tables to Monitor
- `payment_reminders` (size, status distribution)
- `notification_logs` (delivery rates)

## Conclusion

The Payment Reminder System provides a robust, scalable solution for automated payment reminders. It's designed to improve cash flow, reduce late payments, and enhance user experience with multi-channel notifications.

For any issues or enhancements, refer to the code comments in the respective files.
