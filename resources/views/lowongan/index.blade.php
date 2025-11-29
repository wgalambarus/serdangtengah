@extends('layouts.main', ['currentPage' => 'Lowongan'])

@section('title', 'Daftar Lowongan')

@section('content')
<div class="max-w-7xl mx-auto py-10">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Lowongan Pekerjaan</h1>
            <p class="text-gray-500">Kelola lowongan dan lihat siapa saja yang melamar.</p>
        </div>

        <a href="{{ route('lowongan.create') }}"
           class="px-5 py-3 bg-blue-600 text-white rounded-xl shadow-md hover:bg-blue-700 transition font-semibold">
            + Tambah Lowongan
        </a>
    </div>

    {{-- GRID LOWONGAN --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse ($lowongans as $job)
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg transition p-6 flex flex-col">

                {{-- JUDUL --}}
                <h3 class="text-xl font-bold text-gray-800 leading-tight mb-2">
                    {{ $job->title }}
                </h3>

                {{-- DESKRIPSI --}}
                <p class="text-gray-600 text-sm leading-relaxed mb-5">
                    {{ Str::limit($job->description, 170) }}
                </p>

                {{-- STATUS + LOKASI --}}
                <div class="flex items-center justify-between text-sm mb-6">
                    {{-- STATUS BADGE --}}
                    <span class="px-3 py-1 rounded-lg text-white text-xs font-medium
                        {{ $job->is_active ? 'bg-green-500' : 'bg-red-500' }}">
                        {{ $job->is_active ? 'Aktif' : 'Tidak Aktif' }}
                    </span>

                    {{-- LOCATION --}}
                    <span class="text-gray-500 flex items-center gap-1 text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-width="2"
                                  d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
                        </svg>
                        {{ $job->location }}
                    </span>
                </div>

                {{-- ACTION BUTTONS --}}
                <div class="mt-auto flex flex-col gap-2">

                    {{-- Lihat Pelamar --}}
                    <a href="{{ route('lowongan.applicants', $job->id) }}"
                       class="w-full text-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                        Lihat Pelamar →
                    </a>

                    {{-- Edit lowongan --}}
                    <a href="{{ route('lowongan.edit', $job->id) }}"
                       class="w-full text-center px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition">
                        Edit Lowongan
                    </a>

                    {{-- Activate / Deactivate --}}
                    @if ($job->is_active)
                        <form action="{{ route('lowongan.disable', $job->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="w-full px-4 py-2 bg-red-50 text-red-600 font-medium rounded-lg hover:bg-red-100 transition">
                                Nonaktifkan Lowongan
                            </button>
                        </form>
                    @else
                        <form action="{{ route('lowongan.enable', $job->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="w-full px-4 py-2 bg-green-50 text-green-600 font-medium rounded-lg hover:bg-green-100 transition">
                                Aktifkan Lowongan
                            </button>
                        </form>
                    @endif
                </div>

            </div>
        @empty
            <p class="text-gray-500 text-center col-span-full">Belum ada lowongan tersedia.</p>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div class="mt-10">
        {{ $lowongans->links('pagination::tailwind') }}
    </div>

</div>
@endsection
