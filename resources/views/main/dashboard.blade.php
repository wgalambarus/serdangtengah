@extends('layouts.main')

@section('title', 'Dashboard')

@section('header-actions')
<div class="relative w-80">
  <svg xmlns="http://www.w3.org/2000/svg"
    class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5"
    fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
  </svg>
  <input type="text" placeholder="Cari..."
    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
</div>
@endsection

@section('content')
<div class="space-y-6">
  {{-- Statistik --}}
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
      <div class="flex items-center gap-4">
        <div class="p-3 rounded-lg bg-blue-50 text-blue-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path d="M17 20h5V4H2v16h5v-6h10v6z" />
          </svg>
        </div>
        <div>
          <p class="text-gray-600 text-sm">Jumlah Karyawan</p>
          <p class="text-3xl font-bold text-gray-800 mt-1">248</p>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
      <div class="flex items-center gap-4">
        <div class="p-3 rounded-lg bg-green-50 text-green-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path d="M5 13l4 4L19 7" />
          </svg>
        </div>
        <div>
          <p class="text-gray-600 text-sm">Karyawan Aktif</p>
          <p class="text-3xl font-bold text-gray-800 mt-1">235</p>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
      <div class="flex items-center gap-4">
        <div class="p-3 rounded-lg bg-purple-50 text-purple-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
          </svg>
        </div>
        <div>
          <p class="text-gray-600 text-sm">Jumlah Pelamar</p>
          <p class="text-3xl font-bold text-gray-800 mt-1">87</p>
        </div>
      </div>
    </div>
  </div>

  {{-- Pelamar per bulan & Top pelamar --}}
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    {{-- Pelamar per bulan --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
      <h3 class="text-lg font-semibold text-gray-800 mb-6">Pelamar Per Bulan</h3>

      @php
        $dataBulan = [
          ['bulan' => 'Jan', 'pelamar' => 45],
          ['bulan' => 'Feb', 'pelamar' => 52],
          ['bulan' => 'Mar', 'pelamar' => 48],
          ['bulan' => 'Apr', 'pelamar' => 61],
          ['bulan' => 'Mei', 'pelamar' => 55],
          ['bulan' => 'Jun', 'pelamar' => 67],
        ];
        $maxPelamar = collect($dataBulan)->max('pelamar');
      @endphp

      <div class="space-y-4">
        @foreach ($dataBulan as $item)
          <div class="flex items-center gap-3">
            <span class="w-12 text-sm text-gray-600 font-medium">{{ $item['bulan'] }}</span>
            <div class="flex-1 bg-gray-100 rounded-full h-8 overflow-hidden">
              <div class="bg-blue-600 h-full rounded-full flex items-center justify-end pr-3 text-white text-xs font-semibold"
                style="width: {{ ($item['pelamar'] / $maxPelamar) * 100 }}%">
                {{ $item['pelamar'] }}
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>

    {{-- Top pelamar --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
      <h3 class="text-lg font-semibold text-gray-800 mb-6">Top Pelamar</h3>

      @php
        $pelamarTeratas = [
          ['nama' => 'Ahmad Rizki', 'nilai' => 95, 'posisi' => 'Full Stack Developer'],
          ['nama' => 'Siti Nurhaliza', 'nilai' => 92, 'posisi' => 'UI/UX Designer'],
          ['nama' => 'Budi Santoso', 'nilai' => 90, 'posisi' => 'Data Analyst'],
          ['nama' => 'Dewi Lestari', 'nilai' => 88, 'posisi' => 'Backend Developer'],
          ['nama' => 'Eko Prasetyo', 'nilai' => 85, 'posisi' => 'Frontend Developer'],
        ];
      @endphp

      <div class="space-y-4">
        @foreach ($pelamarTeratas as $i => $p)
          <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-semibold">
                {{ $i + 1 }}
              </div>
              <div>
                <p class="font-medium text-gray-800">{{ $p['nama'] }}</p>
                <p class="text-sm text-gray-500">{{ $p['posisi'] }}</p>
              </div>
            </div>
            <div class="flex items-center gap-2">
              <span class="text-lg font-bold text-blue-600">{{ $p['nilai'] }}</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M9 5l7 7-7 7" />
              </svg>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
