@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/lease-agreement.css') }}?v={{ time() }}">
@endpush

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Agreement Header -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <h1 class="mb-2">📋 Lease Agreement</h1>
                    <p class="text-muted mb-1">Agreement ID: <strong>#{{ $lease->id }}</strong></p>
                    <p class="text-muted mb-0" style="margin-top: 1rem;">
                        <span class="badge badge-{{ $lease->status === 'pending_signature' ? 'warning' : ($lease->status === 'active_lease' ? 'success' : 'secondary') }}">
                            {{ str_replace('_', ' ', ucfirst($lease->status)) }}
                        </span>
                    </p>
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
                                {{ $lease->getDurationInMonths() }} months
                                <br>
                                <small>({{ $lease->start_date->format('M d') }} - {{ $lease->end_date->format('M d, Y') }})</small>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><strong>📊 Status:</strong></p>
                            <p>
                                @if($lease->isActive())
                                    <span class="badge badge-success">✓ Active Agreement</span>
                                    <small class="d-block text-muted mt-2">Days Remaining: <strong>{{ $lease->end_date->diffInDays(now()) }}</strong></small>
                                @elseif($lease->isCompleted())
                                    <span class="badge badge-secondary">Expired</span>
                                @else
                                    <span class="badge badge-warning">Upcoming</span>
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
                                <p style="font-size: 1.75rem; font-weight: 700; color: var(--warning-color);">₱{{ number_format($lease->deposit_amount ?? 0, 2) }}</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-2"><strong>Lease Duration:</strong></p>
                            <p class="text-muted" style="font-size: 1.1rem;">{{ $lease->getDurationInMonths() }} months</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><strong>Total Lease Amount:</strong></p>
                            <p style="font-size: 1.1rem; font-weight: 700; color: var(--primary-color);">₱{{ number_format($lease->monthly_rent * $lease->getDurationInMonths(), 2) }}</p>
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
                            <div class="p-3 border rounded {{ $lease->isSigned() ? 'border-success bg-light' : 'border-warning' }}" style="background: {{ $lease->isSigned() ? 'linear-gradient(135deg, #d1fae5 0%, rgba(16, 185, 129, 0.05) 100%)' : 'linear-gradient(135deg, #fef3c7 0%, rgba(245, 158, 11, 0.05) 100%)' }};">
                                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                                    <span style="font-size: 1.5rem;">{{ $lease->isSigned() ? '✅' : '⏳' }}</span>
                                    <p class="mb-0"><strong>Tenant Signature</strong></p>
                                </div>
                                @if($lease->isSigned())
                                    <span class="badge badge-success" style="margin-bottom: 0.75rem;">✓ Signed</span>
                                    <p class="text-muted small mb-0">{{ $lease->tenant_signed_at?->format('M d, Y \a\t h:i A') }}</p>
                                @else
                                    <span class="badge badge-warning" style="margin-bottom: 0.75rem;">Pending</span>
                                    <p class="text-muted small mb-0">Awaiting your signature</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded {{ $lease->status === 'active_lease' || $lease->status === 'completed' ? 'border-success bg-light' : 'border-warning' }}" style="background: {{ $lease->status === 'active_lease' || $lease->status === 'completed' ? 'linear-gradient(135deg, #d1fae5 0%, rgba(16, 185, 129, 0.05) 100%)' : 'linear-gradient(135deg, #fef3c7 0%, rgba(245, 158, 11, 0.05) 100%)' }};">
                                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                                    <span style="font-size: 1.5rem;">{{ $lease->status === 'active_lease' || $lease->status === 'completed' ? '✅' : '⏳' }}</span>
                                    <p class="mb-0"><strong>Landlord Signature</strong></p>
                                </div>
                                @if($lease->status === 'active_lease' || $lease->status === 'completed')
                                    <span class="badge badge-success" style="margin-bottom: 0.75rem;">✓ Signed</span>
                                    <p class="text-muted small mb-0">Agreement Activated</p>
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
                            @if(!$lease->isSigned() && $lease->status !== 'cancelled')
                            <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#signModal" style="font-size: 1rem; padding: 1rem 2rem;">
                                ✍️ Sign Agreement
                            </button>
                            @elseif($lease->isSigned())
                            <button class="btn btn-success btn-lg btn-block" disabled style="font-size: 1rem; padding: 1rem 2rem;">
                                ✓✓ You Signed This Agreement
                            </button>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('lease-agreements.download', $lease->id) }}" class="btn btn-outline-primary btn-lg btn-block" style="font-size: 1rem; padding: 1rem 2rem;">
                                ⬇️ Download PDF
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
<script>
console.log('Script loaded - Setting up lease agreement signing');

