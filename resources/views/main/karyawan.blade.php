@extends('layouts.main', ['currentPage' => 'Karyawan'])

@section('title', 'Manajemen Karyawan')

@section('header-actions')
<div class="relative w-80">
</div>
@endsection

@section('content')
<div class="flex flex-col lg:flex-row justify-between items-center mb-6 mt-4 gap-4">
  <div>
    <h2 class="text-2xl font-semibold text-gray-800 tracking-tight">
      Semua Karyawan ({{$employees->total()}})
    </h2>
  </div>
  <div class="flex items-center gap-3 w-full lg:w-auto">
    <div class="relative">
        {{-- SEARCH + FILTERS (letakkan di header actions atau di atas tabel) --}}
<form method="GET" class="flex items-center gap-3">
  {{-- Search input --}}
  <div class="relative">
    <input type="text" name="search" value="{{ $search ?? '' }}"
           placeholder="Cari nama karyawan"
           class="w-48 lg:w-60 px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg 
                  focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all">
    <button type="submit" class="absolute right-0 top-0 h-full px-3">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none"
           viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M21 21l-4.35-4.35m0 0A7 7 0 1110.65 6.65a7 7 0 016 9.99z" />
      </svg>
    </button>
  </div>

  {{-- FILTER DROPDOWN (Notion / SaaS style) --}}
  <div class="relative">
    <button id="filterBtn" type="button"
      class="flex items-center gap-2 px-4 py-2 border border-gray-300 bg-white rounded-lg 
             text-gray-700 hover:bg-gray-50 active:scale-[0.97] transition select-none">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none"
           viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 4h18M6 8h12M10 12h4M12 16h0" />
      </svg>
      Filters
    </button>

    {{-- Dropdown content: gunakan form fields yang submit via GET --}}
    <div id="filterDropdown"
         class="hidden absolute right-0 mt-2 w-72 bg-white shadow-lg border border-gray-200 rounded-lg overflow-hidden z-50 p-4">
      
      {{-- Gender --}}
      <label class="block text-xs text-gray-500 mb-2">Gender</label>
      <select name="gender" class="w-full mb-3 px-3 py-2 border rounded-lg">
        <option value="">Semua</option>
        <option value="L" {{ (isset($gender) && $gender === 'L') ? 'selected' : '' }}>Laki-laki</option>
        <option value="P" {{ (isset($gender) && $gender === 'P') ? 'selected' : '' }}>Perempuan</option>
      </select>

      {{-- Age range --}}
      <div class="grid grid-cols-2 gap-2 mb-3">
        <div>
          <label class="text-xs text-gray-500">Min umur</label>
          <input type="number" name="min_age" min="0" value="{{ $min_age ?? '' }}"
                 class="w-full px-3 py-2 border rounded-lg" placeholder="Contoh: 25">
        </div>
        <div>
          <label class="text-xs text-gray-500">Max umur</label>
          <input type="number" name="max_age" min="0" value="{{ $max_age ?? '' }}"
                 class="w-full px-3 py-2 border rounded-lg" placeholder="Contoh: 40">
        </div>
      </div>

      {{-- Tempat Lahir --}}
      <div class="mb-3">
        <label class="text-xs text-gray-500">Tempat Lahir</label>
        <input type="text" name="birthplace" value="{{ $birthplace ?? '' }}"
               class="w-full px-3 py-2 border rounded-lg" placeholder="Ketik nama kota...">
      </div>

      {{-- Actions --}}
      <div class="flex items-center justify-between">
        <a href="{{ url()->current() }}" class="text-sm text-gray-500 hover:underline">Reset</a>

        {{-- tombol submit form utama (GET) --}}
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">
          Terapkan
        </button>
      </div>
    </div>
  </div>
</form>
    </div>

    <button id="btnTambahPelamar" onClick="window.location='{{ route('employee.create.index') }}'"
      class="flex items-center gap-2 px-5 py-2.5 rounded-lg text-white font-medium shadow-sm 
             bg-gradient-to-r from-blue-600 to-indigo-600 hover:opacity-90 active:scale-[0.97] transition">

      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M12 4v16m8-8H4" />
      </svg>
      Tambah    
    </button>

  </div>
