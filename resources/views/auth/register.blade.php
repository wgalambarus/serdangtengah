<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Header dalam card -->
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-1">Selamat datang kembali!</h2>
        <p class="text-gray-600 text-sm">Silakan masuk untuk mengelola sistem</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- EMAIL -->
        <div>
            <x-input-label for="email" value="Email" class="font-semibold text-gray-700" />

            <x-text-input
                id="email"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
                placeholder="Masukkan email"
                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg input-focus text-gray-800"
            />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- PASSWORD -->
        <div>
            <x-input-label for="password" value="Password" class="font-semibold text-gray-700" />

            <x-text-input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Masukkan password"
                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg input-focus text-gray-800"
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- REMEMBER ME -->
        <div class="flex items-center gap-2 mt-1">
            <input
                id="remember_me"
                type="checkbox"
                name="remember"
                class="w-4 h-4 rounded border-gray-300 text-farm-green-600 focus:ring-farm-green-500"
            >
            <label for="remember_me" class="text-sm text-gray-700">Remember me</label>
        </div>

        <!-- BUTTON -->
        <button
            type="submit"
            class="w-full bg-farm-green-600 hover:bg-farm-green-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center justify-center gap-2"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
            </svg>
            Sign In
        </button>

        <!-- REGISTER LINK OPTIONAL -->
        @if (Route::has('register'))
        <div class="mt-4 text-center">
            <a href="{{ route('register') }}" class="text-sm text-farm-green-700 hover:text-farm-green-800 font-semibold transition-colors">
                Belum punya akun? Daftar di sini
            </a>
        </div>
        @endif
    </form>

</x-guest-layout>
