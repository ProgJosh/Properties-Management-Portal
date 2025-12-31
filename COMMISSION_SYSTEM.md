# Commission System Implementation Guide

## Overview
Complete commission tracking system for the Properties Management Portal with full database integration, automatic calculations, and comprehensive reporting.

## What's Been Implemented

### 1. **Database** (`migrations/2024_12_26_000000_create_commissions_table.php`)
- Stores all commission records
- Tracks commission deductions per payment
- Supports statuses: pending, deducted, refunded
- Monthly grouping for reporting

### 2. **Commission Model** (`app/Models/Commission.php`)
- Relationships with Admin, Payment, and Booking
- Query scopes for filtering
- Static methods for calculations and reporting
- Dashboard statistics generation

### 3. **Commission Service** (`app/Services/CommissionService.php`)
- Core business logic for commission processing
- Automatic calculations (3%)
- Monthly and yearly reporting
- Commission refunds
- Dashboard statistics

### 4. **Commission Controller** (`app/Http/Controllers/CommissionController.php`)
- Routes for all commission features
- Dashboard with key metrics
- History and reporting endpoints
- PDF export functionality
- API endpoints for integration

### 5. **Updated Payment Model** (`app/Models/Payment.php`)
- Relationship to Commission
- Helper methods for commission amount and net amount

### 6. **Dashboard View** (`resources/views/admin/commission/dashboard.blade.php`)
- Overview of commission statistics
- Monthly and yearly breakdowns
- Commission policy guidelines reminder
- Action buttons for reports

## How to Set Up

### Step 1: Run Database Migration
```bash
php artisan migrate
```

This creates the `commissions` table automatically.

### Step 2: Update Payment Processing
When a payment is successfully processed, add this code to create a commission record:

```php
use App\Services\CommissionService;

$commissionService = new CommissionService();
$commission = $commissionService->processPaymentCommission($payment);
```

### Example Integration (in your PaymentController):
```php
public function processPayment(Request $request)
{
    // ... payment processing code ...

    // Create commission after successful payment
    if ($payment->status === 'success') {
        $commissionService = new CommissionService();
        $commission = $commissionService->processPaymentCommission($payment);
    }

    return redirect()->route('thankyou');
}
```

## Usage

### Admin Dashboard Access
- **URL:** `/admin/commission/dashboard`
- **View:**  Commission overview with key metrics

### Features Available

#### 1. Commission Dashboard
```
GET /admin/commission/dashboard
```
Shows:
- Total commission earned
- Pending commissions
- This month's commission
- Refunded commissions
- Commission breakdown
- Monthly report summary

#### 2. Commission History
```
GET /admin/commission/history
```
Paginated list of all commission transactions with details

#### 3. Monthly Report
```
GET /admin/commission/monthly-report?year=2024&month=12
```
Detailed report for a specific month

#### 4. Yearly Report
```
GET /admin/commission/yearly-report?year=2024
```
Complete yearly summary with monthly breakdown

#### 5. Download PDF Report
```
GET /admin/commission/download-pdf?type=monthly&year=2024&month=12
```
Download commission report as PDF

### API Endpoints

#### Get Commission Statistics
```
GET /admin/api/commission/stats
Response:
{
    "total_commission_earned": 1500.00,
    "pending_commission": 300.00,
    "total_transactions": 45,
    "this_month_commission": 450.00,
    "refunded_commission": 0
}
```

#### Get Commission History (API)
```
GET /admin/api/commission/history?per_page=15
```

## Commission Calculation Logic

### Formula
```
Commission Amount = (Transaction Amount × 3%) / 100
Net Amount = Transaction Amount - Commission Amount
```

### Example
```
Transaction: ₱10,000
Commission (3%): ₱300
Net Payout: ₱9,700
```

## Database Schema

### Commissions Table
```sql
- id (primary key)
- admin_id (foreign key to admins)
- payment_id (foreign key to payments)
- booking_id (foreign key to bookings)
- transaction_amount (decimal)
- commission_percentage (decimal) - default 3%
- commission_amount (decimal)
- net_amount (decimal)
- status (enum: pending, deducted, refunded)
- payment_status (enum: successful, failed, refunded)
- month_year (string) - for grouping (YYYY-MM)
- notes (text)
- timestamps
- soft_deletes
```

## Key Methods in CommissionService

### Process Payment Commission
```php
$commission = $commissionService->processPaymentCommission($payment);
```

### Get Admin Breakdown
```php
$breakdown = $commissionService->getAdminCommissionBreakdown($adminId);
```

### Get Monthly Report
```php
$report = $commissionService->getMonthlyCommissionReport($adminId, 2024, 12);
```

### Get Yearly Report
```php
$report = $commissionService->getYearlyCommissionReport($adminId, 2024);
```

### Refund Commission
```php
$commission = $commissionService->refundCommission($commission, 'Payment refunded');
```

### Dashboard Statistics
```php
$stats = $commissionService->getDashboardStats($adminId);
```

## Commission Policy Guidelines

The commission system implements these policies:

1. **Rate:** 3% flat rate on all successful transactions
2. **Timing:** Automatically deducted when payment is processed
3. **Purpose:** Covers platform maintenance, security, and fraud protection
4. **Refunds:** Commission refunded if payment is refunded
5. **Reporting:** Monthly reports provided to landlords
6. **Transparency:** Full breakdown of all deductions visible to users

## User-Facing Notices

Users see the commission policy during registration:
- Admin Warning Modal
- Landlord Terms Modal
- **Commission Policy Modal** (with your custom image)

The dashboard also displays guidelines explaining:
- How commission works
- When it's applied
- What it covers
- Example calculations

## Integration Checklist

- [ ] Run migration: `php artisan migrate`
- [ ] Update PaymentController to call `processPaymentCommission()`
- [ ] Test commission creation on a test payment
- [ ] Verify dashboard displays correctly at `/admin/commission/dashboard`
- [ ] Check monthly/yearly reports work properly
- [ ] Test PDF export functionality
- [ ] Verify commission appears in landlord statistics

## Future Enhancements

Potential additions:
- Adjustable commission rates per landlord
- Tiered commission structure
- Commission discounts for high-volume users
- Withdrawal of commission earnings
- Commission payment schedules
- Email notifications for commission deductions
- Export to accounting software

## Support

If you need to modify:
- **Commission percentage:** Edit `COMMISSION_PERCENTAGE` in `CommissionService.php`
- **Calculation logic:** Modify `calculateCommission()` method
- **Report format:** Edit blade views in `resources/views/admin/commission/`
- **Database fields:** Create new migration with schema changes

---

**All users registering as landlords have read and agreed to the commission policy during signup!** ✅
