@extends('admin.layouts.admin')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">📋 Lease Agreements Dashboard</h4>
                    <a href="{{ route('admin.lease-agreements.list') }}" class="btn btn-primary">
                        <i class="ri-list-check-line"></i> View All Agreements
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-lg-2 col-md-6 mb-4">
                <div class="card border-left-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">Total Agreements</p>
                                <h3 class="mb-0">{{ $stats['total'] }}</h3>
                            </div>
                            <div class="text-primary" style="font-size: 2rem;">
                                <i class="ri-file-list-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-6 mb-4">
                <div class="card border-left-warning">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">Pending Signature</p>
                                <h3 class="mb-0 text-warning">{{ $pendingSignature }}</h3>
                            </div>
                            <div class="text-warning" style="font-size: 2rem;">
                                <i class="ri-time-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-6 mb-4">
                <div class="card border-left-info">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">Awaiting Sign</p>
                                <h3 class="mb-0 text-info">{{ $stats['pending'] }}</h3>
                            </div>
                            <div class="text-info" style="font-size: 2rem;">
                                <i class="ri-checkbox-blank-circle-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-6 mb-4">
                <div class="card border-left-success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">Executed</p>
                                <h3 class="mb-0 text-success">{{ $stats['executed'] }}</h3>
                            </div>
                            <div class="text-success" style="font-size: 2rem;">
                                <i class="ri-check-double-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-6 mb-4">
                <div class="card border-left-success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">Active Leases</p>
                                <h3 class="mb-0 text-success">{{ $stats['active'] }}</h3>
                            </div>
                            <div class="text-success" style="font-size: 2rem;">
                                <i class="ri-home-smile-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-6 mb-4">
                <div class="card border-left-secondary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">Expired</p>
                                <h3 class="mb-0 text-secondary">{{ $stats['expired'] }}</h3>
                            </div>
                            <div class="text-secondary" style="font-size: 2rem;">
                                <i class="ri-calendar-close-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Overview -->
        <div class="row mt-4">
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header bg-light py-3">
                        <h5 class="mb-0">📊 Agreement Status Overview</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Active Leases</span>
                                <span class="text-success">{{ $stats['active'] }}</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success" style="width: {{ $stats['total'] > 0 ? ($stats['active'] / $stats['total'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Executed</span>
                                <span class="text-info">{{ $stats['executed'] }}</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-info" style="width: {{ $stats['total'] > 0 ? ($stats['executed'] / $stats['total'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Pending Signature</span>
                                <span class="text-warning">{{ $pendingSignature }}</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-warning" style="width: {{ $stats['total'] > 0 ? ($pendingSignature / $stats['total'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Expired</span>
                                <span class="text-secondary">{{ $stats['expired'] }}</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-secondary" style="width: {{ $stats['total'] > 0 ? ($stats['expired'] / $stats['total'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header bg-light py-3">
                        <h5 class="mb-0">⚙️ System Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <p class="mb-2"><strong>Total Agreements:</strong></p>
                            <p class="text-muted">{{ $stats['total'] }} lease agreements in system</p>
                        </div>
                        <div class="mb-3">
                            <p class="mb-2"><strong>Signature Status:</strong></p>
                            <p class="text-muted">
                                <span class="badge badge-warning">{{ $pendingSignature }}</span> awaiting signature
                            </p>
                        </div>
                        <div class="mb-3">
                            <p class="mb-2"><strong>Active Status:</strong></p>
                            <p class="text-muted">
                                <span class="badge badge-success">{{ $stats['active'] }}</span> active leases
                                <span class="badge badge-secondary">{{ $stats['expired'] }}</span> expired leases
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Agreements -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">📋 Recent Lease Agreements</h5>
                        <a href="{{ route('admin.lease-agreements.list') }}" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Tenant</th>
                                    <th>Property</th>
                                    <th>Duration</th>
                                    <th>Monthly Rent</th>
                                    <th>Status</th>
                                    <th>Signatures</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentAgreements as $agreement)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $agreement->tenant->profile_photo_url }}" alt="{{ $agreement->tenant->name }}" 
                                                 class="rounded-circle me-2" width="32" height="32">
                                            <div>
                                                <p class="mb-0">{{ $agreement->tenant->name }}</p>
                                                <small class="text-muted">{{ $agreement->tenant->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0">{{ $agreement->property->title ?? 'N/A' }}</p>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $agreement->formatted_start_date }}<br>
                                            to {{ $agreement->formatted_end_date }}
                                        </small>
                                    </td>
                                    <td>
                                        <strong>₱{{ number_format($agreement->monthly_rent, 2) }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ \App\Models\LeaseAgreement::getStatusColor($agreement->status) }}">
                                            {{ \App\Models\LeaseAgreement::getStatusLabel($agreement->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div style="font-size: 12px;">
                                            @if($agreement->tenant_signed_at)
                                                <span class="badge badge-success">✓ Tenant</span>
                                            @else
                                                <span class="badge badge-warning">Tenant</span>
                                            @endif
                                            <br>
                                            @if($agreement->landlord_signed_at)
                                                <span class="badge badge-success">✓ Landlord</span>
                                            @else
                                                <span class="badge badge-warning">Landlord</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.lease-agreements.show', $agreement) }}" 
                                               class="btn btn-sm btn-outline-primary" title="View Details">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                            <a href="{{ route('lease-agreements.download', $agreement) }}" 
                                               class="btn btn-sm btn-outline-success" title="Download PDF">
                                                <i class="ri-download-2-line"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <p class="text-muted mb-0">No lease agreements yet</p>
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
    .border-left-info {
        border-left: 4px solid #1890ff !important;
    }
    .border-left-secondary {
        border-left: 4px solid #6c757d !important;
    }
</style>
@endsection
