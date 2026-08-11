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
                        <div class="flex justify-between items-start mb-2">
                            <p class="text-xl font-bold text-red-900">⚠️ Registration Not Allowed</p>
                            <div class="flex items-center bg-red-600 text-white px-3 py-1 rounded-full text-sm font-bold">
                                <i class="fas fa-clock mr-2"></i>
                                <span id="errorTimer">30</span>s
                            </div>
                        </div>
                        <p class="text-red-800 mt-2 font-semibold text-base leading-relaxed">
                            {{ $message }}
                        </p>
                        <p class="text-red-700 mt-3 text-sm italic">
                            <i class="fas fa-info-circle mr-1"></i>
                            Please ensure you meet the age requirement before attempting to register.
                        </p>
                        <div class="mt-3 bg-red-200 rounded-full h-2 overflow-hidden">
                            <div id="timerProgress" class="bg-red-600 h-full transition-all duration-1000" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                @keyframes pulse-slow { 0%, 100% { opacity: 1; } 50% { opacity: 0.85; } }
                @keyframes bounce-slow { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
                .animate-pulse-slow { animation: pulse-slow 3s ease-in-out infinite; }
                .animate-bounce-slow { animation: bounce-slow 2s ease-in-out infinite; }
                #ageErrorAlert { position: sticky; top: 20px; z-index: 1000; backdrop-filter: blur(10px); }
            </style>
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

            <!-- Government-Issued ID Upload -->
            <div class="mt-6 border-t pt-6">
                <h3 class="text-lg font-semibold mb-1">{{ __('ID Verification Required') }}</h3>
                <p class="text-xs text-gray-500 mb-4">Upload a clear photo of your government-issued ID. The system will scan it to confirm it matches the selected type.</p>

                <!-- ID Type -->
                <div class="mt-4">
                    <x-label for="id_type" value="{{ __('Type of ID') }}" class="font-semibold text-gray-700" />
                    <select id="id_type" name="id_type" class="block mt-1 w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm form-input" required>
                        <option value="">-- {{ __('Select ID Type') }} --</option>
                        <optgroup label="Primary IDs">
                            <option value="passport"          {{ old('id_type') === 'passport'          ? 'selected' : '' }}>🛂 Passport</option>
                            <option value="drivers_license"   {{ old('id_type') === 'drivers_license'   ? 'selected' : '' }}>🚗 Driver's License</option>
                            <option value="national_id"       {{ old('id_type') === 'national_id'       ? 'selected' : '' }}>📋 National ID (PhilSys)</option>
                            <option value="umid"              {{ old('id_type') === 'umid'              ? 'selected' : '' }}>🪪 UMID Card</option>
                        </optgroup>
                        <optgroup label="Government IDs">
                            <option value="sss_id"            {{ old('id_type') === 'sss_id'            ? 'selected' : '' }}>🏛️ SSS ID</option>
                            <option value="pagibig_id"        {{ old('id_type') === 'pagibig_id'        ? 'selected' : '' }}>🏠 Pag-IBIG ID</option>
                            <option value="philhealth_id"     {{ old('id_type') === 'philhealth_id'     ? 'selected' : '' }}>🏥 PhilHealth ID</option>
                            <option value="voters_id"         {{ old('id_type') === 'voters_id'         ? 'selected' : '' }}>🗳️ Voter's ID</option>
                            <option value="tin_id"            {{ old('id_type') === 'tin_id'            ? 'selected' : '' }}>📄 TIN ID</option>
                            <option value="postal_id"         {{ old('id_type') === 'postal_id'         ? 'selected' : '' }}>📮 Postal ID</option>
                            <option value="senior_citizen_id" {{ old('id_type') === 'senior_citizen_id' ? 'selected' : '' }}>👴 Senior Citizen ID</option>
                            <option value="residence_permit"  {{ old('id_type') === 'residence_permit'  ? 'selected' : '' }}>📑 Residence Permit</option>
                            <option value="student_id"        {{ old('id_type') === 'student_id'        ? 'selected' : '' }}>🎓 Student ID</option>
                        </optgroup>
                    </select>
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

                <!-- ID Document Upload + Live Scan -->
                <div class="mt-4">
                    <x-label for="id_document" value="{{ __('Upload ID Document') }}" class="font-semibold text-gray-700" />

                    <!-- Preview with remove button -->
                    <div id="id-preview-wrap" style="display:none; position:relative; margin-top:8px; margin-bottom:8px;">
                        <img id="id-preview-img" src="" alt="ID Preview"
                            style="width:100%; max-height:200px; object-fit:contain; border-radius:8px; border:2px dashed #d1d5db;" />
                        <button type="button" id="id-remove-btn" title="Remove uploaded file"
                            style="position:absolute;top:8px;right:8px;width:30px;height:30px;background:#dc2626;border:none;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 6px rgba(0,0,0,0.35);z-index:20;">
                            <i class="fas fa-times" style="color:#fff;font-size:13px;pointer-events:none;"></i>
                        </button>
                    </div>

                    <!-- File input -->
                    <div class="mt-2">
                        <input id="id_document" type="file" name="id_document"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 border border-gray-300 rounded-lg cursor-pointer focus:outline-none"
                            accept=".jpg,.jpeg,.png" required />
                    </div>
                    <p class="text-gray-500 text-xs mt-1"><i class="fas fa-info-circle mr-1"></i>Accepted: JPG, PNG (Max 5MB). PDF not accepted for scanning.</p>

                    <!-- Scan spinner -->
                    <div id="id-scan-spinner" style="display:none;" class="mt-2 flex items-center gap-2 text-purple-600 text-sm">
                        <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                        </svg>
                        Scanning your ID image...
                    </div>

                    <!-- Scan status -->
                    <div id="id-scan-status" style="display:none;" class="mt-3 p-3 rounded-lg text-sm font-medium flex items-center gap-2"></div>

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
                            <p class="text-sm text-blue-800 mt-1">{{ __('Your ID document is securely stored and only visible to our verification team. It will never be shared with other users.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hidden scan result tracker -->
            <input type="hidden" id="id_scan_passed" name="id_scan_passed" value="0" />

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />
                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-blue-400 hover:text-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">'.__('Terms of Service').'</a>',
                                    'privacy_policy'   => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-blue-400 hover:text-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <!-- Register button area -->
            <div class="mt-6">
                <div id="id-scan-btn-warning"
                    class="mb-3 p-3 bg-yellow-50 border border-yellow-400 rounded-lg flex items-center gap-2 text-sm text-yellow-800">
                    <i class="fas fa-shield-alt text-yellow-500"></i>
                    <span>ID scan required — upload and pass verification to enable the Register button.</span>
                </div>
                <div class="flex items-center justify-end">
                    <a class="underline text-sm text-blue-400 hover:text-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                    <button id="register-btn" type="submit" disabled
                        class="ms-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition"
                        style="background:#5a9fd4;color:white;opacity:0.45;cursor:not-allowed;">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>

        <script>
        document.addEventListener('DOMContentLoaded', function () {

            // ── Password toggles ──────────────────────────────────────────
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput  = document.getElementById('password');
            const toggleIcon     = document.getElementById('toggleIcon');
            if (togglePassword) {
                togglePassword.addEventListener('click', function () {
                    const hide = passwordInput.type === 'password';
                    passwordInput.type = hide ? 'text' : 'password';
                    toggleIcon.classList.toggle('fa-eye', !hide);
                    toggleIcon.classList.toggle('fa-eye-slash', hide);
                });
            }

            const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
            const passwordConfirmInput  = document.getElementById('password_confirmation');
            const toggleIconConfirm     = document.getElementById('toggleIconConfirm');
            if (togglePasswordConfirm) {
                togglePasswordConfirm.addEventListener('click', function () {
                    const hide = passwordConfirmInput.type === 'password';
                    passwordConfirmInput.type = hide ? 'text' : 'password';
                    toggleIconConfirm.classList.toggle('fa-eye', !hide);
                    toggleIconConfirm.classList.toggle('fa-eye-slash', hide);
                });
            }

            // ── Age error timer ───────────────────────────────────────────
            const ageError = document.getElementById('ageErrorAlert');
            if (ageError) {
                window.ageErrorTimerActive = true;
                ageError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                let timeLeft = 30;
                const timerDisplay = document.getElementById('errorTimer');
                const progressBar  = document.getElementById('timerProgress');
                const countdown = setInterval(function () {
                    timeLeft--;
                    if (timerDisplay) timerDisplay.textContent = timeLeft;
                    if (progressBar) progressBar.style.width = ((timeLeft / 30) * 100) + '%';
                    if (timeLeft <= 0) {
                        clearInterval(countdown);
                        window.ageErrorTimerActive = false;
                        window.ageErrorCompleted   = true;
                        ageError.style.transition  = 'opacity 3s ease-out';
                        ageError.style.opacity     = '0.8';
                    }
                }, 1000);
            }

            // ── ID Scan ───────────────────────────────────────────────────
            const scanUrl      = '{{ route('id.scan') }}';
            const csrfToken    = '{{ csrf_token() }}';

            const fileInput    = document.getElementById('id_document');
            const idTypeSelect = document.getElementById('id_type');
            const statusBox    = document.getElementById('id-scan-status');
            const spinner      = document.getElementById('id-scan-spinner');
            const previewWrap  = document.getElementById('id-preview-wrap');
            const previewImg   = document.getElementById('id-preview-img');
            const removeBtn    = document.getElementById('id-remove-btn');
            const scanPassed   = document.getElementById('id_scan_passed');
            const registerBtn  = document.getElementById('register-btn');
            const btnWarning   = document.getElementById('id-scan-btn-warning');
            const form         = document.querySelector('form');

            function setLocked(locked) {
                registerBtn.disabled      = locked;
                registerBtn.style.opacity = locked ? '0.45' : '1';
                registerBtn.style.cursor  = locked ? 'not-allowed' : 'pointer';
                registerBtn.title         = locked ? 'Upload and pass ID scan to enable registration' : '';
                btnWarning.style.display  = locked ? 'flex' : 'none';
            }

            function resetScan() {
                statusBox.style.display = 'none';
                statusBox.innerHTML     = '';
                scanPassed.value        = '0';
                setLocked(true);
            }

            function clearFile() {
                fileInput.value          = '';
                previewImg.src           = '';
                previewWrap.style.display = 'none';
                spinner.style.display    = 'none';
                resetScan();
            }

            function showStatus(valid, message) {
                spinner.style.display   = 'none';
                statusBox.innerHTML     = (valid ? '✅ ' : '❌ ') + message;
                statusBox.className     = 'mt-3 p-3 rounded-lg text-sm font-medium flex items-center gap-2 ' +
                    (valid ? 'bg-green-100 text-green-800 border border-green-400'
                           : 'bg-red-100 text-red-800 border border-red-400');
                statusBox.style.display = 'flex';
                scanPassed.value        = valid ? '1' : '0';
                setLocked(!valid);
            }

            async function runScan() {
                const file   = fileInput.files[0];
                const idType = idTypeSelect.value;
                if (!file || !idType) { resetScan(); return; }

                const reader = new FileReader();
                reader.onload = e => {
                    previewImg.src            = e.target.result;
                    previewWrap.style.display = 'block';
                };
                reader.readAsDataURL(file);

                resetScan();
                spinner.style.display = 'flex';

                const fd = new FormData();
                fd.append('id_document', file);
                fd.append('id_type', idType);
                fd.append('_token', csrfToken);

                try {
                    const res  = await fetch(scanUrl, { method: 'POST', body: fd });
                    const data = await res.json();
                    showStatus(data.valid, data.message);
                } catch (err) {
                    showStatus(false, 'Scan failed. Please try again.');
                }
            }

            // Initialise — button locked on page load
            setLocked(true);

            removeBtn.addEventListener('click', clearFile);
            fileInput.addEventListener('change', runScan);
            idTypeSelect.addEventListener('change', clearFile);

            // Hard fallback — block submit if scan not passed
            form.addEventListener('submit', function (e) {
                if (scanPassed.value !== '1') {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    showStatus(false, 'You must upload a valid ID and pass the scan before registering.');
                    statusBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }, true);
        });
        </script>
    </x-authentication-card>

    <!-- Tenant Rental Policy Modal -->
    <x-tenant-rental-policy-modal />

    <!-- Tenant Rental Policy Script -->
    <script src="{{ asset('assets/js/tenant-rental-policy-modal.js') }}?v={{ now()->timestamp }}"></script>
</x-guest-layout>
