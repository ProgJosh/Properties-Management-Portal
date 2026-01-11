<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <!-- Government-Issued ID Upload (Required for Registration) -->
            <div class="mt-6 border-t pt-6">
                <h3 class="text-lg font-semibold mb-4">{{ __('ID Verification Required') }}</h3>
                
                <!-- ID Type Selection -->
                <div class="mt-4">
                    <x-label for="id_type" value="{{ __('Type of ID') }}" />
                    <select id="id_type" name="id_type" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        <option value="">-- {{ __('Select ID Type') }} --</option>
                        <option value="passport" {{ old('id_type') === 'passport' ? 'selected' : '' }}>{{ __('Passport') }}</option>
                        <option value="drivers_license" {{ old('id_type') === 'drivers_license' ? 'selected' : '' }}>{{ __("Driver's License") }}</option>
                        <option value="national_id" {{ old('id_type') === 'national_id' ? 'selected' : '' }}>{{ __('National ID Card') }}</option>
                        <option value="residence_permit" {{ old('id_type') === 'residence_permit' ? 'selected' : '' }}>{{ __('Residence Permit') }}</option>
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
                    <x-input id="id_expiry_date" class="block mt-1 w-full" type="date" name="id_expiry_date" :value="old('id_expiry_date')" required />
                    @error('id_expiry_date')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ID Document Upload -->
                <div class="mt-4">
                    <x-label for="id_document" value="{{ __('Upload ID Document') }}" />
                    <input id="id_document" type="file" name="id_document" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" accept=".pdf,.jpg,.jpeg,.png" required />
                    <p class="text-gray-600 text-sm mt-2">{{ __('Accepted formats: PDF, JPG, PNG (Max 5MB)') }}</p>
                    @error('id_document')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirmation Checkbox -->
                <div class="mt-4">
                    <label for="confirm_id_details" class="flex items-center">
                        <input id="confirm_id_details" type="checkbox" name="confirm_id_details" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required />
                        <span class="ms-2 text-sm text-gray-600">{{ __('I confirm that the information provided is accurate and the ID document is valid') }}</span>
                    </label>
                    @error('confirm_id_details')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Privacy Notice -->
                <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-md">
                    <p class="text-sm text-blue-800">
                        <strong>{{ __('Your Privacy is Protected') }}</strong><br>
                        {{ __('Your ID document is securely stored and only visible to our verification team. It will never be shared with other users.') }}
                    </p>
                </div>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
