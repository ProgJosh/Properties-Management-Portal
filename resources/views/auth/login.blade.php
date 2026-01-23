<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="text-center mb-6">
            <h2 class="text-3xl font-bold" style="color: #e5e7eb;">Welcome Back</h2>
            <p class="mt-2" style="color: #9ca3af;">Sign in to your account</p>
        </div>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-lg border border-green-200">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" class="font-semibold text-gray-700" />
                <x-input id="email" class="block mt-2 w-full form-input rounded-lg" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Enter your email" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" class="font-semibold text-gray-700" />
                <div class="password-wrapper mt-2">
                    <x-input id="password" class="block w-full pr-12 form-input rounded-lg" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password" />
                    <button type="button" class="password-toggle" id="togglePassword">
                        <i class="fas fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between mt-4">
                <label for="remember_me" class="flex items-center cursor-pointer">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm" style="color: #d1d5db;">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm hover:underline font-medium" style="color: #60a5fa;" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <div class="mt-6">
                <x-button class="w-full justify-center btn-primary rounded-lg py-3 text-white font-semibold">
                    {{ __('Log in') }}
                </x-button>
            </div>

            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t" style="border-color: #4a5568;"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4" style="background: #3a4b5c; color: #9ca3af;">or</span>
                </div>
            </div>

            <div class="text-center">
                <p style="color: #d1d5db;">{{ __('Don\'t have an account?') }}</p>
                <a href="{{ route('register') }}" class="inline-block mt-2 hover:underline font-semibold text-lg" style="color: #60a5fa;">
                    {{ __('Create Account') }}
                </a>
            </div>
        </form>

        <script>
            // Password Toggle Functionality
            document.addEventListener('DOMContentLoaded', function() {
                const togglePassword = document.getElementById('togglePassword');
                const passwordInput = document.getElementById('password');
                const toggleIcon = document.getElementById('toggleIcon');
                
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
            });
        </script>
    </x-authentication-card>
</x-guest-layout>
