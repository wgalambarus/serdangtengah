<aside class="w-64 bg-white border-r border-gray-200 flex flex-col">
  <div class="p-6 border-b border-gray-200 flex items-center gap-3">
    <img
      src="{{ asset('favicon.ico') }}"
      alt="SmartRecruitment Logo"
      class="w-10 h-10 object-contain"
    />

    <div class="leading-tight">
      <h1 class="text-lg font-bold text-gray-800">Serdang Tengah</h1>
      <p class="text-xs text-gray-500">Sistem Manejemen | HR</p>
    </div>
  </div>
  <nav class="p-4 space-y-2">
    @php
      $menus = [
        ['name' => 'Dashboard', 'icon' => 'M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8v-10h-8v10zm0-18v6h8V3h-8z', 'url' => '/dashboard'],
        ['name' => 'Pelamar', 'icon' => 'M17 20h5V4H2v16h5v-6h10v6z', 'url' => '/pelamar'],
        ['name' => 'Karyawan', 'icon' => 'M4 4h16v16H4z', 'url' => '/employee'],
        ['name' => 'Lowongan', 'icon' => 'M4 4h16v4H4zm0 6h16v10H4z', 'url' => '/lowongan'],
      ];

      $current = request()->path();

      // function pengecekan aktif menu yang lebih akurat
      $isActive = function($menu) use ($current) {
          $clean = trim($menu['url'], '/');
          return $current === $clean || str_starts_with($current, $clean);
      };
    @endphp

    @foreach ($menus as $menu)
      <a href="{{ $menu['url'] }}"
        class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors
        {{ $isActive($menu) ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path d="{{ $menu['icon'] }}" />
        </svg>
        <span>{{ $menu['name'] }}</span>
      </a>
    @endforeach
  </nav>
</aside>
