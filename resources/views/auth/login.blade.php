<x-guest-layout>

    <!-- Header Card -->
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-1">Selamat datang kembali!</h2>
        <p class="text-gray-600 text-sm">Silakan masuk untuk mengelola sistem</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Email
                </div>
            </label>

            <input 
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required autofocus autocomplete="username"
                placeholder="Masukkan email Anda"
                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg input-focus focus:outline-none transition duration-150 text-gray-800"
            >

            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Password
                </div>
            </label>

            <input 
                id="password"
                type="password"
                name="password"
                required autocomplete="current-password"
                placeholder="Masukkan kata sandi"
                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg input-focus focus:outline-none transition duration-150 text-gray-800"
            >

            @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center gap-2">
            <input 
                id="remember_me"
                type="checkbox"
                name="remember"
                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
            >
            <label for="remember_me" class="text-sm text-gray-700">Remember me</label>
        </div>

        <!-- Login Button -->
        <button 
            type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center justify-center gap-2"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
            </svg>
            Sign In
        </button>
    </form>

</x-guest-layout>
