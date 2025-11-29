@extends('layouts.main', ['currentPage' => 'Lowongan'])

@section('title', 'Pelamar Lowongan')

@section('content')

<div class="max-w-6xl mx-auto py-10">

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Pelamar untuk: {{ $job->title }}</h1>
        <p class="text-gray-500 text-sm">Daftar semua pelamar yang telah mengajukan lamaran untuk posisi ini.</p>
    </div>


    {{-- SEARCH + SORT BAR --}}
    <div class="flex flex-col lg:flex-row justify-between items-center gap-4 mb-6">

        <form method="GET" class="flex items-center w-full lg:w-auto">

            {{-- SEARCH --}}
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari nama pelamar..."
                       class="w-64 px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg
                              focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all">

                <button type="submit" class="absolute right-0 top-0 h-full px-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m0 0A7 7 0 1110.65 6.65a7 7 0 016 9.99z" />
                    </svg>
                </button>
            </div>

            {{-- SORT BUTTON --}}
            <div class="relative ml-3">

                <button id="sortBtn" type="button"
                    class="flex items-center gap-2 px-4 py-2 border border-gray-300 bg-white rounded-lg
                           text-gray-700 hover:bg-gray-50 active:scale-[0.97] transition">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4h18M6 8h12M10 12h4" />
                    </svg>
                    Sort By
                </button>

                {{-- SORT DROPDOWN --}}
                <div id="sortDropdown"
                    class="hidden absolute right-0 mt-2 w-52 bg-white shadow-lg border border-gray-200 rounded-lg overflow-hidden z-50">

                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'name_asc']) }}"
                       class="block px-4 py-2 text-sm hover:bg-gray-50 text-gray-700">Nama A–Z</a>

                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'name_desc']) }}"
                       class="block px-4 py-2 text-sm hover:bg-gray-50 text-gray-700">Nama Z–A</a>

                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}"
                       class="block px-4 py-2 text-sm hover:bg-gray-50 text-gray-700">Terbaru Lamar</a>

                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'oldest']) }}"
                       class="block px-4 py-2 text-sm hover:bg-gray-50 text-gray-700">Terlama Lamar</a>

                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'score_high']) }}"
                       class="block px-4 py-2 text-sm hover:bg-gray-50 text-gray-700">Skor Tertinggi</a>

                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'score_low']) }}"
                       class="block px-4 py-2 text-sm hover:bg-gray-50 text-gray-700">Skor Terendah</a>
                </div>
            </div>

        </form>

    </div>



    {{-- TABLE WRAPPER --}}
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr class="text-gray-700">
                    <th class="py-3 px-6 font-semibold text-left">Nama</th>
                    <th class="py-3 px-6 font-semibold text-left">Email</th>
                    <th class="py-3 px-6 font-semibold text-left">Telepon</th>
                    <th class="py-3 px-6 font-semibold text-left">Skor</th>
                    <th class="py-3 px-6 font-semibold text-left">Tanggal Lamar</th>
                    <th class="py-3 px-6 font-semibold text-right">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @forelse ($pelamars as $pelamar)
                <tr class="hover:bg-gray-50 transition">

                    {{-- Nama --}}
                    <td class="py-3 px-6 font-medium text-gray-800">
                        {{ $pelamar->nama_lengkap }}
                    </td>

                    {{-- Email --}}
                    <td class="py-3 px-6 text-gray-600">
                        {{ $pelamar->email ?? '-' }}
                    </td>

                    {{-- Telepon --}}
                    <td class="py-3 px-6 text-gray-600">
                        {{ $pelamar->nomor_hp ?? '-' }}
                    </td>

                    {{-- Skor --}}
                    <td class="py-3 px-6 font-semibold text-gray-800">
                        {{ $pelamar->pivot->score ?? '—' }}
                    </td>

                    {{-- Tanggal Lamar --}}
                    <td class="py-3 px-6 text-gray-600">
                        {{ optional($pelamar->pivot->created_at)->format('d M Y') }}
                    </td>

                    {{-- Action Buttons --}}
                    <td class="py-3 px-6 text-right flex justify-end gap-2">

                        {{-- DETAIL PELAMAR --}}
                        <a href="{{ route('pelamar.show', $pelamar->id) }}"
                           class="px-3 py-1.5 text-blue-600 bg-blue-50 text-sm font-medium rounded-md hover:bg-blue-100 transition">
                            Detail
                        </a>

                        {{-- LIHAT CV --}}
                        <a href="{{ asset('storage/' . $pelamar->cv) }}"
                           target="_blank"
                           class="px-3 py-1.5 text-gray-700 bg-gray-100 text-sm font-medium rounded-md hover:bg-gray-200 transition">
                            Lihat CV
                        </a>

                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="6" class="py-10 px-6 text-center text-gray-500">
                        Belum ada pelamar untuk lowongan ini.
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

        {{-- PAGINATION --}}
        <div class="p-6 border-t border-gray-200">
            {{ $pelamars->links() }}
        </div>

    </div>

</div>



{{-- SORT DROPDOWN SCRIPT --}}
<script>
    const sortBtn = document.getElementById('sortBtn');
    const sortDropdown = document.getElementById('sortDropdown');

    sortBtn?.addEventListener('click', (e) => {
        e.stopPropagation();
        sortDropdown.classList.toggle('hidden');
    });

    window.addEventListener('click', () => sortDropdown.classList.add('hidden'));
</script>

@endsection
