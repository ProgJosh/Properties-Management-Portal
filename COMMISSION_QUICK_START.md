# Quick Start: Commission System Integration

## 🎯 Immediate Steps

### 1. Run Migration
```bash
cd c:\xampp\htdocs\Properties-Management-Portal
php artisan migrate
```

### 2. Add Commission Processing to Your Payment Handler

Find your payment processing code (likely in `PaymentController` or similar) and add this:

```php
<?php

namespace App\Http\Controllers;

use App\Services\CommissionService;
use App\Models\Payment;

class YourPaymentController extends Controller
{
    public function handlePaymentSuccess(Payment $payment)
    {
        // ... your existing payment processing ...

        // Add this after payment is marked as successful:
        try {
            $commissionService = new CommissionService();
            $commission = $commissionService->processPaymentCommission($payment);
            \Log::info("Commission created: ₱" . $commission->commission_amount);
        } catch (\Exception $e) {
            \Log::error("Commission error: " . $e->getMessage());
        }

        // ... rest of your code ...
    }
}
```

### 3. Access Commission Dashboard

After migration and payment integration:
- Navigate to: `http://yoursite.local/admin/commission/dashboard`
- You should see the commission dashboard with all statistics

## 📊 What Each View Shows

### Dashboard (`/admin/commission/dashboard`)
- Total commission earned (all time)
- Pending commissions
- This month's commission
- Commission breakdown
- Current month's detailed report
- Download links for reports

### History (`/admin/commission/history`)
- Complete list of all commissions
- Transaction details
- Pagination support

### Monthly Report (`/admin/commission/monthly-report`)
- Filter by month and year
- Detailed breakdown
- Export to PDF

### Yearly Report (`/admin/commission/yearly-report`)
- All 12 months summary
- Aggregated statistics

## 🔧 Testing the System

### Create a Test Commission Manually
```php
// In tinker or artisan command:
$commission = \App\Models\Commission::create([
    'admin_id' => 1,
    'payment_id' => 1,
    'booking_id' => 1,
    'transaction_amount' => 10000,
    'commission_percentage' => 3,
    'commission_amount' => 300,
    'net_amount' => 9700,
    'status' => 'deducted',
    'payment_status' => 'successful',
    'month_year' => now()->format('Y-m'),
]);
```

### Verify in Dashboard
Visit `/admin/commission/dashboard` to see the test commission reflected

## 📝 Commission Workflow

```
1. Tenant makes payment
   ↓
2. Payment marked as successful
   ↓
3. CommissionService.processPaymentCommission() called
   ↓
4. Commission record created in database
   ↓
5. Commission appears in:
   - Dashboard (immediately)
   - Monthly reports
   - History
   - PDF exports
```

## 🚀 Features Ready to Use

✅ Commission Dashboard with all metrics
✅ Commission History with pagination
✅ Monthly Reports with filtering
✅ Yearly Reports with monthly breakdown
✅ PDF Export for reports
✅ API endpoints for integration
✅ Commission calculations automatic (3%)
✅ Refund handling
✅ User-friendly guidelines display

## 💾 Database Ready

The commissions table is automatically created with:
- Proper indexes for fast queries
- Foreign key constraints
- Soft deletes for data integrity
- Comprehensive field tracking

## 🔐 Authentication

All routes are protected with:
```php
->middleware(['auth:admin'])
```

Only logged-in admins can view their commissions.

## 📞 Troubleshooting

**Commission not showing?**
- Verify migration ran: `php artisan migrate --list`
- Check payment is marked as "success" status
- Ensure `processPaymentCommission()` is being called

**Dashboard blank?**
- Ensure you're logged in as admin
- Check that payments exist in the system
- Verify commission records in database: `SELECT * FROM commissions;`

**PDF export not working?**
- Make sure `barryvdh/laravel-dompdf` package is installed
- If not: `composer require barryvdh/laravel-dompdf`

---

## ✨ Next Steps

1. ✅ Run migration
2. ✅ Integrate with payment handler
3. ✅ Test with sample payment
4. ✅ Verify dashboard displays correctly
5. ✅ Customize views if needed
6. ✅ Share dashboard link with landlords

**Everything is ready to go!** 🎉
