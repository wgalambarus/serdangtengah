<header class="bg-white border-b border-gray-200 px-6 h-[4.8em] flex items-center justify-between relative z-50">
  
  {{-- Judul Halaman --}}
  <h2 class="text-2xl font-semibold text-gray-800 leading-tight truncate">
    @yield('title')
  </h2>


  {{-- Profile Section --}}
  <div class="relative flex items-center gap-3 cursor-pointer select-none" id="profile-wrapper">

      {{-- Avatar --}}
      <div
        id="profile-menu-button"
        class="flex items-center gap-3"
      >
        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-blue-600 
                    flex items-center justify-center text-white font-bold text-lg shadow-sm">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>

        {{-- Name & Role --}}
        <div class="hidden md:flex flex-col leading-tight">
            <span class="font-semibold text-gray-800 text-sm tracking-tight">
                {{ Auth::user()->name }}
            </span>
            <span class="text-xs text-gray-500">
                {{ Auth::user()->email }}
            </span>
        </div>

        {{-- Arrow --}}
        <svg class="w-4 h-4 text-gray-500 ml-1" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
        </svg>
      </div>

      {{-- Dropdown --}}
      <div id="profile-dropdown"
          class="hidden absolute right-0 top-14 w-60 bg-white rounded-xl shadow-lg border border-gray-100 
                 overflow-hidden transform transition-all duration-200 opacity-0 scale-95">
          
          <div class="px-4 py-3 border-b border-gray-100">
              <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
              <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
          </div>

          <div class="py-2">
              <a href="{{ route('profile.edit') }}"
                class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-indigo-600 transition">
                  ⚙️ <span>Profile Settings</span>
              </a>

              <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button
                      class="flex items-center gap-2 w-full text-left px-4 py-2 text-red-500 hover:bg-red-50 transition">
                      🚪 <span>Logout</span>
                  </button>
              </form>
          </div>
      </div>
  </div>

</header>

{{-- Dropdown Script --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const wrapper = document.getElementById('profile-wrapper');
    const dropdown = document.getElementById('profile-dropdown');

    wrapper.addEventListener('click', (e) => {
        e.stopPropagation();
        const isHidden = dropdown.classList.contains('hidden');

        if (isHidden) {
            dropdown.classList.remove('hidden');
            setTimeout(() => {
                dropdown.classList.remove('opacity-0', 'scale-95');
                dropdown.classList.add('opacity-100', 'scale-100');
            }, 10);
        } else {
            dropdown.classList.add('opacity-0', 'scale-95');
            setTimeout(() => dropdown.classList.add('hidden'), 150);
        }
    });

    window.addEventListener('click', () => {
        dropdown.classList.add('opacity-0', 'scale-95');
        setTimeout(() => dropdown.classList.add('hidden'), 150);
    });
});
</script>
