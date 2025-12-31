@extends('admin.layouts.admin')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Payment Reminders Dashboard</h4>
                    <a href="{{ route('admin.reminders.index') }}" class="btn btn-primary">
                        <i class="ri-list-check-line"></i> View All Reminders
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-left-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">Total Reminders</p>
                                <h3 class="mb-0">{{ $stats['total_reminders'] }}</h3>
                            </div>
                            <div class="text-primary" style="font-size: 2.5rem;">
                                <i class="ri-bell-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-left-warning">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">Pending Reminders</p>
                                <h3 class="mb-0 text-warning">{{ $pendingReminders }}</h3>
                            </div>
                            <div class="text-warning" style="font-size: 2.5rem;">
                                <i class="ri-time-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-left-danger">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">Overdue Reminders</p>
                                <h3 class="mb-0 text-danger">{{ $overdueReminders }}</h3>
                            </div>
                            <div class="text-danger" style="font-size: 2.5rem;">
                                <i class="ri-alert-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-left-success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">Sent Successfully</p>
                                <h3 class="mb-0 text-success">{{ $stats['sent_reminders'] }}</h3>
                            </div>
                            <div class="text-success" style="font-size: 2.5rem;">
                                <i class="ri-check-double-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Statistics -->
        <div class="row mt-4">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-light py-3">
                        <h5 class="mb-0">📊 Reminder Status</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Sent</span>
                                <span class="text-success">{{ $stats['sent_reminders'] }}</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success" style="width: {{ $stats['total_reminders'] > 0 ? ($stats['sent_reminders'] / $stats['total_reminders'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Acknowledged</span>
                                <span class="text-info">{{ $stats['acknowledged_reminders'] }}</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-info" style="width: {{ $stats['total_reminders'] > 0 ? ($stats['acknowledged_reminders'] / $stats['total_reminders'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Failed</span>
                                <span class="text-danger">{{ $stats['failed_reminders'] }}</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-danger" style="width: {{ $stats['total_reminders'] > 0 ? ($stats['failed_reminders'] / $stats['total_reminders'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-light py-3">
                        <h5 class="mb-0">🔔 Notification Channels</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex align-items-center">
                                <i class="ri-mail-line text-primary" style="font-size: 1.5rem;"></i>
                                <div class="ms-3">
                                    <p class="mb-0">Email Notifications</p>
                                    <small class="text-muted">Multi-channel delivery</small>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center">
                                <i class="ri-smartphone-line text-success" style="font-size: 1.5rem;"></i>
                                <div class="ms-3">
                                    <p class="mb-0">SMS Notifications</p>
                                    <small class="text-muted">Mobile alerts</small>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center">
                                <i class="ri-notification-line text-warning" style="font-size: 1.5rem;"></i>
                                <div class="ms-3">
                                    <p class="mb-0">In-App Notifications</p>
                                    <small class="text-muted">Dashboard alerts</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-header bg-light py-3">
                        <h5 class="mb-0">⚙️ System Info</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <p class="mb-2"><strong>Advance Reminders:</strong></p>
                            <p class="text-muted">Sent 5 days before due date</p>
                        </div>
                        <div class="mb-3">
                            <p class="mb-2"><strong>Schedule:</strong></p>
                            <p class="text-muted">
                                <span class="badge badge-primary">08:00 AM</span> Advance<br>
                                <span class="badge badge-danger">02:00 PM</span> Overdue
                            </p>
                        </div>
                        <div>
                            <p class="mb-2"><strong>Command:</strong></p>
                            <code class="text-muted">php artisan reminders:send</code>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Reminders -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">📋 Recent Reminders</h5>
                        <a href="{{ route('admin.reminders.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Tenant</th>
                                    <th>Property</th>
                                    <th>Amount</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentReminders as $reminder)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $reminder->user->profile_photo_url }}" alt="{{ $reminder->user->name }}" 
                                                 class="rounded-circle me-2" width="32" height="32">
                                            <div>
                                                <p class="mb-0">{{ $reminder->user->name }}</p>
                                                <small class="text-muted">{{ $reminder->user->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0">{{ $reminder->property->title ?? 'N/A' }}</p>
                                    </td>
                                    <td>
                                        <strong>₱{{ number_format($reminder->amount, 2) }}</strong>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $reminder->formatted_due_date }}</span>
                                    </td>
                                    <td>
                                        @php
                                            $statusClass = [
                                                'pending' => 'warning',
                                                'sent' => 'success',
                                                'failed' => 'danger',
                                                'acknowledged' => 'info',
                                            ][$reminder->status] ?? 'secondary';
                                        @endphp
                                        <span class="badge badge-{{ $statusClass }}">{{ ucfirst($reminder->status) }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-light">{{ ucfirst(str_replace('_', ' ', $reminder->reminder_type)) }}</span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-outline-primary" 
                                                    onclick="resendReminder({{ $reminder->id }})">
                                                <i class="ri-send-plane-line"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger" 
                                                    onclick="deleteReminder({{ $reminder->id }})">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <p class="text-muted mb-0">No reminders yet</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .border-left-primary {
        border-left: 4px solid #667eea !important;
    }
    .border-left-success {
        border-left: 4px solid #51cf66 !important;
    }
    .border-left-danger {
        border-left: 4px solid #ff6b6b !important;
    }
    .border-left-warning {
        border-left: 4px solid #fcc419 !important;
    }
</style>

<script>
function resendReminder(reminderId) {
    if (confirm('Are you sure you want to resend this reminder notification?')) {
        fetch(`/admin/reminders/${reminderId}/resend`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Reminder resent successfully!');
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error resending reminder');
        });
    }
}

function deleteReminder(reminderId) {
    if (confirm('Are you sure you want to delete this reminder? This action cannot be undone.')) {
        fetch(`/admin/reminders/${reminderId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Reminder deleted successfully!');
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting reminder');
        });
    }
}
</script>
@endsection
