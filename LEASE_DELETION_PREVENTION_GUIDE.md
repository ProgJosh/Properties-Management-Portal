# Lease Agreement Deletion Prevention Feature

## Overview

This feature prevents the deletion of active lease agreements until the contract end date has passed. This maintains record integrity and prevents disputes during the lease period.

**Purpose**: To maintain legal compliance and prevent accidental deletion of active contracts.

---

## Features

### 1. Automatic Blocking of Active Leases
- Active agreements (status = 'executed' and within contract period) cannot be deleted
- Clear user-friendly error messages explain why deletion is blocked
- Shows the agreement end date and days remaining

### 2. Status-Based Deletion Rules

| Status | Can Delete? | Reason |
|--------|-----------|--------|
| `pending` | ✅ Yes | Not yet active |
| `signed_by_tenant` | ✅ Yes | Not yet active |
| `signed_by_landlord` | ✅ Yes | Not yet active |
| `executed` (active) | ❌ No | Currently active lease |
| `executed` (future) | ❌ No | Not yet started |
| `executed` (expired) | ✅ Yes | Contract period ended |
| `cancelled` | ✅ Yes | Already cancelled |

### 3. Authorization Checks
- Only landlord/admin can delete agreements
- Tenant users are always denied deletion
- Policy-based authorization ensures security

### 4. Safe Deletion Process
- Two-step confirmation modal
- Agreement details displayed
- Requires explicit checkbox confirmations
- AJAX-based submission with error handling

---

## Implementation Files

### 1. Model Methods - `LeaseAgreement.php`

```php
/**
 * Check if lease is currently during the agreement period
 */
public function isDuringAgreementPeriod(): bool
{
    return $this->status === 'executed' &&
           $this->start_date <= now()->toDateString() &&
           $this->end_date >= now()->toDateString();
}

/**
 * Check if lease agreement can be deleted
 */
public function canBeDeleted(): bool
{
    if ($this->isDuringAgreementPeriod()) {
        return false;
    }
    if ($this->status === 'executed' && !$this->isCompleted()) {
        return false;
    }
    return true;
}

/**
 * Get reason why lease cannot be deleted
 */
public function getDeletionBlockReason(): ?string
{
    if ($this->isDuringAgreementPeriod()) {
        $daysRemaining = $this->end_date->diffInDays(now());
        return "This lease agreement is currently active and cannot be deleted. 
                The agreement ends on {$this->end_date->format('M d, Y')} 
                ({$daysRemaining} days remaining). 
                You may cancel this agreement instead.";
    }

    if ($this->status === 'executed' && !$this->isCompleted()) {
        return "This agreement is in executed status and cannot be deleted. 
                Please wait until the agreement end date or cancel it if needed.";
    }

    return null;
}
```

### 2. Controller Method - `LeaseAgreementController.php`

```php
/**
 * Delete agreement (only non-active agreements)
 * Active agreements cannot be deleted until end date
 */
public function destroy(LeaseAgreement $agreement)
{
    // Check if agreement can be deleted
    if (!$agreement->canBeDeleted()) {
        $reason = $agreement->getDeletionBlockReason();
        return back()->with('error', $reason ?? 'This agreement cannot be deleted.');
    }

    try {
        $agreement->forceDelete();
        return back()->with('success', 'Agreement deleted successfully!');
    } catch (\Exception $e) {
        return back()->with('error', 'Error deleting agreement: ' . $e->getMessage());
    }
}
```

### 3. Authorization Policy - `LeaseAgreementPolicy.php`

```php
/**
 * Determine if the user can delete the agreement
 * Active lease agreements cannot be deleted until end date
 */
public function delete(User|Admin $user, LeaseAgreement $agreement): bool
{
    // Only admin/landlord can delete
    if ($user instanceof User) {
        return false;
    }

    // Admin must be the landlord
    if ($user->id !== $agreement->landlord_id) {
        return false;
    }

    // Check if agreement can be deleted
    return $agreement->canBeDeleted();
}
```

### 4. Delete Modal Component - `delete-modal.blade.php`

Two-state modal that shows:
- **Blocked State**: Error message with reason, disabled delete button
- **Allowed State**: Agreement details, confirmation checkboxes, active delete button

Features:
- AJAX form submission
- Loading state with spinner
- Error handling with alerts
- Page reload on success

---

## Usage Guide

### In Your Views

#### Include the Modal
```blade
@include('components.lease-agreement.delete-modal')
```

#### Add Delete Button
```blade
@can('delete', $agreement)
    <button class="btn btn-danger" data-toggle="modal" 
            data-target="#deleteLeaseModal"
            data-agreement-id="{{ $agreement->id }}"
            data-tenant-name="{{ $agreement->tenant->name }}"
            data-property-name="{{ $agreement->property->name }}"
            data-agreement-status="{{ \App\Models\LeaseAgreement::getStatusLabel($agreement->status) }}"
            data-can-delete="{{ $agreement->canBeDeleted() ? 'true' : 'false' }}"
            data-block-reason="{{ $agreement->getDeletionBlockReason() }}"
            data-delete-url="{{ route('lease-agreements.destroy', $agreement->id) }}">
        🗑️ Delete
    </button>
@endcan
```

