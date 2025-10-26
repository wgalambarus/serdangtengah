<header class="bg-white border-b border-gray-200 px-6 h-[4.8em] flex items-center justify-between relative z-50">
  {{-- Judul halaman --}}
  <h2 class="text-2xl font-semibold text-gray-800 leading-none truncate">
    @yield('title')
  </h2>

  {{-- Bagian kanan (Profile Dropdown) --}}
  <div class="relative">
    {{-- Tombol Avatar --}}
    <button id="profile-menu-button" class="flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-blue-600 text-white font-semibold focus:outline-none focus:ring-2 focus:ring-indigo-400 transition duration-200">
        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
    </button>

    {{-- Dropdown --}}
    <div id="profile-dropdown"
        class="hidden absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden transform transition-all duration-200">
        <div class="px-4 py-3 border-b border-gray-100">
            <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
            <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
        </div>

        <div class="py-2">
            <a href="{{ route('profile.edit') }}"
               class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition">
                ⚙️ Profile Settings
            </a>

            <form method="POST" action="{{ route('logout') }}" class="block">
                @csrf
                <button type="submit"
                        class="w-full text-left px-4 py-2 text-red-500 hover:bg-red-900 hover:text-red-100 transition">
                    🚪 Logout
                </button>
            </form>
        </div>
    </div>
  </div>

  {{-- Script Dropdown --}}
  <script>
    document.addEventListener('DOMContentLoaded', () => {
        const button = document.getElementById('profile-menu-button');
        const dropdown = document.getElementById('profile-dropdown');

        button.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdown.classList.toggle('hidden');
            dropdown.classList.toggle('animate-fadeIn');
        });

        window.addEventListener('click', (e) => {
            if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    });
  </script>

  {{-- Simple Fade Animation --}}
  <style>
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-5px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
      animation: fadeIn 0.2s ease-in-out;
    }
  </style>
</header>
