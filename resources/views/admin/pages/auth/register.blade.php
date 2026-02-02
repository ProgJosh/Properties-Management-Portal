
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Landlords Register</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href= {{asset('frontend\assets/images/logo/system-logo.png')}}>

        <!-- App css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/icons.min.css" rel="stylesheet')}}" type="text/css" />
        <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- Font Awesome for Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

        <style>
            /* Form Styling */
            .form-group label {
                font-weight: 500;
                color: #4a5568;
                margin-bottom: 8px;
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .form-control {
                border: 1px solid #d1d5db;
                border-radius: 8px;
                padding: 12px 15px;
                font-size: 14px;
                transition: all 0.3s ease;
                background-color: #ffffff;
                color: #1f2937;
            }

            .form-control:focus {
                border-color: #6b7280;
                background-color: #fff;
                box-shadow: 0 0 0 3px rgba(107, 114, 128, 0.1);
                outline: none;
                color: #111827;
            }

            .form-control::placeholder {
                color: #9ca3af;
                opacity: 1;
            }

            /* ID Verification Section */
            .id-verification-section {
                background: #f9fafb;
                border: 1px solid #e5e7eb;
                border-radius: 12px;
                padding: 25px;
                margin-top: 30px;
                margin-bottom: 20px;
            }

            .id-verification-section h5 {
                color: #374151;
                font-weight: 600;
                margin-bottom: 20px;
                font-size: 17px;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .id-verification-section h5 i {
                font-size: 22px;
                color: #6b7280;
            }

            /* File Upload Styling */
            .file-upload-wrapper {
                position: relative;
                overflow: hidden;
            }

            .file-upload-wrapper input[type="file"] {
                position: absolute;
                left: -9999px;
            }

            .file-upload-label {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                background-color: #ffffff;
                border: 2px dashed #9ca3af;
                border-radius: 8px;
                padding: 20px;
                cursor: pointer;
                transition: all 0.3s ease;
                color: #6b7280;
                font-weight: 500;
            }

            .file-upload-label:hover {
                background-color: #f9fafb;
                border-color: #6b7280;
                color: #4b5563;
            }

            .file-upload-label i {
                font-size: 24px;
            }

            /* Checkbox Styling */
            .custom-checkbox {
                display: flex;
                align-items: flex-start;
                gap: 10px;
                margin-top: 15px;
            }

            .custom-checkbox input[type="checkbox"] {
                margin-top: 3px;
                cursor: pointer;
                width: 18px;
                height: 18px;
                accent-color: #6b7280;
            }

            .custom-checkbox label {
                margin: 0;
                font-weight: 400;
                color: #4b5563;
                cursor: pointer;
                font-size: 14px;
            }

            /* Privacy Notice */
            .privacy-notice {
                background: #f0f9ff;
                border-left: 3px solid #6b7280;
                border-radius: 6px;
                padding: 15px 20px;
                margin-top: 20px;
                color: #374151;
                font-size: 13px;
            }

            .privacy-notice i {
                color: #6b7280;
                margin-right: 8px;
                font-size: 16px;
            }

            .privacy-notice strong {
                color: #374151;
                display: block;
                margin-bottom: 5px;
            }

            /* Error Messages */
            .text-danger {
                color: #dc2626 !important;
                font-size: 13px;
                margin-top: 5px;
                display: flex;
                align-items: center;
                gap: 5px;
            }

            .text-danger::before {
                content: "⚠ ";
                font-weight: bold;
            }

            /* Button Styling */
            .btn-gradient {
                background: #4b5563;
                border: none;
                font-weight: 500;
                padding: 12px 30px;
                border-radius: 8px;
                transition: all 0.3s ease;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                color: #ffffff;
            }

            .btn-gradient:hover {
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(75, 85, 99, 0.3);
                background: #374151;
                color: #fff;
            }

            .btn-gradient:active {
                transform: translateY(0);
            }

            /* Input Focus States */
            .form-control:invalid {
                border-color: #ef4444;
            }

            .form-control:valid {
                border-color: #10b981;
            }

            /* Select Dropdown */
            select.form-control {
                appearance: none;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
                background-repeat: no-repeat;
                background-position: right 12px center;
                padding-right: 35px;
                line-height: 1.5;
                height: auto;
                min-height: 46px;
            }

            select.form-control option {
                color: #1f2937;
                padding: 10px;
                line-height: normal;
            }

            select.form-control option:first-child {
                color: #9ca3af;
            }

            select.form-control:invalid {
                color: #9ca3af;
            }

            select.form-control:valid {
                color: #1f2937;
            }

            /* Date Input */
            input[type="date"] {
                position: relative;
            }

            input[type="date"]::-webkit-calendar-picker-indicator {
                cursor: pointer;
            }

            /* Password Toggle */
            .password-wrapper {
                position: relative;
            }

            .password-toggle {
                position: absolute;
                right: 12px;
                top: 50%;
                transform: translateY(-50%);
                background: none;
                border: none;
                color: #6b7280;
                cursor: pointer;
                padding: 5px;
                font-size: 18px;
                transition: color 0.3s ease;
            }

            .password-toggle:hover {
                color: #374151;
            }

            .password-toggle:focus {
                outline: none;
            }

            .password-wrapper .form-control {
                padding-right: 45px;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .id-verification-section {
                    padding: 20px;
                }

                .form-group label {
                    font-size: 14px;
                }

                .file-upload-label {
                    padding: 15px;
                    font-size: 13px;
                }
            }

            /* Form Section Divider */
            .form-section-divider {
                height: 1px;
                background: #e5e7eb;
                margin: 25px 0;
            }

            /* Success State */
            .form-control.is-valid {
                border-color: #10b981;
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Cpath fill='%2310b981' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4.6 5.05c-.5.5-1.2.5-1.8-.1z'/%3E%3C/svg%3E");
                background-repeat: no-repeat;
                background-position: right 12px center;
                background-size: 16px 16px;
                padding-right: 38px;
            }

            /* Loading State */
            .btn-gradient:disabled {
                opacity: 0.6;
                cursor: not-allowed;
            }

            .spinner-border {
                display: inline-block;
                margin-right: 8px;
            }

            /* File Upload Display */
            .file-upload-display {
                display: none !important;
                margin-top: 15px;
                padding: 15px;
                background-color: #f0fdf4;
                border: 1px solid #86efac;
                border-radius: 8px;
                align-items: center;
                justify-content: space-between;
                gap: 10px;
            }

            .file-upload-display.show {
                display: flex !important;
                visibility: visible !important;
            }

            .file-info {
                display: flex;
                align-items: center;
                gap: 10px;
                flex: 1;
            }

            .file-info i {
                color: #10b981;
                font-size: 20px;
            }

            .file-name {
                color: #374151;
                font-weight: 500;
                word-break: break-all;
                max-width: 100%;
            }

            .file-size {
                color: #6b7280;
                font-size: 12px;
                margin-top: 4px;
            }

            .btn-remove-file {
                background-color: #ef4444 !important;
                color: white !important;
                border: none !important;
                border-radius: 6px !important;
                padding: 8px 12px !important;
                cursor: pointer !important;
                font-size: 14px !important;
                transition: all 0.3s ease !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                gap: 5px !important;
                white-space: nowrap !important;
                flex-shrink: 0 !important;
                visibility: visible !important;
                opacity: 1 !important;
                min-width: 80px !important;
                height: auto !important;
                text-decoration: none !important;
            }

            .btn-remove-file:hover {
                background-color: #dc2626 !important;
                transform: scale(1.02) !important;
            }

            .btn-remove-file:focus {
                outline: none !important;
                box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2) !important;
            }

            .btn-remove-file:active {
                background-color: #b91c1c !important;
            }

            .btn-remove-file i {
                font-size: 16px !important;
                pointer-events: none !important;
            }

            @media (max-width: 576px) {
                .file-upload-display {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .file-info {
                    width: 100%;
                }

                .btn-remove-file {
                    width: 100%;
                    justify-content: center;
                    margin-top: 10px;
                }
            }
        </style>

    </head>

    <body class="authentication-bg bg-gradient">

        <script>
            // Immediate execution - no setTimeout, no DOMContentLoaded
            console.log('=== FILE UPLOAD SCRIPT STARTING ===');
            
            var attempts = 0;
            var maxAttempts = 20;
            
            function trySetup() {
                attempts++;
                console.log('Setup attempt:', attempts);
                
                var fileInput = document.getElementById('id_document');
                
                if (!fileInput) {
                    console.log('fileInput not found yet, retrying...');
                    if (attempts < maxAttempts) {
                        setTimeout(trySetup, 100);
                    }
                    return;
                }
                
                console.log('fileInput FOUND! Setting up...');
                
                var fileUploadDisplay = document.getElementById('fileUploadDisplay');
                var selectedFileName = document.getElementById('selectedFileName');
                var selectedFileSize = document.getElementById('selectedFileSize');
                var removeFileBtn = document.getElementById('removeFileBtn');
                var fileLabel = document.getElementById('fileLabel');
                
                function formatFileSize(bytes) {
                    if (bytes === 0) return '0 Bytes';
                    var k = 1024;
                    var sizes = ['Bytes', 'KB', 'MB'];
                    var i = Math.floor(Math.log(bytes) / Math.log(k));
                    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
                }
                
                function handleFileSelect() {
                    console.log('FILE CHANGED - Files count:', fileInput.files.length);
                    if (fileInput.files && fileInput.files.length > 0) {
                        var file = fileInput.files[0];
                        console.log('File selected:', file.name, 'Size:', file.size, 'Type:', file.type);
                        
                        // Validate file type
                        var validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
                        if (!validTypes.includes(file.type)) {
                            alert('Please select a valid file format (PDF, JPG, JPEG, or PNG)');
                            fileInput.value = '';
                            return;
                        }
                        
                        // Validate file size (5MB = 5242880 bytes)
                        if (file.size > 5242880) {
                            alert('File size must not exceed 5MB');
                            fileInput.value = '';
                            return;
                        }
                        
                        selectedFileName.textContent = file.name;
                        selectedFileSize.textContent = formatFileSize(file.size);
                        fileUploadDisplay.style.display = 'flex';
                        fileUploadDisplay.classList.add('show');
                        console.log('Display updated successfully');
                    } else {
                        console.log('No files selected');
                    }
                }
                
                // Add change event listener
                fileInput.addEventListener('change', handleFileSelect);
                
                // Add click handler for remove button
                if (removeFileBtn) {
                    removeFileBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        console.log('REMOVE CLICKED');
                        fileInput.value = '';
                        fileUploadDisplay.style.display = 'none';
                        fileUploadDisplay.classList.remove('show');
                    });
                }
                
                console.log('=== SETUP COMPLETE ===');
            }
            
            trySetup();

            // Password Toggle Functionality
            document.addEventListener('DOMContentLoaded', function() {
                var togglePassword = document.getElementById('togglePassword');
                var passwordInput = document.getElementById('password');
                var toggleIcon = document.getElementById('toggleIcon');
                
                if (togglePassword && passwordInput && toggleIcon) {
                    togglePassword.addEventListener('click', function() {
                        // Toggle password visibility
                        if (passwordInput.type === 'password') {
                            passwordInput.type = 'text';
                            toggleIcon.classList.remove('fa-eye');
                            toggleIcon.classList.add('fa-eye-slash');
                        } else {
                            passwordInput.type = 'password';
                            toggleIcon.classList.remove('fa-eye-slash');
                            toggleIcon.classList.add('fa-eye');
                        }
                    });
                }

                // Auto-refresh CSRF token every 10 minutes to prevent expiration
                setInterval(function() {
                    fetch('{{ route("admin.register") }}', {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }).then(function(response) {
                        return response.text();
                    }).then(function(html) {
                        var parser = new DOMParser();
                        var doc = parser.parseFromString(html, 'text/html');
                        var newToken = doc.querySelector('input[name="_token"]');
                        if (newToken) {
                            var currentToken = document.querySelector('input[name="_token"]');
                            if (currentToken) {
                                currentToken.value = newToken.value;
                                console.log('CSRF token refreshed successfully');
                            }
                        }
                    }).catch(function(error) {
                        console.error('Failed to refresh CSRF token:', error);
                    });
                }, 600000); // Refresh every 10 minutes (600000 ms)
                
                // REGISTRATION FLOW: Register Button → Terms Modal → Commission Modal → Submit
                var registerBtn = document.getElementById('registerBtn');
                var registrationForm = document.getElementById('registrationForm');
                var termsModalShown = false;
                var commissionModalShown = false;
                
                if (registerBtn && registrationForm) {
                    registerBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        console.log('Register button clicked - starting modal flow');
                        
                        // Validate form first
                        if (!registrationForm.checkValidity()) {
                            registrationForm.reportValidity();
                            return false;
                        }
                        
                        // Show Terms Modal first
                        if (typeof openTermsModal === 'function') {
                            openTermsModal();
                        } else {
                            var modal = document.getElementById('landlordTermsModal');
                            if (modal) {
                                modal.style.display = 'flex';
                            }
                        }
                    });
                }
                
                // Override the modal proceed buttons to chain them
                document.addEventListener('termsAccepted', function() {
                    console.log('Terms accepted, showing commission modal');
                    if (typeof openCommissionModal === 'function') {
                        openCommissionModal();
                    } else {
                        var modal = document.getElementById('commissionPolicyModal');
                        if (modal) {
                            modal.style.display = 'flex';
                        }
                    }
                });
                
                document.addEventListener('commissionAccepted', function() {
                    console.log('Commission accepted, submitting form');
                    // Mark checkboxes as checked
                    var acceptTerms = document.getElementById('acceptTerms');
                    var confirmIdDetails = document.getElementById('confirm_id_details');
                    if (acceptTerms) acceptTerms.checked = true;
                    if (confirmIdDetails) confirmIdDetails.checked = true;
                    
                    // Submit the form
                    registrationForm.submit();
                });
                
                // Open Terms Modal when link is clicked (view only)
                var viewTermsLink = document.getElementById('viewTermsLink');
                if (viewTermsLink) {
                    viewTermsLink.addEventListener('click', function(e) {
                        e.preventDefault();
                        if (typeof openTermsModal === 'function') {
                            openTermsModal();
                        } else {
                            var modal = document.getElementById('landlordTermsModal');
                            if (modal) {
                                modal.style.display = 'flex';
                            }
                        }
                    });
                }
                
                // Open Commission Modal when link is clicked (view only)
                var viewCommissionLink = document.getElementById('viewCommissionLink');
                if (viewCommissionLink) {
                    viewCommissionLink.addEventListener('click', function(e) {
                        e.preventDefault();
                        if (typeof openCommissionModal === 'function') {
                            openCommissionModal();
                        } else {
                            var modal = document.getElementById('commissionPolicyModal');
                            if (modal) {
                                modal.style.display = 'flex';
                            }
                        }
                    });
                }
            });
        </script>
            @include('components.landlord-terms-modal')
            @include('components.commission-policy-modal')

            <div class="account-pages mt-2 pt-2 mb-5">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-8 col-xl-8">
                            <div class="card bg-pattern">
    
                                <div class="card-body p-4">
                                    
                                    <div class="text-center w-75 m-auto">
                                        <a href="">
                                            <span><img src="{{asset('frontend/assets/images/logo/system-logo.png')}}" alt="" width="80"></span>
                                        </a>
                                        <h5 class="text-uppercase text-center font-bold mt-4">Landlords Register</h5>

                                    </div>
    
                                    <form id="registrationForm" action="{{route('admin.register')}}" method="POST" enctype="multipart/form-data">

                                        @csrf
                                        <div class="form-group mb-3">
                                            <label for="name"><i class="fas fa-user"></i>Name</label>
                                            <input class="form-control" type="text" id="name" name="name" value="{{old('name')}}" required="" placeholder="Enter your Name">

                                            @error('name')
                                                <span class="text-danger">{{$message}}</span>
                                                
                                            @enderror


                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="business_name"><i class="fas fa-building"></i>Name of Business</label>
                                            <input class="form-control" type="text" id="business_name" name="business_name" value="{{old('business_name')}}" placeholder="Enter your Business Name (Optional)">

                                            @error('business_name')
                                                <span class="text-danger">{{$message}}</span>
                                                
                                            @enderror


                                        </div>

    
                                        <div class="form-group mb-3">
                                            <label for="emailaddress"><i class="fas fa-envelope"></i>Email address</label>
                                            <input class="form-control" type="email" id="emailaddress" name="email" value="{{old('email')}}" required="" placeholder="Enter your email">

                                            @error('email')
                                                <span class="text-danger">{{$message}}</span>
                                                
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="phone"><i class="fas fa-phone-alt"></i>Phone</label>
                                            <input class="form-control" type="tel" id="phone" name="phone" value="{{old('phone')}}" required="" placeholder="Enter your phone">

                                            @error('phone')
                                                <span class="text-danger">{{$message}}</span>
                                                
                                            @enderror


                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="gender"><i class="fas fa-venus-mars"></i>Gender</label>
                                            <select class="form-control" id="gender" value="{{old('gender')}}" name="gender" required="">
                                                <option value="">Select Gender</option>
                                                <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                                                <option value="other" {{ old('gender') === 'other' ? 'selected' : '' }}>Other</option>
                                            </select>


                                            @error('gender')
                                                <span class="text-danger">{{$message}}</span>
                                                
                                            @enderror


                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="dob"><i class="fas fa-birthday-cake"></i>Date of Birth</label>
                                            <input class="form-control" type="date" id="dob" name="dob" value="{{old('dob')}}" required="">


                                            @error('dob')   
                                                <span class="text-danger">{{$message}}</span>

                                            @enderror


                                        </div>

                                        <div class="form-section-divider"></div>

                                        <!-- ID Verification Section -->
                                        <div class="id-verification-section">
                                            <h5><i class="fas fa-id-card"></i>Government-Issued ID Verification</h5>

                                            <div class="form-group mb-3">
                                                <label for="id_type"><i class="fas fa-list"></i>Type of ID</label>
                                                <select class="form-control" id="id_type" name="id_type" required="">
                                                    <option value="">-- Select ID Type --</option>
                                                    <option value="passport" {{ old('id_type') === 'passport' ? 'selected' : '' }}>🛂 Passport</option>
                                                    <option value="drivers_license" {{ old('id_type') === 'drivers_license' ? 'selected' : '' }}>🚗 Driver's License</option>
                                                    <option value="national_id" {{ old('id_type') === 'national_id' ? 'selected' : '' }}>📋 National ID Card</option>
                                                    <option value="residence_permit" {{ old('id_type') === 'residence_permit' ? 'selected' : '' }}>🏠 Residence Permit</option>
                                                </select>
                                                @error('id_type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="id_number"><i class="fas fa-barcode"></i>ID Number</label>
                                                <input class="form-control" type="text" id="id_number" name="id_number" placeholder="Enter your ID number" value="{{old('id_number')}}" required="">
                                                <small class="form-text text-muted">As shown on your ID document</small>
                                                @error('id_number')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="full_name_on_id"><i class="fas fa-user"></i>Full Name on ID</label>
                                                <input class="form-control" type="text" id="full_name_on_id" name="full_name_on_id" placeholder="As it appears on your ID" value="{{old('full_name_on_id')}}" required="">
                                                <small class="form-text text-muted">Must match exactly with your ID document</small>
                                                @error('full_name_on_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="id_expiry_date"><i class="fas fa-calendar-alt"></i>ID Expiry Date</label>
                                                <input class="form-control" type="date" id="id_expiry_date" name="id_expiry_date" value="{{old('id_expiry_date')}}" required="">
                                                <small class="form-text text-muted">Your ID must not be expired</small>
                                                @error('id_expiry_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="id_document"><i class="fas fa-file-upload"></i>Upload ID Document</label>
                                                <div class="file-upload-wrapper">
                                                    <input type="file" id="id_document" name="id_document" accept=".pdf,.jpg,.jpeg,.png" required="">
                                                    <label for="id_document" class="file-upload-label">
                                                        <i class="fas fa-cloud-upload-alt"></i>
                                                        <span id="fileLabel">Choose File or Drag & Drop</span>
                                                    </label>
                                                </div>

                                                <!-- File Upload Display -->
                                                <div id="fileUploadDisplay" class="file-upload-display" style="display: none !important;">
                                                    <div class="file-info">
                                                        <i class="fas fa-file"></i>
                                                        <div>
                                                            <div class="file-name" id="selectedFileName"></div>
                                                            <div class="file-size" id="selectedFileSize"></div>
                                                        </div>
                                                    </div>
                                                    <button type="button" id="removeFileBtn" style="background-color: #dc3545 !important; color: white !important; border: none !important; border-radius: 4px !important; padding: 8px 12px !important; cursor: pointer !important; font-size: 14px !important; transition: all 0.3s ease !important; display: flex !important; align-items: center !important; justify-content: center !important; gap: 5px !important; white-space: nowrap !important; flex-shrink: 0 !important;">
                                                        <i class="fas fa-times" style="font-size: 16px !important; pointer-events: none !important;"></i>
                                                        Remove
                                                    </button>
                                                </div>

                                                <small class="form-text text-muted d-block mt-2">
                                                    <i class="fas fa-info-circle"></i> Accepted formats: PDF, JPG, PNG | Max size: 5MB
                                                </small>
                                                @error('id_document')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="custom-checkbox">
                                                <input type="checkbox" id="confirm_id_details" name="confirm_id_details" required="">
                                                <label for="confirm_id_details">
                                                    I confirm that the information provided is accurate and the ID document is valid
                                                </label>
                                            </div>

                                            @error('confirm_id_details')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            <div class="privacy-notice">
                                                <i class="fas fa-lock"></i>
                                                <strong>Your Privacy is Protected</strong><br>
                                                Your ID document is securely stored and only visible to our verification team. It will never be shared with other users.
                                            </div>
                                        </div>

                                        <div class="form-section-divider"></div>

                                        <div class="form-group mb-3">
                                            <label for="password"><i class="fas fa-lock"></i>Password</label>
                                            <div class="password-wrapper">
                                                <input class="form-control" type="password" required="" id="password" name="password" placeholder="Enter your password">
                                                <button type="button" class="password-toggle" id="togglePassword">
                                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                                </button>
                                            </div>

                                            @error('password')
                                                <span class="text-danger">{{$message}}</span>
                                                
                                            @enderror
                                        </div>

                                        <div class="form-section-divider"></div>

                                        <!-- Terms and Conditions Acceptance -->
                                        <div class="form-group mb-3" style="display: none;">
                                            <div class="custom-checkbox">
                                                <input type="checkbox" id="acceptTerms" name="accept_terms" value="1">
                                                <label for="acceptTerms">
                                                    I agree to the Terms of Use and Commission Policy
                                                </label>
                                            </div>
                                            @error('accept_terms')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
    
                                        <div class="form-group mb-0 text-center">
                                            <button class="btn btn-gradient btn-block" type="submit" id="registerBtn"> Register </button>
                                        </div>
    
                                    </form>
    
                                    <div class="row mt-4">
                                            <div class="col-sm-12 text-center">
                                                <p class="text-muted mb-0">Already have an account? <a href="{{route('admin.login')}}" class="text-dark ml-1"><b>Sign in</b></a></p>
                                            </div>
                                        </div>

    
                                </div> <!-- end card-body -->
                            </div>
                            <!-- end card -->
    
                       
    
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
            <!-- end page -->


        <!-- Admin Warning Notice Modal -->
        <x-admin-warning-notice />

        <!-- Vendor js -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/app.min.js') }}"></script>

        <!-- Trigger Warning Modal on Page Load -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Show the warning modal when the page loads
                if (typeof openWarningModal === 'function') {
                    openWarningModal();
                }
            });
        </script>
        
    </body>
</html>