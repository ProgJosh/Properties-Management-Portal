# Payment Reminders - Quick Start Guide

## 5-Minute Setup

### Step 1: Run Migration
```bash
php artisan migrate
```

Creates `payment_reminders` and `notification_logs` tables.

### Step 2: Configure Email (Optional)
Add to `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_FROM_ADDRESS=noreply@propertymanagement.com
```

### Step 3: Start Scheduler (For Local Development)
In separate terminal:
```bash
php artisan schedule:work
```

Or add to your crontab:
```bash
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

### Step 4: Done! ✓

System is now ready to send reminders.

---

## Manual Testing

### Send Advance Reminders (5 days before due)
```bash
php artisan reminders:send advance
```

### Send Overdue Reminders (past due date)
```bash
php artisan reminders:send overdue
```

### Send All Reminders
```bash
php artisan reminders:send all
```

---

## Accessing the Dashboards

### Admin Dashboard
```
http://localhost/admin/reminders/dashboard
```

Shows:
- Total, pending, and overdue reminders
- Notification channels status
- Recent reminders with actions

### Admin Reminders List
```
http://localhost/admin/reminders
```

Features:
- Filter by status, type, or search
- Resend notifications
- Delete reminders

### Tenant Reminders
```
http://localhost/reminders
```

Features:
- View all personal reminders
- Filter pending/overdue
- Acknowledge reminders
- View notification history

---

## Common Tasks

### Create Reminder for a Booking
```php
$booking = Booking::find(1);
$reminderService = new \App\Services\ReminderService();
$reminder = $reminderService->createReminder($booking);
```

### View Statistics
```bash
php artisan reminders:send advance
```

Output will show:
```
✓ Sent 5 advance payment reminders
📊 Reminder Statistics:
  Total Reminders: 25
  Pending: 5
  Sent: 20
  Failed: 0
  Acknowledged: 15
  Overdue: 0
```

### Check Failed Reminders
```php
$failed = \App\Models\PaymentReminder::where('status', 'failed')->get();
```

### View Notification Details
```php
$reminder = \App\Models\PaymentReminder::find(1);
$logs = $reminder->notificationLogs()->get();
```

---

## Email Template

The system uses a professional HTML email template with:
- Property details
- Due date
- Amount owed
- Payment instructions
- Support contact info

Located at: `resources/views/emails/payment-reminder.blade.php`

Customize by editing the Blade template.

---

## SMS Configuration

To enable SMS via Twilio:

1. Sign up at [twilio.com](https://www.twilio.com)
2. Add to `.env`:
   ```env
   TWILIO_AUTH_SID=your_sid
   TWILIO_AUTH_TOKEN=your_token
   TWILIO_PHONE_NUMBER=+1234567890
   ```

3. Uncomment SMS code in `app/Services/ReminderService.php` (~line 100)

---

## Scheduled Jobs

The system automatically runs two jobs:

| Time | Job | Purpose |
|------|-----|---------|
| 08:00 AM | `reminders:send advance` | Send 5-day before notifications |
| 02:00 PM | `reminders:send overdue` | Send overdue notifications |

You can modify schedules in `app/Console/Kernel.php`

---

## Troubleshooting

### Check if scheduler is running:
```bash
php artisan schedule:list
```

### View logs:
```bash
tail -f storage/logs/laravel.log
```

### Check email configuration:
```php
// In tinker
Mail::raw('Test', function($m) {
    $m->to('test@example.com');
});
```

### Verify database:
```bash
php artisan tinker
>>> \App\Models\PaymentReminder::count()
```

---

## File Structure

```
app/
├── Console/
│   ├── Commands/
│   │   └── SendPaymentReminders.php
│   └── Kernel.php
├── Http/
│   └── Controllers/
│       └── ReminderController.php
├── Models/
│   ├── PaymentReminder.php
│   └── NotificationLog.php
└── Services/
    └── ReminderService.php

resources/views/
├── admin/reminders/
│   └── dashboard.blade.php
├── reminders/
│   ├── index.blade.php
│   ├── pending.blade.php
│   ├── overdue.blade.php
│   └── show.blade.php
└── emails/
    └── payment-reminder.blade.php

database/migrations/
└── 2024_12_27_000000_create_payment_reminders_table.php

routes/
└── web.php (with reminder routes)
```

---

## Key Features Summary

✅ Automatic advance reminders (5 days before)  
✅ Overdue payment tracking  
✅ Multi-channel notifications (Email, SMS, In-App)  
✅ Notification logging & tracking  
✅ Admin dashboard with statistics  
✅ Tenant reminder management  
✅ Customizable templates  
✅ Cron job scheduling  
✅ Error handling & recovery  
✅ User acknowledgment tracking  

---

## Next Steps

1. **Customize templates** - Edit email template to match branding
2. **Configure SMS** - Add Twilio credentials if using SMS
3. **Set schedules** - Adjust reminder times in `Kernel.php`
4. **Test thoroughly** - Run `php artisan reminders:send` manually first
5. **Enable scheduler** - Set up proper cron job on production
6. **Monitor** - Check logs and stats regularly

---

For detailed documentation, see `PAYMENT_REMINDERS_GUIDE.md`