function updateSignBtn() {
    const agreeCheckbox = document.getElementById('agreeCheckbox');
    const acceptCheckbox = document.getElementById('acceptCheckbox');
    const signBtn = document.getElementById('signBtn');
    
    if (!agreeCheckbox || !acceptCheckbox || !signBtn) {
        console.warn('Elements not found', {
            agreeCheckbox: !!agreeCheckbox,
            acceptCheckbox: !!acceptCheckbox,
            signBtn: !!signBtn
        });
        return;
    }
    
    console.log('Checkbox states:', {
        agree: agreeCheckbox.checked,
        accept: acceptCheckbox.checked
    });
    
    const bothChecked = agreeCheckbox.checked === true && acceptCheckbox.checked === true;
    console.log('Both checked:', bothChecked);
    
    if (bothChecked) {
        signBtn.disabled = false;
        signBtn.style.opacity = '1';
        signBtn.style.cursor = 'pointer';
        signBtn.classList.remove('disabled');
        console.log('Button ENABLED');
    } else {
        signBtn.disabled = true;
        signBtn.style.opacity = '0.6';
        signBtn.style.cursor = 'not-allowed';
        signBtn.classList.add('disabled');
        console.log('Button DISABLED');
    }
}

// Listen for both click and change events on ALL inputs
document.addEventListener('click', function(e) {
    if (e.target.type === 'checkbox') {
        console.log('Checkbox clicked:', e.target.id);
        setTimeout(updateSignBtn, 50);
    }
}, true);

document.addEventListener('change', function(e) {
    if (e.target.type === 'checkbox') {
        console.log('Checkbox changed:', e.target.id);
        updateSignBtn();
    }
}, true);

// When modal opens, reset and check button state
$(document).on('shown.bs.modal', '#signModal', function() {
    console.log('Modal opened - resetting checkboxes and button');
    const agreeCheckbox = document.getElementById('agreeCheckbox');
    const acceptCheckbox = document.getElementById('acceptCheckbox');
    if (agreeCheckbox) agreeCheckbox.checked = false;
    if (acceptCheckbox) acceptCheckbox.checked = false;
    updateSignBtn();
});

// When modal closes, reset
$(document).on('hidden.bs.modal', '#signModal', function() {
    console.log('Modal closed - resetting checkboxes');
    const agreeCheckbox = document.getElementById('agreeCheckbox');
    const acceptCheckbox = document.getElementById('acceptCheckbox');
    if (agreeCheckbox) agreeCheckbox.checked = false;
    if (acceptCheckbox) acceptCheckbox.checked = false;
});

// Add click listener to sign button
const signBtn = document.getElementById('signBtn');
if (signBtn) {
    signBtn.addEventListener('click', signAgreement, false);
    console.log('Sign button listener attached');
}

function signAgreement() {
    alert('✓ Button clicked! Starting to sign agreement...');
    
    const btn = document.getElementById('signBtn');
    const agreeCheckbox = document.getElementById('agreeCheckbox');
    const acceptCheckbox = document.getElementById('acceptCheckbox');
    
    if (!btn) {
        alert('❌ Error: Sign button not found');
        return;
    }
    
    // Double check both boxes are checked
    if (!agreeCheckbox?.checked || !acceptCheckbox?.checked) {
        alert('❌ Please check both boxes before signing');
        return;
    }
    
    alert('✓ Both checkboxes verified as checked. Sending request to server...');
    
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm mr-2"></span>Processing...';

    const routeUrl = @auth('admin')'{{ route('lease-agreements.sign-landlord', $lease->id) }}'@else'{{ route('lease-agreements.sign-tenant', $lease->id) }}'@endauth;

    alert('✓ Route: ' + routeUrl);

    fetch(routeUrl, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({})
    })
    .then(response => {
        alert('✓ Response received with status: ' + response.status);
        return response.json();
    })
    .then(data => {
        alert('✓ Server response: ' + JSON.stringify(data));
        if (data.success) {
            $('#signModal').modal('hide');
            alert(data.message || 'Agreement signed successfully!');
            setTimeout(() => location.reload(), 1000);
        } else {
            alert('❌ Error: ' + (data.message || 'Failed to sign agreement'));
            btn.disabled = false;
            btn.innerHTML = 'I Agree & Sign';
        }
    })
    .catch(error => {
        alert('❌ Error signing agreement: ' + error.message);
        btn.disabled = false;
        btn.innerHTML = 'I Agree & Sign';
    });
}
</script>
@endsection