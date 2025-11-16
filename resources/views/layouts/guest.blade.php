<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Tailwind CDN (optional if you're using Vite + Tailwind already) -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Custom Tailwind Colors -->
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            'farm-green': {
                                50: '#f0fdf4',
                                100: '#dcfce7',
                                200: '#bbf7d0',
                                300: '#86efac',
                                400: '#4ade80',
                                500: '#22c55e',
                                600: '#16a34a',
                                700: '#15803d',
                                800: '#166534',
                                900: '#14532d',
                            }
                        }
                    }
                }
            }
        </script>

        <!-- Breeze/Vite scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .bg-gradient-overlay {
                background: linear-gradient(135deg, rgba(0, 0, 0, 0.95) 0%, rgba(0, 0, 0, 0.85) 50%, rgba(0, 0, 0, 0.75) 100%);
            }
            
            .glass-effect {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                box-shadow: 0 8px 32px 0 rgba(21, 128, 61, 0.2);
            }

            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .animate-fade-in {
                animation: fadeIn 0.6s ease-out forwards;
            }
        </style>
    </head>

    <body class="font-sans antialiased min-h-screen relative overflow-hidden">

        <!-- Background Image -->
        <div class="fixed inset-0 z-0">
            <img src="/images/farm-background.jpg" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-overlay"></div>
        </div>

        <!-- Main Container -->
        <main class="relative z-10 min-h-screen flex items-center justify-center px-4 py-12">
            <div class="w-full max-w-md animate-fade-in">

                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-4xl font-bold text-white mb-2">PT Serdang Tengah Group</h1>
                    <p class="text-farm-green-100 text-md">Sistem Manajemen Karyawan & Pelamar</p>
                </div>

                <!-- Glass Card -->
                <div class="glass-effect rounded-2xl p-8 shadow-2xl">
                    {{ $slot }}
                </div>

                <!-- Footer -->
                <div class="mt-8 text-center">
                    <p class="text-farm-green-100 text-sm">
                        © 2025 PT Serdang Tengah Group. All rights reserved.
                    </p>
                </div>
            </div>
        </main>

    </body>
</html>