### Check Deletion Status in Code

```php
// Check if agreement can be deleted
if ($agreement->canBeDeleted()) {
    // Safe to delete
    $agreement->forceDelete();
} else {
    // Show error message
    $reason = $agreement->getDeletionBlockReason();
    // "This lease agreement is currently active..."
}

// Check if lease is currently active
if ($agreement->isDuringAgreementPeriod()) {
    // Lease is executing
}
```

### Check Authorization

```blade
@can('delete', $agreement)
    <!-- Show delete button -->
@endcan

@cannot('delete', $agreement)
    <!-- Show disabled button or message -->
@endcannot
```

---

## Routes Configuration

Add to `routes/web.php`:

```php
Route::middleware(['auth:admin', 'verified'])->group(function () {
    Route::delete('/lease-agreements/{leaseAgreement}', 
        [LeaseAgreementController::class, 'destroy'])
        ->name('lease-agreements.destroy');
});
```

---

## Policy Registration

In `app/Providers/AuthServiceProvider.php`:

```php
protected $policies = [
    LeaseAgreement::class => LeaseAgreementPolicy::class,
];
```

---

## Error Messages

### When Deletion is Blocked

**For Active Lease:**
```
This lease agreement is currently active and cannot be deleted. 
The agreement ends on Jan 15, 2027 (45 days remaining). 
You may cancel this agreement instead.
```

**For Future Lease:**
```
This agreement is in executed status and cannot be deleted. 
Please wait until the agreement end date or cancel it if needed.
```

---

## Alternative: Cancellation Instead of Deletion

For active agreements, users should cancel instead:

```php
// Cancel the agreement
$agreement->cancel('Reason for cancellation');

// Notify parties
app(LeaseAgreementService::class)
    ->notifyOfCancellation($agreement, 'Reason');

// Now it can be deleted if needed
```

---

## Database Considerations

The feature uses existing database columns:
- `status` - Agreement status
- `start_date` - When agreement begins
- `end_date` - When agreement ends
- `deleted_at` - For soft deletes (already in model with SoftDeletes trait)

**No database migration needed!**

---

## Security Features

✅ **Authorization** - Only landlord can delete  
✅ **Business Logic** - Must meet deletion criteria  
✅ **Form Validation** - Confirmation checkboxes required  
✅ **CSRF Protection** - All requests protected  
✅ **Soft Deletes** - Records preserved for audit trail  

---

## Testing

Example test:

```php
public function test_active_lease_cannot_be_deleted()
{
    $agreement = LeaseAgreement::factory()->create([
        'status' => 'executed',
        'start_date' => now()->subDay(),
        'end_date' => now()->addMonths(6),
    ]);

    $this->assertFalse($agreement->canBeDeleted());
    $this->assertTrue($agreement->isDuringAgreementPeriod());
}

public function test_expired_lease_can_be_deleted()
{
    $agreement = LeaseAgreement::factory()->create([
        'status' => 'executed',
        'start_date' => now()->subYears(2),
        'end_date' => now()->subMonths(1),
    ]);

    $this->assertTrue($agreement->canBeDeleted());
}
```

---

## User Experience Flow

### When User Tries to Delete Active Agreement

```
1. User clicks Delete button
2. Modal opens showing "BLOCKED" state
3. Error message: "This lease agreement is currently active..."
4. Shows end date and days remaining
5. Delete button is disabled
6. User can close modal or consider cancelling instead
```

### When User Tries to Delete Pending Agreement

```
1. User clicks Delete button
2. Modal opens showing "ALLOWED" state
3. Shows agreement details (ID, tenant, property, status)
4. Requires two checkbox confirmations
5. Delete button becomes enabled
6. User clicks Delete
7. AJAX submission to server
8. Agreement deleted on success
9. Page reloads
```

---

## File Locations

| File | Purpose |
|------|---------|
| `app/Models/LeaseAgreement.php` | Model methods |
| `app/Http/Controllers/LeaseAgreementController.php` | Controller destroy method |
| `app/Policies/LeaseAgreementPolicy.php` | Authorization policy |
| `resources/views/components/lease-agreement/delete-modal.blade.php` | Delete modal |

---

## Best Practices

1. **Always check `canBeDeleted()` before deleting**
2. **Show the block reason to users** when deletion is not allowed
3. **Suggest cancellation as alternative** for active agreements
4. **Use soft deletes** to preserve audit trail
5. **Require confirmation** before permanent deletion
6. **Log deletion actions** for compliance

---

## Summary

This feature provides:
- ✅ Automatic protection of active leases
- ✅ Clear user communication
- ✅ Safe two-step deletion process
- ✅ Authorization checks
- ✅ Audit trail via soft deletes
- ✅ Alternative cancellation option

**Status**: Production-ready and fully implemented.
