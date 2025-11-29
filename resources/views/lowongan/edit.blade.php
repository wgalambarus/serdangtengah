@extends('layouts.main', ['currentPage' => 'Lowongan'])

@section('title', 'Edit Lowongan')

@section('content')
<div class="max-w-4xl mx-auto py-10">

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-1">Edit Lowongan</h1>
        <p class="text-gray-500">Perbarui informasi lowongan pekerjaan.</p>
    </div>

    {{-- CARD --}}
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-8">

        <form action="{{ route('lowongan.update', $job->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                
                {{-- TITLE --}}
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Judul Lowongan</label>
                    <input type="text" name="title" value="{{ $job->title }}"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500" required>
                </div>

                {{-- DESCRIPTION --}}
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Deskripsi</label>
                    <textarea name="description" rows="5"
                              class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500"
                              required>{{ $job->description }}</textarea>
                </div>

                {{-- LOCATION + SALARY --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Lokasi</label>
                        <input type="text" name="location" value="{{ $job->location }}"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Gaji</label>
                        <input type="text" name="salary" value="{{ $job->salary }}"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500">
                    </div>

                </div>

                {{-- DATE --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Tanggal Mulai</label>
                        <input type="date" name="start_date" value="{{ $job->start_date }}"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Tanggal Selesai</label>
                        <input type="date" name="end_date" value="{{ $job->end_date }}"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500" required>
                    </div>

                </div>

                {{-- ACTIVE --}}
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Status</label>
                    <select name="is_active"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500">
                        <option value="1" {{ $job->is_active ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ !$job->is_active ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

            </div>

            {{-- SAVE BUTTON --}}
            <div class="mt-10 flex justify-end">
                <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
                    Simpan Perubahan
                </button>
            </div>

        </form>

    </div>

</div>
@endsection
