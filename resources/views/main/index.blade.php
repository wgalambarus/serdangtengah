<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PT Serdang Tengah Group</title>
    <meta name="description" content="Sign in to your AgroFarm account">
    <script src="https://cdn.tailwindcss.com"></script>
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
    <style>
        .bg-gradient-overlay {
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.95) 0%, rgba(0, 0, 0, 0.85) 50%, rgba(0, 0, 0, 0.75) 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px 0 rgba(21, 128, 61, 0.2);
        }
        
        .input-focus:focus {
            border-color: #16a34a;
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
    </style>
</head>
<body class="min-h-screen relative overflow-hidden">
    <!-- Background Image with Overlay -->
    <div class="fixed inset-0 z-0">
        <img src="/images/farm-background.jpg" alt="Farm Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-overlay"></div>
    </div>

    <!-- Login Container -->
    <main class="relative z-10 min-h-screen flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md animate-fade-in">
            <!-- Logo Section -->
            <div class="text-center mb-8">
                <!-- <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-white shadow-lg mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-farm-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div> -->
                <h1 class="text-4xl font-bold text-white mb-2">PT Serdang Tengah Group</h1>
                <p class="text-farm-green-100 text-md">Sistem Manajemen Karyawan & Pelamar</p>
            </div>

            <!-- Login Form Card -->
            <div class="glass-effect rounded-2xl p-8 shadow-2xl">
                <div class="mb-6 text-center">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Selamat datang kembali!</h2>
                    <p class="text-gray-600 text-sm">Silakan masuk untuk mengelola sistem</p>
                </div>

                <form action="/login" method="POST" class="space-y-5">
                    <!-- Username Field -->
                    <div>
                        <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-farm-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Username
                            </div>
                        </label>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            required
                            placeholder="Masukkan nama pengguna Anda"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none input-focus transition-all duration-200 text-gray-800"
                        >
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-farm-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Password
                            </div>
                        </label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required
                            placeholder="Masukkan kata sandi Anda"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none input-focus transition-all duration-200 text-gray-800"
                        >
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <!-- <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input 
                                type="checkbox" 
                                name="remember" 
                                class="w-4 h-4 text-farm-green-600 border-gray-300 rounded focus:ring-farm-green-500"
                            >
                            <span class="text-gray-700">Remember me</span>
                        </label>
                        <a href="/forgot-password" class="text-farm-green-700 hover:text-farm-green-800 font-medium transition-colors">
                            Forgot password?
                        </a>
                    </div> -->

                    <!-- Login Button -->
                    <button 
                        type="submit"
                        class="w-full bg-farm-green-600 hover:bg-farm-green-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center justify-center gap-2"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Sign In
                    </button>
                </form>

                <!-- Sign Up Link -->
                <!-- <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Don't have an account? 
                        <a href="/register" class="text-farm-green-700 hover:text-farm-green-800 font-semibold transition-colors">
                            Sign up here
                        </a>
                    </p>
                </div>
            </div> -->

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