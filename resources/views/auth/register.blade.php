<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
        
        <div class="text-center w-75 m-auto mb-4">
            <h5 class="text-uppercase text-center font-bold">Tenant's Register</h5>
        </div>

        @error('date_of_birth')
            <div id="ageErrorAlert" class="mb-4 p-5 bg-red-100 border-2 border-red-600 rounded-lg shadow-2xl animate-pulse-slow">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-triangle text-red-600 text-3xl mt-1 mr-4 animate-bounce-slow"></i>
                    <div class="flex-1">
                        <p class="text-xl font-bold text-red-900 mb-2">⚠️ Registration Not Allowed</p>
                        <p class="text-red-800 mt-2 font-semibold text-base leading-relaxed">
                            {{ $message }}
                        </p>
                        <p class="text-red-700 mt-3 text-sm italic">
                            <i class="fas fa-info-circle mr-1"></i>
                            Please ensure you meet the age requirement before attempting to register.
                        </p>
                    </div>
                </div>
            </div>
            <style>
                @keyframes pulse-slow {
                    0%, 100% { opacity: 1; }
                    50% { opacity: 0.85; }
                }
                @keyframes bounce-slow {
                    0%, 100% { transform: translateY(0); }
                    50% { transform: translateY(-10px); }
                }
                .animate-pulse-slow {
                    animation: pulse-slow 3s ease-in-out infinite;
                }
                .animate-bounce-slow {
                    animation: bounce-slow 2s ease-in-out infinite;
                }
                #ageErrorAlert {
                    position: sticky;
                    top: 20px;
                    z-index: 1000;
                    backdrop-filter: blur(10px);
                }
            </style>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const ageError = document.getElementById('ageErrorAlert');
                    if (ageError) {
                        // Scroll to error smoothly
                        ageError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        
                        // Keep the error visible and prevent form submission
                        const form = document.querySelector('form');
                        const registerBtn = form.querySelector('button[type="submit"], x-button');
                        
                        if (registerBtn) {
                            registerBtn.addEventListener('click', function(e) {
                                if (document.getElementById('ageErrorAlert')) {
                                    e.preventDefault();
                                    ageError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                    
                                    // Flash the error
                                    ageError.style.transform = 'scale(1.02)';
                                    setTimeout(() => {
                                        ageError.style.transform = 'scale(1)';
                                    }, 300);
                                }
                            });
                        }
                    }
                });
            </script>
        @enderror

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Enter your name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Enter your email" />
            </div>

            <div class="mt-4">
                <x-label for="date_of_birth" value="{{ __('Date of Birth') }}" />
                <x-input id="date_of_birth" class="block mt-1 w-full form-input {{ $errors->has('date_of_birth') ? 'border-red-500 border-2' : '' }}" type="date" name="date_of_birth" :value="old('date_of_birth')" required />
                <p class="text-gray-500 text-xs mt-1">
                    <i class="fas fa-info-circle mr-1"></i>
                    {{ __('You must be at least 18 years old to register') }}
                </p>
                @error('date_of_birth')
                    <div class="mt-3 p-4 bg-red-100 border-2 border-red-600 rounded-lg shadow-md">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-circle text-red-700 text-xl mt-0.5 mr-3"></i>
                            <p class="text-red-900 text-base font-bold">{{ $message }}</p>
                        </div>
                    </div>
                @enderror
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <div class="password-wrapper mt-1">
                    <x-input id="password" class="block w-full pr-10" type="password" name="password" required autocomplete="new-password" placeholder="Enter your password" />
                    <button type="button" class="password-toggle" id="togglePassword">
                        <i class="fas fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <div class="password-wrapper mt-1">
                    <x-input id="password_confirmation" class="block w-full pr-10" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password" />
                    <button type="button" class="password-toggle" id="togglePasswordConfirm">
                        <i class="fas fa-eye" id="toggleIconConfirm"></i>
                    </button>
                </div>
            </div>

            <!-- Government-Issued ID Upload (Required for Registration) -->
            <div class="mt-6 border-t pt-6">
                <h3 class="text-lg font-semibold mb-4">{{ __('ID Verification Required') }}</h3>
                
                <!-- ID Type Selection -->
                <div class="mt-4">
                    <x-label for="id_type" value="{{ __('Type of ID') }}" class="font-semibold text-gray-700" />
                    <div class="relative mt-2">
                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none">
                        </span>
                        <select id="id_type" name="id_type" class="block mt-1 w-full pl-10 border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm form-input" required>
                            <option value="">-- {{ __('Select ID Type') }} --</option>
                            <option value="passport" {{ old('id_type') === 'passport' ? 'selected' : '' }}>🛂 {{ __('Passport') }}</option>
                            <option value="drivers_license" {{ old('id_type') === 'drivers_license' ? 'selected' : '' }}>🚗 {{ __("Driver's License") }}</option>
                            <option value="national_id" {{ old('id_type') === 'national_id' ? 'selected' : '' }}>📋 {{ __('National ID Card') }}</option>
                            <option value="residence_permit" {{ old('id_type') === 'residence_permit' ? 'selected' : '' }}>🏠 {{ __('Residence Permit') }}</option>
                        </select>
                    </div>
                    @error('id_type')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ID Number -->
                <div class="mt-4">
                    <x-label for="id_number" value="{{ __('ID Number') }}" />
                    <x-input id="id_number" class="block mt-1 w-full" type="text" name="id_number" placeholder="{{ __('Enter your ID number') }}" :value="old('id_number')" required />
                    @error('id_number')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Full Name on ID -->
                <div class="mt-4">
                    <x-label for="full_name_on_id" value="{{ __('Full Name on ID') }}" />
                    <x-input id="full_name_on_id" class="block mt-1 w-full" type="text" name="full_name_on_id" placeholder="{{ __('As it appears on your ID') }}" :value="old('full_name_on_id')" required />
                    @error('full_name_on_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ID Expiry Date -->
                <div class="mt-4">
                    <x-label for="id_expiry_date" value="{{ __('ID Expiry Date') }}" />
                    <x-input id="id_expiry_date" class="block mt-1 w-full form-input" type="date" name="id_expiry_date" :value="old('id_expiry_date')" required />
                    @error('id_expiry_date')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ID Document Upload -->
                <div class="mt-4">
                    <x-label for="id_document" value="{{ __('Upload ID Document') }}" class="font-semibold text-gray-700" />
                    <input id="id_document" type="file" name="id_document" class="block mt-2 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 border border-gray-300 rounded-lg cursor-pointer focus:outline-none" accept=".pdf,.jpg,.jpeg,.png" required />
                    <p class="text-gray-500 text-xs mt-2 flex items-center">
                        <i class="fas fa-info-circle mr-1"></i>
                        {{ __('Accepted formats: PDF, JPG, PNG (Max 5MB)') }}
                    </p>
                    @error('id_document')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirmation Checkbox -->
                <div class="mt-4 bg-purple-50 p-4 rounded-lg">
                    <label for="confirm_id_details" class="flex items-start cursor-pointer">
                        <input id="confirm_id_details" type="checkbox" name="confirm_id_details" class="mt-1 rounded border-gray-300 text-purple-600 shadow-sm focus:border-purple-500 focus:ring-purple-500" required />
                        <span class="ms-3 text-sm text-gray-700">{{ __('I confirm that the information provided is accurate and the ID document is valid') }}</span>
                    </label>
                    @error('confirm_id_details')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Privacy Notice -->
                <div class="mt-4 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-r-lg">
                    <div class="flex items-start">
                        <i class="fas fa-lock text-blue-600 mt-1 mr-3"></i>
                        <div>
                            <p class="text-sm font-semibold text-blue-900">{{ __('Your Privacy is Protected') }}</p>
                            <p class="text-sm text-blue-800 mt-1">
                                {{ __('Your ID document is securely stored and only visible to our verification team. It will never be shared with other users.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-blue-400 hover:text-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-blue-400 hover:text-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-blue-400 hover:text-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4" style="background: #5a9fd4; color: white;">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>

        <!-- Tenant Rental Policy Modal -->
        <x-tenant-rental-policy-modal />

        <!-- Tenant Rental Policy Script -->
        <script src="{{ asset('assets/js/tenant-rental-policy-modal.js') }}"></script>

        <script>
            // Password Toggle Functionality
            document.addEventListener('DOMContentLoaded', function() {
                // Toggle for password field
                const togglePassword = document.getElementById('togglePassword');
                const passwordInput = document.getElementById('password');
                const toggleIcon = document.getElementById('toggleIcon');
                
                if (togglePassword && passwordInput && toggleIcon) {
                    togglePassword.addEventListener('click', function() {
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

                // Toggle for password confirmation field
                const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
                const passwordConfirmInput = document.getElementById('password_confirmation');
                const toggleIconConfirm = document.getElementById('toggleIconConfirm');
                
                if (togglePasswordConfirm && passwordConfirmInput && toggleIconConfirm) {
                    togglePasswordConfirm.addEventListener('click', function() {
                        if (passwordConfirmInput.type === 'password') {
                            passwordConfirmInput.type = 'text';
                            toggleIconConfirm.classList.remove('fa-eye');
                            toggleIconConfirm.classList.add('fa-eye-slash');
                        } else {
                            passwordConfirmInput.type = 'password';
                            toggleIconConfirm.classList.remove('fa-eye-slash');
                            toggleIconConfirm.classList.add('fa-eye');
                        }
                    });
                }
            });
        </script>
    </x-authentication-card>
</x-guest-layout>
