@extends('layouts.main', ['currentPage' => 'Karyawan'])

@section('title', 'Review Data Karyawan')

@section('content')
<div class="max-w-5xl mx-auto py-12">

    <!-- TITLE -->
    <div class="mb-10">
        <h2 class="text-3xl font-bold text-gray-900">Review Data Karyawan</h2>
        <p class="text-gray-600 mt-2">
            Periksa kembali seluruh data sebelum disimpan ke sistem.
            Jika ada yang perlu diperbaiki, tekan tombol <strong>Kembali</strong>.
        </p>
    </div>

    @php
        $d = session('employee_wizard');
    @endphp

    <!-- CARD STYLE -->
    @php
        $cardClass = "mb-10 p-8 bg-white border border-gray-200 rounded-2xl shadow-sm";
        $tableHead = "bg-gray-100 text-gray-700 text-sm";
        $tableCell = "p-3 border text-sm";
    @endphp


    {{-- ========================================================
                        INFORMASI UMUM
    ========================================================= --}}
    <div class="{{ $cardClass }}">
        <h3 class="font-semibold text-xl text-gray-900 mb-6">Informasi Umum</h3>

        <div class="grid grid-cols-2 gap-6 text-sm">
            <p><strong>Nama:</strong> {{ $d['informasi-umum']['full_name'] }}</p>
            <p><strong>NIK:</strong> {{ $d['informasi-umum']['national_id'] }}</p>

            <p><strong>Email:</strong> {{ $d['informasi-umum']['email'] }}</p>
            <p><strong>Telepon:</strong> {{ $d['informasi-umum']['phone'] }}</p>

            <p><strong>Tempat Lahir:</strong> {{ $d['informasi-umum']['birth_place'] }}</p>
            <p><strong>Tanggal Lahir:</strong> {{ $d['informasi-umum']['birth_date'] }}</p>

            <p><strong>Jenis Kelamin:</strong> {{ $d['informasi-umum']['gender'] }}</p>
            <p><strong>Status Kawin:</strong> {{ $d['informasi-umum']['marital_status'] }}</p>

            <p><strong>Pendidikan Terakhir:</strong> {{ $d['informasi-umum']['last_education'] }}</p>
            <p><strong>Agama:</strong> {{ $d['informasi-umum']['religion'] }}</p>
        </div>
    </div>


    {{-- ========================================================
                        ALAMAT
    ========================================================= --}}
    <div class="{{ $cardClass }}">
        <h3 class="font-semibold text-xl text-gray-900 mb-6">Alamat</h3>

        <div class="text-sm space-y-6">

            <div>
                <h4 class="font-medium text-gray-800 mb-1">Alamat KTP</h4>
                <div class="pl-3 border-l-4 border-blue-400">
                    <p>{{ $d['alamat-karyawan']['ktp_address'] }}</p>
                    <p>{{ $d['alamat-karyawan']['ktp_city'] }}, {{ $d['alamat-karyawan']['ktp_province'] }}</p>
                </div>
            </div>

            <div>
                <h4 class="font-medium text-gray-800 mb-1">Alamat Domisili</h4>
                <div class="pl-3 border-l-4 border-green-400">
                    <p>{{ $d['alamat-karyawan']['dom_address'] }}</p>
                    <p>{{ $d['alamat-karyawan']['dom_city'] }}, {{ $d['alamat-karyawan']['dom_province'] }}</p>
                </div>
            </div>

        </div>
    </div>



    {{-- ========================================================
                        PENDIDIKAN
    ========================================================= --}}
    <div class="{{ $cardClass }}">
        <h3 class="font-semibold text-xl text-gray-900 mb-6">Riwayat Pendidikan</h3>

        <table class="w-full border rounded-lg overflow-hidden">
            <thead class="{{ $tableHead }}">
                <tr>
                    <th class="{{ $tableCell }}">Nama Sekolah</th>
                    <th class="{{ $tableCell }}">Kota</th>
                    <th class="{{ $tableCell }}">Jurusan</th>
                    <th class="{{ $tableCell }}">Masuk</th>
                    <th class="{{ $tableCell }}">Lulus</th>
                </tr>
            </thead>
            <tbody>
                @foreach($d['pendidikan']['school_name'] as $i => $v)
                <tr class="hover:bg-gray-50">
                    <td class="{{ $tableCell }}">{{ $v }}</td>
                    <td class="{{ $tableCell }}">{{ $d['pendidikan']['city'][$i] }}</td>
                    <td class="{{ $tableCell }}">{{ $d['pendidikan']['major'][$i] }}</td>
                    <td class="{{ $tableCell }}">{{ $d['pendidikan']['year_in'][$i] }}</td>
                    <td class="{{ $tableCell }}">{{ $d['pendidikan']['year_out'][$i] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>



    {{-- ========================================================
                        TANGGUNGAN
    ========================================================= --}}
    <div class="{{ $cardClass }}">
        <h3 class="font-semibold text-xl text-gray-900 mb-6">Tanggungan Keluarga</h3>

        @if(!empty($d['tanggungan']['dependent_name']))
            <table class="w-full border rounded-lg overflow-hidden">
                <thead class="{{ $tableHead }}">
                    <tr>
                        <th class="{{ $tableCell }}">Nama</th>
                        <th class="{{ $tableCell }}">Gender</th>
                        <th class="{{ $tableCell }}">Tgl Lahir</th>
                        <th class="{{ $tableCell }}">Pendidikan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($d['tanggungan']['dependent_name'] as $i => $v)
                    <tr class="hover:bg-gray-50">
                        <td class="{{ $tableCell }}">{{ $v }}</td>
                        <td class="{{ $tableCell }}">{{ $d['tanggungan']['dependent_gender'][$i] }}</td>
                        <td class="{{ $tableCell }}">{{ $d['tanggungan']['dependent_birth'][$i] }}</td>
                        <td class="{{ $tableCell }}">{{ $d['tanggungan']['dependent_education'][$i] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500 text-sm">Tidak ada data tanggungan.</p>
        @endif
    </div>



    {{-- ========================================================
                        PEKERJAAN
    ========================================================= --}}
    <div class="{{ $cardClass }}">
        <h3 class="font-semibold text-xl text-gray-900 mb-6">Riwayat Pekerjaan</h3>

        <table class="w-full border rounded-lg overflow-hidden">
            <thead class="{{ $tableHead }}">
                <tr>
                    <th class="{{ $tableCell }}">Posisi</th>
                    <th class="{{ $tableCell }}">Unit</th>
                    <th class="{{ $tableCell }}">Mulai</th>
                    <th class="{{ $tableCell }}">Selesai</th>
                    <th class="{{ $tableCell }}">Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($d['pekerjaan']['position'] as $i => $v)
                <tr class="hover:bg-gray-50">
                    <td class="{{ $tableCell }}">{{ $v }}</td>
                    <td class="{{ $tableCell }}">{{ $d['pekerjaan']['work_unit'][$i] }}</td>
                    <td class="{{ $tableCell }}">{{ $d['pekerjaan']['start_date'][$i] }}</td>
                    <td class="{{ $tableCell }}">{{ $d['pekerjaan']['end_date'][$i] }}</td>
                    <td class="{{ $tableCell }}">{{ $d['pekerjaan']['work_note'][$i] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>



    {{-- ========================================================
                        TRAINING
    ========================================================= --}}
    <div class="{{ $cardClass }}">
        <h3 class="font-semibold text-xl text-gray-900 mb-6">Riwayat Pelatihan</h3>

        <table class="w-full border rounded-lg overflow-hidden">
            <thead class="{{ $tableHead }}">
                <tr>
                    <th class="{{ $tableCell }}">Pelatihan</th>
                    <th class="{{ $tableCell }}">Provider</th>
                    <th class="{{ $tableCell }}">Tahun</th>
                    <th class="{{ $tableCell }}">Lokasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($d['pelatihan']['training_name'] as $i => $v)
                <tr class="hover:bg-gray-50">
                    <td class="{{ $tableCell }}">{{ $v }}</td>
                    <td class="{{ $tableCell }}">{{ $d['pelatihan']['training_provider'][$i] }}</td>
                    <td class="{{ $tableCell }}">{{ $d['pelatihan']['training_year'][$i] }}</td>
                    <td class="{{ $tableCell }}">{{ $d['pelatihan']['training_location'][$i] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>



    {{-- ========================================================
                        BUTTON
    ========================================================= --}}
    <div class="flex justify-between mt-12">

        <a href="{{ route('employee.create.step', 'pelatihan') }}"
           class="px-6 py-3 bg-gray-200 rounded-lg hover:bg-gray-300 transition font-medium text-gray-700">
            ← Kembali
        </a>

        <form action="{{ route('employee.create.finish') }}" method="POST">
            @csrf
            <button class="px-8 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition font-semibold">
                ✓ Konfirmasi & Simpan
            </button>
        </form>

    </div>

</div>
@endsection
