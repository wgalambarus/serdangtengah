<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SmartRecruiter Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex h-screen bg-gray-100 text-gray-800 font-inter">

  {{-- Sidebar --}}
  <aside class="w-60 bg-white border-r border-gray-200 p-6 flex flex-col">
    <h2 class="text-xl font-bold mb-6 text-gray-800">SmartRecruiter</h2>

    <nav class="flex flex-col space-y-2">
      <a href="main" class="px-4 py-2 rounded-lg font-medium hover:bg-green-700 hover:text-white {{ Route::is('dashboard') ? 'bg-green-700 text-white' : 'text-gray-700' }}">Dashboard</a>
      <a href="/pelamar" class="px-4 py-2 rounded-lg font-medium hover:bg-green-700 hover:text-white {{ Route::is('pelamar.*') ? 'bg-green-700 text-white' : 'text-gray-700' }}">Pelamar</a>
      <a href="/karyawan" class="px-4 py-2 rounded-lg font-medium hover:bg-green-700 hover:text-white {{ Route::is('karyawan.*') ? 'bg-green-700 text-white' : 'text-gray-700' }}">Karyawan</a>
      {{-- <a href="{{ route('tambahdata') }}" class="px-4 py-2 rounded-lg font-medium hover:bg-green-700 hover:text-white {{ Route::is('tambahdata') ? 'bg-green-700 text-white' : 'text-gray-700' }}">Tambah Data</a>
      <a href="{{ route('laporan') }}" class="px-4 py-2 rounded-lg font-medium hover:bg-green-700 hover:text-white {{ Route::is('laporan') ? 'bg-green-700 text-white' : 'text-gray-700' }}">Laporan</a>
      <a href="{{ route('pengaturan') }}" class="px-4 py-2 rounded-lg font-medium hover:bg-green-700 hover:text-white {{ Route::is('pengaturan') ? 'bg-green-700 text-white' : 'text-gray-700' }}">Pengaturan</a> --}}
    </nav>
  </aside>

  {{-- Main Content --}}
  <main class="flex-1 flex flex-col">
    {{-- Topbar --}}
    <header class="flex items-center justify-between bg-white border-b border-gray-200 px-6 py-4">
      <div class="relative">
        <input type="text" placeholder="Search..." class="border border-gray-300 rounded-full px-4 py-2 w-64 focus:ring-2 focus:ring-green-500 focus:outline-none">
      </div>
      <div class="flex items-center space-x-3">
        <img src="https://via.placeholder.com/35" alt="User" class="w-9 h-9 rounded-full">
        <span class="font-medium">{{ Auth::user()->name ?? 'John Doe' }}</span>
      </div>
    </header>

    {{-- Dashboard --}}
    <section class="grid grid-cols-3 gap-6 p-6">
      {{-- Cards --}}
      <div class="col-span-2 space-y-6">
        <div class="grid grid-cols-3 gap-4">
          <div class="bg-green-700 text-white rounded-xl p-6 shadow">
            <h3 class="text-base font-semibold mb-2">Jumlah Karyawan</h3>
            <p class="text-3xl font-bold">{{ $jumlahKaryawan ?? 124 }}</p>
          </div>
          <div class="bg-white rounded-xl p-6 shadow">
            <h3 class="text-base font-semibold mb-2">Jumlah Karyawan Aktif</h3>
            <p class="text-3xl font-bold">{{ $karyawanAktif ?? 87 }}</p>
          </div>
          <div class="bg-white rounded-xl p-6 shadow">
            <h3 class="text-base font-semibold mb-2">Jumlah Pelamar</h3>
            <p class="text-3xl font-bold">{{ $jumlahPelamar ?? 235 }}</p>
          </div>
        </div>

        <div class="bg-white rounded-xl p-6 h-48 shadow flex flex-col justify-center items-center">
          <h3 class="text-lg font-semibold mb-2">Chart / Summary</h3>
          <p class="text-gray-500">Placeholder for chart or additional content</p>
        </div>
      </div>

      {{-- Ranking --}}
      <div class="bg-white rounded-xl p-6 shadow">
        <h3 class="text-lg font-semibold mb-4">List Ranking Pelamar</h3>

        <div class="space-y-3">
          @foreach($rankingPelamar ?? [
              ['nama' => 'Fauzan Luthfi', 'posisi' => 'Admin Jaringan', 'img' => 'https://i.pravatar.cc/50?img=1'],
              ['nama' => 'Amelia Sari', 'posisi' => 'UI/UX Designer', 'img' => 'https://i.pravatar.cc/50?img=2'],
              ['nama' => 'Rizky Pratama', 'posisi' => 'Backend Developer', 'img' => 'https://i.pravatar.cc/50?img=3'],
          ] as $pelamar)
            <div class="flex items-center space-x-3">
              <img src="{{ $pelamar['img'] }}" alt="{{ $pelamar['nama'] }}" class="w-9 h-9 rounded-full">
              <div>
                <p class="text-sm font-medium">{{ $pelamar['nama'] }}</p>
                <span class="text-xs text-gray-500">{{ $pelamar['posisi'] }}</span>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  </main>
</body>
</html>
