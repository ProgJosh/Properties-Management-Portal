# ID Validation - Quick Integration Guide

## Database Setup

Run migrations to add required columns:

```sql
-- Add to users table
ALTER TABLE users ADD COLUMN id_verified BOOLEAN DEFAULT false;
ALTER TABLE users ADD COLUMN id_submitted_at TIMESTAMP NULL;

-- Add to user_details table
ALTER TABLE user_details ADD COLUMN id_type VARCHAR(50);
ALTER TABLE user_details ADD COLUMN id_number VARCHAR(50);
ALTER TABLE user_details ADD COLUMN full_name_on_id VARCHAR(100);
ALTER TABLE user_details ADD COLUMN id_expiry_date DATE;
ALTER TABLE user_details ADD COLUMN id_document_path VARCHAR(255);
ALTER TABLE user_details ADD COLUMN id_verification_status VARCHAR(50);
ALTER TABLE user_details ADD COLUMN id_verified_at TIMESTAMP NULL;
ALTER TABLE user_details ADD COLUMN verification_notes TEXT NULL;
```

Or create migration file:

```bash
php artisan make:migration add_id_validation_columns
```

## Storage Configuration

Edit `config/filesystems.php` to use private disk:

```php
'disks' => [
    'private' => [
        'driver' => 'local',
        'root' => storage_path('app/private'),
        'url' => env('APP_URL') . '/storage',
        'visibility' => 'private',
    ],
],
```

## Routes Setup

Add to `routes/web.php`:

```php
Route::middleware(['auth'])->group(function () {
    Route::get('/user/id-upload', [App\Http\Controllers\UserController::class, 'showIdUploadForm'])
        ->name('user.id-upload');
    Route::post('/user/upload-id', [App\Http\Controllers\UserController::class, 'uploadId'])
        ->name('user.upload-id');
    Route::get('/user/id-status', [App\Http\Controllers\UserController::class, 'viewIdStatus'])
        ->name('user.id-status');
    Route::delete('/user/id-document', [App\Http\Controllers\UserController::class, 'deleteId'])
        ->name('user.delete-id');
    Route::get('/user/id-resubmit', [App\Http\Controllers\UserController::class, 'resubmitId'])
        ->name('user.id-resubmit');
    Route::get('/check-id-verification', [App\Http\Controllers\UserController::class, 'checkIdVerification'])
        ->name('check-id-verification');
});
```

## Usage in Views

### Registration Form
Include ID upload form during registration:

```blade
<!-- In registration view -->
<div class="form-section">
    @include('components.id-upload-form', ['user' => $user])
</div>
```

### Profile Page
Show ID status on user profile:

```blade
<div class="profile-section">
    <h5>ID Verification Status</h5>
    {!! $user->getIdStatusBadge() !!}
</div>
```

### Before Important Actions
Check ID before allowing actions:

```blade
@if($user->canPerformIdRequiredActions())
    <button class="btn btn-primary">Sign Lease</button>
@else
    <div class="alert alert-warning">
        Please verify your ID to sign leases.
        <a href="{{ route('user.id-upload') }}">Upload ID</a>
    </div>
@endif
```

## Controller Implementation

Example: Require ID verification before signing lease

```php
// In LeaseAgreementController
public function sign(LeaseAgreement $agreement)
{
    $user = Auth::user();
    
    if (!$user->canPerformIdRequiredActions()) {
        return back()->with('error', 'Please verify your ID first.');
    }
    
    // Proceed with signing
}
```

## Admin Panel Setup

Create admin endpoint to review pending IDs:

```php
// In AdminController
public function reviewPendingIds()
{
    $pendingUsers = User::whereHas('userDetails', 
        fn($q) => $q->where('id_verification_status', 'pending')
    )->get();
    
    return view('admin.id-verification', ['pendingUsers' => $pendingUsers]);
}
```

## Approve/Reject ID

```php
// In AdminController
public function approveId(User $user)
{
    $service = app(IdValidationService::class);
    $service->verifyId($user, true, 'Approved');
    
    Toastr::success('ID approved');
    return back();
}

public function rejectId(User $user, Request $request)
{
    $service = app(IdValidationService::class);
    $service->rejectIdAndRequest($user, $request->reason);
    
    Toastr::success('ID rejected and user notified');
    return back();
}
```

## File Structure

```
app/
  Http/
    Requests/
      UploadIdRequest.php ✓
    Controllers/
      UserController.php ✓
  Services/
    IdValidationService.php ✓
  Models/
    User.php (methods added) ✓
resources/
  views/
    components/
      id-upload-form.blade.php ✓
```

## Verification Checklist

- [ ] Database columns added
- [ ] Storage disk configured
- [ ] Routes added to web.php
- [ ] ID upload form included in registration
- [ ] ID status badge displaying correctly
- [ ] ID verification required before lease signing
- [ ] Admin panel shows pending IDs
- [ ] ID approval/rejection working
- [ ] Users can resubmit rejected IDs

## That's It!

Users can now:
1. ✅ Upload government-issued ID during registration
2. ✅ View verification status
3. ✅ Resubmit if rejected
4. ✅ Sign lease agreements only when verified

Admins can:
1. ✅ Review pending IDs
2. ✅ Approve or reject with notes
3. ✅ View temporary secure links to documents
