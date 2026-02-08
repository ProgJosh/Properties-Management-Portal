@extends('layouts.app')

@push('styles')
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/logo/system-logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/lease-agreement.css') }}?v={{ time() }}">
    <style>
        .dashboard-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .logo-container {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .logo-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: white;
            padding: 5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }
        .dashboard-title {
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }
        .user-dropdown {
            color: white;
        }
        .lease-header-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }
        .lease-header-card h1 {
            color: white;
            font-weight: 700;
        }
        .lease-header-card .text-muted {
            color: rgba(255, 255, 255, 0.9) !important;
        }
        .card {
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        .badge {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            border-radius: 20px;
        }
    </style>
@endpush

@section('content')
<!-- Dashboard Header with Logo -->
<div class="dashboard-header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo-container">
                <img src="{{ asset('frontend/assets/images/logo/system-logo.png') }}" alt="Properties Portal" class="logo-img">
                <h1 class="dashboard-title">Properties Management Portal</h1>
            </div>
            <div class="user-dropdown">
                <span class="mr-3">{{ auth()->user()->name ?? 'User' }}</span>
                <i class="fas fa-user-circle fa-2x"></i>
            </div>
        </div>
    </div>
</div>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Agreement Header -->
            <div class="card mb-4 border-0 lease-header-card">
                <div class="card-body text-center py-5">
                    <h1 class="mb-3">📋 Lease Agreement</h1>
                    <p class="mb-2" style="color: rgba(255, 255, 255, 0.95); font-size: 1.1rem;">Agreement ID: <strong>#{{ $lease->id }}</strong></p>
                    <div style="margin-top: 1.5rem;">
                        <span class="badge badge-{{ $lease->status === 'pending' ? 'warning' : ($lease->status === 'executed' ? 'success' : ($lease->status === 'signed_by_tenant' || $lease->status === 'signed_by_landlord' ? 'info' : 'light')) }}" style="font-size: 1rem; padding: 0.6rem 1.5rem;">
                            {{ str_replace('_', ' ', ucwords($lease->status)) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Lease Term Section -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-light border-bottom">
                    <h5 class="mb-0">📅 Lease Term & Duration</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div style="padding: 1.5rem; background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(129, 140, 248, 0.02) 100%); border-radius: 10px; border-left: 4px solid var(--primary-color);">
                                <p class="mb-2"><strong>📌 Start Date</strong></p>
                                <p class="text-muted" style="font-size: 1.1rem;">{{ $lease->start_date->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="padding: 1.5rem; background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(129, 140, 248, 0.02) 100%); border-radius: 10px; border-left: 4px solid var(--primary-color);">
                                <p class="mb-2"><strong>📌 End Date</strong></p>
                                <p class="text-muted" style="font-size: 1.1rem;">{{ $lease->end_date->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-2"><strong>⏱️ Duration:</strong></p>
                            <p class="text-muted">
                                @php
                                    $durationDays = $lease->start_date->diffInDays($lease->end_date);
                                    $durationMonths = $lease->start_date->diffInMonths($lease->end_date);
                                    $years = floor($durationMonths / 12);
                                    $remainingMonths = $durationMonths % 12;
                                @endphp
                                @if($years > 0)
                                    {{ $years }} {{ $years == 1 ? 'year' : 'years' }}
                                    @if($remainingMonths > 0)
                                        , {{ $remainingMonths }} {{ $remainingMonths == 1 ? 'month' : 'months' }}
                                    @endif
                                @elseif($durationMonths >= 1)
                                    {{ $durationMonths }} {{ $durationMonths == 1 ? 'month' : 'months' }}
                                @else
                                    {{ $durationDays }} {{ $durationDays == 1 ? 'day' : 'days' }}
                                @endif
                                <br>
                                <small>({{ $lease->start_date->format('M d') }} - {{ $lease->end_date->format('M d, Y') }})</small>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><strong>📊 Status:</strong></p>
                            <p>
                                @if($lease->status === 'executed' && $lease->start_date <= now() && $lease->end_date >= now())
                                    <span class="badge badge-success">✓ Active Agreement</span>
                                    <small class="d-block text-muted mt-2">Days Remaining: <strong>{{ $lease->end_date->diffInDays(now()) }}</strong></small>
                                @elseif($lease->status === 'executed' && $lease->end_date < now())
                                    <span class="badge badge-secondary">Expired</span>
                                @elseif($lease->status === 'executed')
                                    <span class="badge badge-info">Scheduled to Start</span>
                                @elseif($lease->status === 'signed_by_tenant')
                                    <span class="badge badge-info">Awaiting Landlord Signature</span>
                                @elseif($lease->status === 'signed_by_landlord')
                                    <span class="badge badge-warning">Awaiting Your Signature</span>
                                @else
                                    <span class="badge badge-warning">Pending Signatures</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Property Information -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-light border-bottom">
                    <h5 class="mb-0">🏠 Property Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-2"><strong>Property Name:</strong></p>
                            <p class="text-muted">{{ $lease->property->name ?? 'Not Set' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><strong>Type:</strong></p>
                            <p class="text-muted">{{ ucfirst($lease->property->type ?? 'N/A') }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <p class="mb-2"><strong>Address:</strong></p>
                            <p class="text-muted">{{ $lease->property->address ?? 'Not provided' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-2"><strong>City:</strong></p>
                            <p class="text-muted">{{ $lease->property->city ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><strong>Postal Code:</strong></p>
                            <p class="text-muted">{{ $lease->property->postal_code ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Financial Terms -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-light border-bottom">
                    <h5 class="mb-0">💰 Financial Terms</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div style="padding: 1.5rem; background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(16, 185, 129, 0.02) 100%); border-radius: 10px; border-left: 4px solid var(--success-color); margin-bottom: 1.5rem;">
                                <p class="mb-2"><strong>Monthly Rent</strong></p>
                                <p style="font-size: 1.75rem; font-weight: 700; color: var(--success-color);">₱{{ number_format($lease->monthly_rent, 2) }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="padding: 1.5rem; background: linear-gradient(135deg, rgba(245, 158, 11, 0.05) 0%, rgba(245, 158, 11, 0.02) 100%); border-radius: 10px; border-left: 4px solid var(--warning-color); margin-bottom: 1.5rem;">
                                <p class="mb-2"><strong>Security Deposit</strong></p>
                                <p style="font-size: 1.75rem; font-weight: 700; color: var(--warning-color);">₱{{ number_format($lease->security_deposit ?? 0, 2) }}</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-2"><strong>Lease Duration:</strong></p>
                            @php
                                $durationDays = $lease->start_date->diffInDays($lease->end_date);
                                $durationMonths = $lease->start_date->diffInMonths($lease->end_date);
                                $years = floor($durationMonths / 12);
                                $remainingMonths = $durationMonths % 12;
                            @endphp
                            <p class="text-muted" style="font-size: 1.1rem;">
                                @if($years > 0)
                                    {{ $years }} {{ $years == 1 ? 'year' : 'years' }}
                                    @if($remainingMonths > 0)
                                        , {{ $remainingMonths }} {{ $remainingMonths == 1 ? 'month' : 'months' }}
                                    @endif
                                @elseif($durationMonths >= 1)
                                    {{ $durationMonths }} {{ $durationMonths == 1 ? 'month' : 'months' }}
                                @else
                                    {{ $durationDays }} {{ $durationDays == 1 ? 'day' : 'days' }}
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><strong>Total Lease Amount:</strong></p>
                            @php
                                if($durationMonths >= 1) {
                                    $totalAmount = $lease->monthly_rent * $durationMonths;
                                } else {
                                    // Calculate daily rate for short-term leases
                                    $dailyRate = $lease->monthly_rent / 30;
                                    $totalAmount = $dailyRate * $durationDays;
                                }
                            @endphp
                            <p style="font-size: 1.1rem; font-weight: 700; color: var(--primary-color);">₱{{ number_format($totalAmount, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Parties Information -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-light border-bottom">
                    <h5 class="mb-0">👥 Parties Involved</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-3">👨 Tenant (Lessee)</h6>
                            <p class="mb-1"><strong>Name:</strong> {{ $lease->tenant->name }}</p>
                            <p class="mb-1"><strong>Email:</strong> {{ $lease->tenant->email }}</p>
                            <p class="mb-1"><strong>Phone:</strong> {{ $lease->tenant->phone ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-3">🔑 Landlord (Lessor)</h6>
                            <p class="mb-1"><strong>Name:</strong> {{ $lease->landlord->name }}</p>
                            <p class="mb-1"><strong>Email:</strong> {{ $lease->landlord->email }}</p>
                            <p class="mb-1"><strong>Phone:</strong> {{ $lease->landlord->phone ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Signature Status -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-light border-bottom">
                    <h5 class="mb-0">✍️ Signature Status</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="p-3 border rounded {{ $lease->tenant_signed_at ? 'border-success bg-light' : 'border-warning' }}" style="background: {{ $lease->tenant_signed_at ? 'linear-gradient(135deg, #d1fae5 0%, rgba(16, 185, 129, 0.05) 100%)' : 'linear-gradient(135deg, #fef3c7 0%, rgba(245, 158, 11, 0.05) 100%)' }};">
                                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                                    <span style="font-size: 1.5rem;">{{ $lease->tenant_signed_at ? '✅' : '⏳' }}</span>
                                    <p class="mb-0"><strong>Tenant Signature</strong></p>
                                </div>
                                @if($lease->tenant_signed_at)
                                    <span class="badge badge-success" style="margin-bottom: 0.75rem;">✓ Signed</span>
                                    <p class="text-muted small mb-0">{{ $lease->tenant_signed_at->format('M d, Y \a\t h:i A') }}</p>
                                @else
                                    <span class="badge badge-warning" style="margin-bottom: 0.75rem;">Pending</span>
                                    <p class="text-muted small mb-0">Awaiting your signature</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded {{ $lease->landlord_signed_at ? 'border-success bg-light' : 'border-warning' }}" style="background: {{ $lease->landlord_signed_at ? 'linear-gradient(135deg, #d1fae5 0%, rgba(16, 185, 129, 0.05) 100%)' : 'linear-gradient(135deg, #fef3c7 0%, rgba(245, 158, 11, 0.05) 100%)' }};">
                                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                                    <span style="font-size: 1.5rem;">{{ $lease->landlord_signed_at ? '✅' : '⏳' }}</span>
                                    <p class="mb-0"><strong>Landlord Signature</strong></p>
                                </div>
                                @if($lease->landlord_signed_at)
                                    <span class="badge badge-success" style="margin-bottom: 0.75rem;">✓ Signed</span>
                                    <p class="text-muted small mb-0">{{ $lease->landlord_signed_at->format('M d, Y \a\t h:i A') }}</p>
                                @else
                                    <span class="badge badge-warning" style="margin-bottom: 0.75rem;">Pending</span>
                                    <p class="text-muted small mb-0">Awaiting landlord signature</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            @if(!$lease->tenant_signed_at && $lease->status !== 'cancelled')
                            <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#signModal" style="font-size: 1rem; padding: 1rem 2rem;">
                                ✍️ Sign Agreement
                            </button>
                            @elseif($lease->tenant_signed_at)
                            <button class="btn btn-success btn-lg btn-block" disabled style="font-size: 1rem; padding: 1rem 2rem;">
                                ✓✓ You Signed This Agreement
                            </button>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('lease-agreements.print', $lease->id) }}" target="_blank" class="btn btn-outline-primary btn-lg btn-block" style="font-size: 1rem; padding: 1rem 2rem;">
                                🖨️ Print / Download PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sign Modal -->
<div class="modal fade" id="signModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">✍️ Sign Lease Agreement</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <strong>⚠️ Important:</strong> By clicking "I Agree," you confirm that you have read, understood, and agree to all terms and conditions of this lease agreement.
                </div>
                
                <div class="custom-control custom-checkbox mb-4">
                    <input type="checkbox" class="custom-control-input" id="agreeCheckbox">
                    <label class="custom-control-label" for="agreeCheckbox">
                        I have read and understood the lease agreement terms and conditions
                    </label>
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="acceptCheckbox">
                    <label class="custom-control-label" for="acceptCheckbox">
                        I agree to all terms and conditions stated in this lease agreement
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="signBtn" style="opacity: 0.6; cursor: not-allowed;" disabled>
                    I Agree & Sign
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<!-- Add Bootstrap and jQuery for modal functionality -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
console.log('Script loaded - Setting up lease agreement signing');

function updateSignBtn() {
    const agreeCheckbox = document.getElementById('agreeCheckbox');
    const acceptCheckbox = document.getElementById('acceptCheckbox');
    const signBtn = document.getElementById('signBtn');
    
    if (!agreeCheckbox || !acceptCheckbox || !signBtn) {
        console.warn('Elements not found');
        return;
    }
    
    const bothChecked = agreeCheckbox.checked && acceptCheckbox.checked;
    console.log('Checkboxes:', { agree: agreeCheckbox.checked, accept: acceptCheckbox.checked });
    
    if (bothChecked) {
        signBtn.disabled = false;
        signBtn.style.opacity = '1';
        signBtn.style.cursor = 'pointer';
        console.log('Button ENABLED');
    } else {
        signBtn.disabled = true;
        signBtn.style.opacity = '0.6';
        signBtn.style.cursor = 'not-allowed';
        console.log('Button DISABLED');
    }
}

// Wait for DOM and jQuery to be ready
$(document).ready(function() {
    console.log('DOM ready, setting up event listeners');
    
    // Listen for checkbox changes
    $('#agreeCheckbox, #acceptCheckbox').on('change click', function() {
        console.log('Checkbox changed:', this.id, this.checked);
        updateSignBtn();
    });
    
    // When modal opens, reset
    $('#signModal').on('shown.bs.modal', function() {
        console.log('Modal opened');
        $('#agreeCheckbox').prop('checked', false);
        $('#acceptCheckbox').prop('checked', false);
        updateSignBtn();
    });
    
    // Sign button click handler
    $('#signBtn').on('click', function(e) {
        e.preventDefault();
        signAgreement();
    });
});

function signAgreement() {
    console.log('Sign agreement called');
    
    const btn = document.getElementById('signBtn');
    const agreeCheckbox = document.getElementById('agreeCheckbox');
    const acceptCheckbox = document.getElementById('acceptCheckbox');
    
    if (!btn) {
        console.error('Sign button not found');
        alert('Error: Button not found');
        return;
    }
    
    // Check both boxes are checked
    if (!agreeCheckbox || !agreeCheckbox.checked || !acceptCheckbox || !acceptCheckbox.checked) {
        alert('Please check both boxes before signing');
        return;
    }
    
    console.log('Proceeding with signing...');
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm mr-2"></span>Processing...';

    const routeUrl = '{{ route("lease-agreements.sign-tenant", $lease->id) }}';
    console.log('Route URL:', routeUrl);
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
        console.error('CSRF token not found');
        alert('Error: CSRF token missing');
        btn.disabled = false;
        btn.innerHTML = 'I Agree & Sign';
        return;
    }
    
    console.log('Sending request...');
    fetch(routeUrl, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({})
    })
    .then(response => {
        console.log('Response received:', response.status, response.statusText);
        if (!response.ok) {
            throw new Error('HTTP error ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        console.log('Server response:', data);
        if (data.success) {
            $('#signModal').modal('hide');
            alert(data.message || 'Agreement signed successfully!');
            console.log('Reloading page...');
            setTimeout(() => window.location.reload(), 1000);
        } else {
            throw new Error(data.message || 'Failed to sign agreement');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error signing agreement: ' + error.message);
        btn.disabled = false;
        btn.innerHTML = 'I Agree & Sign';
    });
}
</script>
@endsection