</div>
<div class="max-w-6xl mx-auto">
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8">
    
    {{-- Header --}}
    <div class="flex justify-between items-center p-6 border-b border-gray-200">
      <h3 class="text-lg font-semibold text-gray-800 tracking-tight">Daftar Pelamar</h3>
    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto">
      <table class="w-full text-sm text-left text-gray-700">
       <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
    <tr>
        <th class="px-6 py-3">
            <label class="chk-container">
                <input type="checkbox" id="selectAll" class="chk-custom">
            </label>
        </th>

        {{-- ======================== --}}
        {{-- SORT: NAMA LENGKAP --}}
        {{-- ======================== --}}
        @php
            $fullNameUrl = route('employee.index', array_merge(request()->all(), [
                'sort_by'  => 'full_name',
                'sort_dir' => ($sortBy === 'full_name' && $sortDir === 'asc') ? 'desc' : 'asc',
            ]));
        @endphp

        <th class="px-6 py-3">
            <button type="button"
                onclick="window.location='{{ $fullNameUrl }}'"
                class="flex items-center gap-1 hover:text-gray-900">

                Nama Lengkap

                <span class="flex flex-col -mt-1">

                    {{-- UP ARROW --}}
                    <svg
                        class="w-3 h-3 {{ $sortBy === 'full_name' && $sortDir === 'asc' ? 'text-blue-600' : 'text-gray-400' }}"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        viewBox="0 0 20 20">
                        <path d="M10 3l5 7H5l5-7z" />
                    </svg>

                    {{-- DOWN ARROW --}}
                    <svg
                        class="w-3 h-3 {{ $sortBy === 'full_name' && $sortDir === 'desc' ? 'text-blue-600' : 'text-gray-400' }}"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        viewBox="0 0 20 20">
                        <path d="M10 17l-5-7h10l-5 7z" />
                    </svg>

                </span>
            </button>
        </th>

        {{-- ======================== --}}
        {{-- SORT: PENDIDIKAN --}}
        {{-- ======================== --}}
        @php
            $educationUrl = route('employee.index', array_merge(request()->all(), [
                'sort_by'  => 'last_education',
                'sort_dir' => ($sortBy === 'last_education' && $sortDir === 'asc') ? 'desc' : 'asc',
            ]));
        @endphp

        <th class="px-6 py-3">
            <button type="button"
                onclick="window.location='{{ $educationUrl }}'"
                class="flex items-center gap-1 hover:text-gray-900">

                Pendidikan

                <span class="flex flex-col -mt-1">

                    {{-- UP --}}
                    <svg
                        class="w-3 h-3 {{ $sortBy === 'last_education' && $sortDir === 'asc' ? 'text-blue-600' : 'text-gray-400' }}"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        viewBox="0 0 20 20">
                        <path d="M10 3l5 7H5l5-7z" />
                    </svg>

                    {{-- DOWN --}}
                    <svg
                        class="w-3 h-3 {{ $sortBy === 'last_education' && $sortDir === 'desc' ? 'text-blue-600' : 'text-gray-400' }}"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        viewBox="0 0 20 20">
                        <path d="M10 17l-5-7h10l-5 7z" />
                    </svg>

                </span>
            </button>
        </th>

        {{-- ======================== --}}
        {{-- SORT: GENDER --}}
        {{-- ======================== --}}
        @php
            $genderUrl = route('employee.index', array_merge(request()->all(), [
                'sort_by'  => 'gender',
                'sort_dir' => ($sortBy === 'gender' && $sortDir === 'asc') ? 'desc' : 'asc',
            ]));
        @endphp

        <th class="px-6 py-3">
            <button type="button"
                onclick="window.location='{{ $genderUrl }}'"
                class="flex items-center gap-1 hover:text-gray-900">

                Jenis Kelamin

                <span class="flex flex-col -mt-1">

                    {{-- UP --}}
                    <svg
                        class="w-3 h-3 {{ $sortBy === 'gender' && $sortDir === 'asc' ? 'text-blue-600' : 'text-gray-400' }}"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        viewBox="0 0 20 20">
                        <path d="M10 3l5 7H5l5-7z" />
                    </svg>

                    {{-- DOWN --}}
                    <svg
                        class="w-3 h-3 {{ $sortBy === 'gender' && $sortDir === 'desc' ? 'text-blue-600' : 'text-gray-400' }}"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        viewBox="0 0 20 20">
                        <path d="M10 17l-5-7h10l-5 7z" />
                    </svg>

                </span>
            </button>
        </th>

        <th class="px-6 py-3 text-right">Aksi</th>
    </tr>
</thead>


        <tbody id="pelamarTableBody">
          @forelse($employees as $index => $employee)
          <tr class="{{ $index > 0 ? 'border-t border-gray-100' : '' }}">

            <td class="px-6 py-4">
              <label class="chk-container">
                <input type="checkbox" class="chk-custom row-check" value="{{ $employee->id }}">
              </label>
            </td>

            <td class="px-6 py-4 font-medium">{{ $employee->full_name }}</td>

            <td class="px-6 py-4">{{ $employee->last_education ?? '-' }}</td>

            <td class="px-6 py-4">
            @php
                $genderLabel = $employee->gender === 'L' ? 'Laki-laki' : 'Perempuan';
            @endphp
                <span class="px-2 py-1 text-xs rounded-lg
                    {{ $employee->gender === 'L'
                        ? 'bg-blue-100 text-blue-700'
                        : 'bg-pink-100 text-pink-700' }}">
                    {{ $genderLabel }}
                </span>
            </td>
            <td class="px-6 py-4 text-right">
              <button class="text-blue-600 hover:underline mr-3"
                      onclick="showDetailModal({{ $employee->id }})">
                Detail
              </button>
              <button class="text-red-600 hover:underline"
                      onclick="deletePelamar({{ $employee->id }})">
                Hapus
              </button>
            </td>

          </tr>
          @empty
          <tr>
            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
              Belum ada data pelamar
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- PAGINATION --}}
    <div class="p-6 border-t border-gray-200">
      <div class="flex justify-center">
        {{ $employees->links() }}
      </div>
    </div>

  </div>
</div>

{{-- SCRIPT --}}
<script>
  const filterBtn = document.getElementById('filterBtn');
  const filterDropdown = document.getElementById('filterDropdown');

  filterBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    filterDropdown.classList.toggle('hidden');
  });

  // close when clicking outside
  window.addEventListener('click', (e) => {
    if (!filterBtn.contains(e.target) && !filterDropdown.contains(e.target)) {
      filterDropdown.classList.add('hidden');
    }
  });
</script>

@endsection
