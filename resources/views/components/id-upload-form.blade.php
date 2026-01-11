<div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">
            <i class="fas fa-id-card mr-2"></i>
            Government-Issued ID Verification
        </h5>
    </div>

    <div class="card-body">
        <!-- Status Messages -->
        @if($user->isIdVerified())
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-2"></i>
                <strong>ID Verified!</strong> Your identity has been confirmed.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif($user->isIdPending())
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="fas fa-hourglass-half mr-2"></i>
                <strong>Pending Review</strong> Your ID is being verified. This usually takes 24-48 hours.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif($user->isIdRejected())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                <strong>ID Rejected</strong> {{ $user->getIdRejectionReason() ?? 'Please resubmit a clearer image.' }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Upload Form (show only if not verified or rejected) -->
        @if(!$user->isIdVerified())
            <form action="{{ route('user.upload-id') }}" method="POST" enctype="multipart/form-data" id="idUploadForm">
                @csrf

                <!-- ID Type Selection -->
                <div class="form-group">
                    <label for="id_type" class="font-weight-bold">
                        <i class="fas fa-list mr-2"></i>Type of ID
                    </label>
                    <select class="form-control @error('id_type') is-invalid @enderror" 
                            id="id_type" 
                            name="id_type"
                            required>
                        <option value="">-- Select ID Type --</option>
                        <option value="passport" {{ old('id_type') === 'passport' ? 'selected' : '' }}>
                            🛂 Passport
                        </option>
                        <option value="drivers_license" {{ old('id_type') === 'drivers_license' ? 'selected' : '' }}>
                            🚗 Driver's License
                        </option>
                        <option value="national_id" {{ old('id_type') === 'national_id' ? 'selected' : '' }}>
                            📋 National ID Card
                        </option>
                        <option value="residence_permit" {{ old('id_type') === 'residence_permit' ? 'selected' : '' }}>
                            🏠 Residence Permit
                        </option>
                    </select>
                    @error('id_type')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- ID Number -->
                <div class="form-group">
                    <label for="id_number" class="font-weight-bold">
                        <i class="fas fa-barcode mr-2"></i>ID Number
                    </label>
                    <input type="text" 
                           class="form-control @error('id_number') is-invalid @enderror" 
                           id="id_number" 
                           name="id_number"
                           placeholder="Enter your ID number"
                           value="{{ old('id_number') }}"
                           required>
                    <small class="form-text text-muted">As shown on your ID document</small>
                    @error('id_number')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Full Name on ID -->
                <div class="form-group">
                    <label for="full_name_on_id" class="font-weight-bold">
                        <i class="fas fa-user mr-2"></i>Full Name on ID
                    </label>
                    <input type="text" 
                           class="form-control @error('full_name_on_id') is-invalid @enderror" 
                           id="full_name_on_id" 
                           name="full_name_on_id"
                           placeholder="Your full name as it appears on ID"
                           value="{{ old('full_name_on_id') }}"
                           required>
                    <small class="form-text text-muted">Must match exactly with your ID document</small>
                    @error('full_name_on_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- ID Expiry Date -->
                <div class="form-group">
                    <label for="id_expiry_date" class="font-weight-bold">
                        <i class="fas fa-calendar-alt mr-2"></i>ID Expiry Date
                    </label>
                    <input type="date" 
                           class="form-control @error('id_expiry_date') is-invalid @enderror" 
                           id="id_expiry_date" 
                           name="id_expiry_date"
                           value="{{ old('id_expiry_date') }}"
                           required>
                    <small class="form-text text-muted">Your ID must not be expired</small>
                    @error('id_expiry_date')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Document Upload -->
                <div class="form-group">
                    <label for="id_document" class="font-weight-bold">
                        <i class="fas fa-file-upload mr-2"></i>Upload ID Document
                    </label>
                    <div class="custom-file">
                        <input type="file" 
                               class="custom-file-input @error('id_document') is-invalid @enderror" 
                               id="id_document" 
                               name="id_document"
                               accept=".pdf,.jpg,.jpeg,.png"
                               required>
                        <label class="custom-file-label" for="id_document">
                            Choose file (PDF, JPG, PNG - Max 5MB)
                        </label>
                        @error('id_document')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <small class="form-text text-muted d-block mt-2">
                        <i class="fas fa-lightbulb text-warning mr-1"></i>
                        <strong>Tips for best results:</strong>
                        <ul class="mb-0 mt-1">
                            <li>Use a clear, well-lit photo</li>
                            <li>Ensure all corners of the ID are visible</li>
                            <li>File size must not exceed 5MB</li>
                            <li>Accepted formats: PDF, JPG, PNG</li>
                        </ul>
                    </small>
                </div>

                <!-- Confirmation Checkbox -->
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" 
                               class="custom-control-input @error('confirm_id_details') is-invalid @enderror" 
                               id="confirm_id_details" 
                               name="confirm_id_details"
                               value="true">
                        <label class="custom-control-label" for="confirm_id_details">
                            I confirm that the information provided is accurate and the ID document is valid
                        </label>
                        @error('confirm_id_details')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Privacy Notice -->
                <div class="alert alert-light border" role="alert">
                    <i class="fas fa-lock text-success mr-2"></i>
                    <strong>Your Privacy is Protected</strong><br>
                    Your ID document is securely stored and only visible to our verification team. 
                    It will never be shared with other users.
                </div>

                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-lg" id="submitBtn">
                        <i class="fas fa-cloud-upload-alt mr-2"></i>Upload and Verify ID
                    </button>
                </div>
            </form>
        @else
            <!-- Verified State -->
            <div class="text-center py-4">
                <div class="mb-3">
                    <i class="fas fa-check-circle text-success" style="font-size: 3rem;"></i>
                </div>
                <h5 class="text-success mb-2">ID Verification Complete</h5>
                <p class="text-muted">Your identity has been verified. You can now sign lease agreements and access all features.</p>

                @if($user->getDaysUntilIdExpiry() && $user->getDaysUntilIdExpiry() < 60)
                    <div class="alert alert-warning mt-3">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Your ID expires in {{ $user->getDaysUntilIdExpiry() }} days. 
                        You may need to resubmit when it expires.
                    </div>
                @endif

                <div class="mt-4 text-muted">
                    <small>
                        <strong>Verified on:</strong> {{ $user->userDetails->id_verified_at ? $user->userDetails->id_verified_at->format('M d, Y') : 'N/A' }}<br>
                        <strong>ID Type:</strong> {{ ucfirst(str_replace('_', ' ', $user->userDetails->id_type ?? 'N/A')) }}<br>
                        <strong>Expires:</strong> {{ $user->userDetails->id_expiry_date ? \Carbon\Carbon::parse($user->userDetails->id_expiry_date)->format('M d, Y') : 'N/A' }}
                    </small>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
// Update file input label with selected filename
document.getElementById('id_document').addEventListener('change', function(e) {
    const fileName = e.target.files[0]?.name || 'Choose file (PDF, JPG, PNG - Max 5MB)';
    const label = this.nextElementSibling;
    label.textContent = fileName;
});

// Add submit handler for better UX
document.getElementById('idUploadForm')?.addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Uploading...';
    }
});
</script>

<style>
#id_document::-webkit-file-upload-button {
    display: none;
}

.custom-file-label::after {
    content: "Browse";
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}
</style>
