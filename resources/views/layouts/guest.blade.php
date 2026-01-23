<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('frontend/assets/images/logo/system-logo.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        
        <style>
            body {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                overflow-x: hidden;
            }
            
            .auth-card {
                background: #2c3e50;
                backdrop-filter: blur(10px);
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            }
            
            .form-input {
                background: #2c3e50;
                border: 1px solid #4a5568;
                color: #ffffff;
                transition: all 0.3s ease;
            }
            
            .form-input:focus {
                border-color: #5a9fd4;
                box-shadow: 0 0 0 3px rgba(90, 159, 212, 0.2);
                outline: none;
                background: #34495e;
            }
            
            .form-input::placeholder {
                color: #9ca3af;
            }
            
            .btn-primary {
                background: #5a9fd4;
                transition: all 0.3s ease;
            }
            
            .btn-primary:hover {
                background: #4a8fc4;
                box-shadow: 0 4px 12px rgba(90, 159, 212, 0.4);
            }
            
            .logo-container {
                animation: fadeInDown 0.6s ease-out;
            }
            
            .card-content {
                animation: fadeInUp 0.6s ease-out;
            }
            
            @keyframes fadeInDown {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            .password-toggle {
                position: absolute;
                right: 12px;
                top: 50%;
                transform: translateY(-50%);
                background: none;
                border: none;
                color: #9ca3af;
                cursor: pointer;
                padding: 8px;
                font-size: 18px;
                transition: color 0.3s ease;
                z-index: 10;
            }
            
            .password-toggle:hover {
                color: #d1d5db;
            }
            
            .password-toggle:focus {
                outline: none;
            }
            
            .password-wrapper {
                position: relative;
            }

            /* Custom scrollbar */
            .auth-card::-webkit-scrollbar {
                width: 8px;
            }

            .auth-card::-webkit-scrollbar-track {
                background: #2c3e50;
                border-radius: 10px;
            }

            .auth-card::-webkit-scrollbar-thumb {
                background: #4a5568;
                border-radius: 10px;
            }

            .auth-card::-webkit-scrollbar-thumb:hover {
                background: #5a6c7d;
            }
            
            /* Dark theme text colors */
            label, h5, h3 {
                color: #e5e7eb !important;
            }
            
            .text-gray-600, .text-gray-700 {
                color: #d1d5db !important;
            }
            
            .text-gray-500 {
                color: #9ca3af !important;
            }
            
            select {
                background: #2c3e50;
                color: #ffffff;
                border: 1px solid #4a5568;
            }
            
            select option {
                background: #2c3e50;
                color: #ffffff;
            }
            
            .bg-purple-50 {
                background: #374151 !important;
            }
            
            .bg-blue-50 {
                background: #1e3a5f !important;
            }
            
            .border-blue-500 {
                border-color: #3b82f6 !important;
            }
            
            .text-blue-900, .text-blue-800 {
                color: #93c5fd !important;
            }
            
            .text-blue-600 {
                color: #60a5fa !important;
            }
        </style>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>

        @livewireScripts
    </body>
</html>
