# Lease Deletion Prevention - Quick Integration Guide

## 5-Minute Setup

### Step 1: Register Policy (AuthServiceProvider)

**File**: `app/Providers/AuthServiceProvider.php`

Add to the `$policies` array:

```php
protected $policies = [
    \App\Models\LeaseAgreement::class => \App\Policies\LeaseAgreementPolicy::class,
];
```

### Step 2: Add Route

**File**: `routes/web.php`

Add to admin routes group:

```php
Route::delete('/lease-agreements/{leaseAgreement}', 
    [\App\Http\Controllers\LeaseAgreementController::class, 'destroy'])
    ->name('lease-agreements.destroy');
```

### Step 3: Include Modal in Your View

**File**: Any view showing lease agreements

Add at the bottom:

```blade
@include('components.lease-agreement.delete-modal')
```

### Step 4: Add Delete Button

**File**: Your lease list/show view

```blade
@can('delete', $agreement)
    <button class="btn btn-danger btn-sm" 
            data-toggle="modal" 
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

---

## What Gets Blocked?

❌ **BLOCKED**: Active leases (executed + within contract period)
✅ **ALLOWED**: Pending, cancelled, expired, completed agreements

---

## User-Friendly Error Message

When deletion is blocked, users see:

> "This lease agreement is currently active and cannot be deleted. The agreement ends on Jan 15, 2027 (45 days remaining). You may cancel this agreement instead."

---

## Testing

```bash
# You should now be able to:
# 1. View active agreements
# 2. Click delete button
# 3. See blocked modal with error message
# 4. Try to delete expired agreement
# 5. See allowed modal with confirmation
```

---

## Verification Checklist

- [ ] Policy registered in AuthServiceProvider
- [ ] Route added to web.php
- [ ] Modal component included in view
- [ ] Delete button added with data attributes
- [ ] Can see blocked state for active leases
- [ ] Can delete expired/pending leases

---

## That's It!

The feature is now active. Users cannot delete active lease agreements anymore.
