@extends('layouts.main', ['currentPage' => 'Lowongan'])

@section('title', 'Tambah Lowongan')

@section('content')
<div class="max-w-4xl mx-auto py-10">

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-1">Tambah Lowongan Baru</h1>
        <p class="text-gray-500">Isi detail lowongan pekerjaan dengan jelas dan lengkap.</p>
    </div>

    {{-- CARD WRAPPER --}}
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-8">

        <form action="{{ route('lowongan.store') }}" method="POST">
            @csrf

            <div class="space-y-6">

                {{-- TITLE --}}
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Judul Lowongan</label>
                    <input type="text" name="title"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500"
                           placeholder="Contoh: Frontend Developer" required>
                </div>

                {{-- DESCRIPTION --}}
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Deskripsi Pekerjaan</label>
                    <textarea name="description" rows="5"
                              class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500"
                              placeholder="Tuliskan deskripsi pekerjaan, tanggung jawab, dan benefit..." required></textarea>
                </div>

                {{-- LOCATION + SALARY --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Lokasi</label>
                        <input type="text" name="location"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500"
                               placeholder="Contoh: Jakarta, Bandung..." required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Gaji (Opsional)</label>
                        <input type="text" name="salary"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500"
                               placeholder="Contoh: 8.000.000 - 12.000.000">
                    </div>
                </div>

                {{-- DATE RANGE --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Tanggal Mulai</label>
                        <input type="date" name="start_date"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500"
                               required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Tanggal Selesai</label>
                        <input type="date" name="end_date"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500"
                               required>
                    </div>

                </div>

                {{-- STATUS --}}
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Status</label>
                    <select name="is_active"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500">
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>

            </div>

            {{-- SUBMIT BUTTON --}}
            <div class="mt-10 flex justify-end">
                <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition">
                    Simpan Lowongan
                </button>
            </div>

        </form>

    </div>
</div>
@endsection
