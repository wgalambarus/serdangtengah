@extends('layouts.main', ['currentPage' => 'Karyawan'])

@section('title', 'Detail Karyawan')

@section('content')
<div class="max-w-4xl mx-auto py-12">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Detail Data Karyawan</h2>
        <a href="{{ route('employee.index') }}" class="text-blue-600 hover:underline text-sm">&larr; Kembali ke daftar</a>
    </div>

    <form method="POST" action="{{ route('employee.update', $employee) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white shadow-md border border-gray-200 rounded-xl p-8 mb-8">
            <h3 class="text-xl font-semibold mb-4">Informasi Umum</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- full_name --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $employee->full_name) }}" 
                        disabled
                        class="w-full px-4 py-3 bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 transition @error('full_name') border-red-500 @enderror">
                    @error('full_name')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- national_id --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">NIK KTP *</label>
                    <input type="text" name="national_id" maxlength="20" 
                        value="{{ old('national_id', $employee->national_id) }}" 
                        disabled
                        class="w-full px-4 py-3 bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 transition @error('national_id') border-red-500 @enderror">
                    @error('national_id')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- email --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input type="email" name="email" 
                        value="{{ old('email', $employee->email) }}" 
                        class="w-full px-4 py-3 bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 transition @error('email') border-red-500 @enderror">
                    @error('email')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- phone --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP *</label>
                    <input type="text" name="phone" maxlength="15" 
                        value="{{ old('phone', $employee->phone) }}" 
                        disabled
                        class="w-full px-4 py-3 bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 transition @error('phone') border-red-500 @enderror">
                    @error('phone')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- birth_place --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir *</label>
                    <input type="text" name="birth_place" 
                        value="{{ old('birth_place', $employee->birth_place) }}" 
                        disabled
                        class="w-full px-4 py-3 bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 transition @error('birth_place') border-red-500 @enderror">
                    @error('birth_place')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- birth_date --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir *</label>
                    <input type="date" name="birth_date" 
                        value="{{ old('birth_date', $employee->birth_date?->format('Y-m-d')) }}" 
                        disabled
                        class="w-full px-4 py-3 bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 transition @error('birth_date') border-red-500 @enderror">
                    @error('birth_date')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- gender --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin *</label>
                    <select name="gender" 
                        disabled
                        class="w-full px-4 py-3 bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 transition @error('gender') border-red-500 @enderror">
                        <option value="">Pilih...</option>
                        <option value="L" {{ old('gender', $employee->gender)=='L'?'selected':'' }}>Laki-laki</option>
                        <option value="P" {{ old('gender', $employee->gender)=='P'?'selected':'' }}>Perempuan</option>
                    </select>
                    @error('gender')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- marital_status --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Pernikahan *</label>
                    <input type="text" name="marital_status" 
                        disabled
                        value="{{ old('marital_status', $employee->marital_status) }}" 
                        class="w-full px-4 py-3 bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 transition">
                </div>  

                {{-- last_education --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan Terakhir *</label>
                    <input type="text" name="last_education" 
                        value="{{ old('last_education', $employee->last_education) }}" 
                        class="w-full px-4 py-3 bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 transition">
                </div>

                {{-- religion --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Agama *</label>
                    <input type="text" name="religion" 
                        value="{{ old('religion', $employee->religion) }}" 
                        class="w-full px-4 py-3 bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 transition">
                </div>

                {{-- blood_type --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Golongan Darah *</label>
                    <input type="text" name="blood_type" 
                        value="{{ old('blood_type', $employee->blood_type) }}" 
                        class="w-full px-4 py-3 bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 transition">
                </div>

                {{-- bpjs_tk --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">BPJS Ketenagakerjaan</label>
                    <input type="text" name="bpjs_tk" 
                        value="{{ old('bpjs_tk', $employee->bpjs_tk) }}" 
                        class="w-full px-4 py-3 bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 transition">
                </div>

                {{-- bpjs_kes --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">BPJS Kesehatan</label>
                    <input type="text" name="bpjs_kes" 
                        value="{{ old('bpjs_kes', $employee->bpjs_kes) }}" 
                        class="w-full px-4 py-3 bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 transition">
                </div>

                {{-- npwp --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">NPWP</label>
                    <input type="text" name="npwp" 
                        value="{{ old('npwp', $employee->npwp) }}" 
                        class="w-full px-4 py-3 bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 transition">
                </div>

                {{-- emergency info --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kontak Darurat</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <input type="text" name="emergency_name" placeholder="Nama" 
                            value="{{ old('emergency_name', $employee->emergency_name) }}" 
                            class="w-full px-4 py-3 bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 transition">
                        <input type="text" name="emergency_relation" placeholder="Hubungan" 
                            value="{{ old('emergency_relation', $employee->emergency_relation) }}" 
                            class="w-full px-4 py-3 bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 transition">
                        <input type="text" name="emergency_phone" placeholder="Telepon" 
                            value="{{ old('emergency_phone', $employee->emergency_phone) }}" 
                            class="w-full px-4 py-3 bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 transition">
                    </div>
                </div>
            </div>
        </div>

        <!-- address section -->
        <div class="bg-white shadow-md border border-gray-200 rounded-xl p-8 mb-8">
            <h3 class="text-xl font-semibold mb-4">Alamat</h3>

            <h4 class="font-medium">Alamat KTP</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <textarea name="ktp_address" rows="2" class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition border border-gray-300">{{ old('ktp_address', optional($ktpAddress)->address_line) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                    <input type="text" name="ktp_province" value="{{ old('ktp_province', optional($ktpAddress)->province) }}" class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition border border-gray-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                    <input type="text" name="ktp_city" value="{{ old('ktp_city', optional($ktpAddress)->city) }}" class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition border border-gray-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                    <input type="text" name="ktp_district" value="{{ old('ktp_district', optional($ktpAddress)->district) }}" class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition border border-gray-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kelurahan</label>
                    <input type="text" name="ktp_village" value="{{ old('ktp_village', optional($ktpAddress)->village) }}" class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition border border-gray-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                    <input type="text" name="ktp_postal" value="{{ old('ktp_postal', optional($ktpAddress)->postal_code) }}" class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition border border-gray-300">
                </div>
            </div>

            <h4 class="font-medium">Alamat Domisili</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <textarea name="dom_address" rows="2" class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition border border-gray-300">{{ old('dom_address', optional($currentAddress)->address_line) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                    <input type="text" name="dom_province" value="{{ old('dom_province', optional($currentAddress)->province) }}" class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition border border-gray-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                    <input type="text" name="dom_city" value="{{ old('dom_city', optional($currentAddress)->city) }}" class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition border border-gray-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                    <input type="text" name="dom_district" value="{{ old('dom_district', optional($currentAddress)->district) }}" class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition border border-gray-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kelurahan</label>
                    <input type="text" name="dom_village" value="{{ old('dom_village', optional($currentAddress)->village) }}" class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition border border-gray-300">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                    <input type="text" name="dom_postal" value="{{ old('dom_postal', optional($currentAddress)->postal_code) }}" class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition border border-gray-300">
                </div>
            </div>
        </div>

<!-- pendidikan section -->
<div class="bg-white shadow-md border border-gray-200 rounded-xl p-8 mb-8">
    <h3 class="text-xl font-semibold mb-4">Riwayat Pendidikan</h3>

    <div id="educationContainer" class="space-y-12">

        {{-- Jika ada old input (validation error) --}}
        @if(old('school_name'))

            @foreach(old('school_name') as $i => $val)
                @include('employees.create.partials._education_row', [
                    'index' => $i,
                    'school_name' => old("school_name.$i"),
                    'city'        => old("city.$i"),
                    'major'       => old("major.$i"),
                    'year_in'     => old("year_in.$i"),
                    'year_out'    => old("year_out.$i"),
                ])
            @endforeach


        {{-- Jika ada data dari database --}}
        @elseif($educations->count())

            @foreach($educations as $i => $edu)
                @include('employees.create.partials._education_row', [
                    'index' => $i,
                    'school_name' => $edu->school_name ?? '',
                    'city'        => $edu->city ?? '',
                    'major'       => $edu->major ?? '',
                    'year_in'     => $edu->year_in ?? '',
                    'year_out'    => $edu->year_out ?? '',
                ])
            @endforeach


        {{-- Jika tidak ada data sama sekali --}}
        @else

            @include('employees.create.partials._education_row', [
                'index' => 0,
                'school_name' => '',
                'city'        => '',
                'major'       => '',
                'year_in'     => '',
                'year_out'    => '',
            ])

        @endif

    </div>
</div>

        <!-- dependents section -->
        <div class="bg-white shadow-md border border-gray-200 rounded-xl p-8 mb-8">
            <h3 class="text-xl font-semibold mb-4">Tanggungan</h3>
            <div id="dependentContainer" class="space-y-12">
                @if(old('dependent_name'))
                    @foreach(old('dependent_name') as $i => $val)
                        @include('employees.create.partials._dependent_row', [
                            'name' => old("dependent_name.$i"),
                            'birth' => old("dependent_birth.$i"),
                            'gender' => old("dependent_gender.$i"),
                            'education' => old("dependent_education.$i"),
                        ])
                    @endforeach
                @elseif(isset($children) && $children->count())
                    @foreach($children as $i => $child)
                        @include('employees.create.partials._dependent_row', [
                            'name' => $child->name,
                            'birth' => $child->birth_date,
                            'gender' => $child->gender,
                            'education' => $child->last_education,
                        ])
                    @endforeach
                @else
                    @include('employees.create.partials._dependent_row', [
                        'name' => '',
                        'birth' => '',
                        'gender' => '',
                        'education' => '',
                    ])
                @endif
            </div>
        </div>

        <!-- job history section -->
        <div class="bg-white shadow-md border border-gray-200 rounded-xl p-8 mb-8">
            <h3 class="text-xl font-semibold mb-4">Riwayat Pekerjaan</h3>
            <div id="workContainer" class="space-y-12">
                @if(old('position'))
                    @foreach(old('position') as $i => $v)
                        @include('employees.create.partials._work_row', [
                            'index' => $i,
                            'position' => old("position.$i"),
                            'work_unit' => old("work_unit.$i"),
                            'start_date' => old("start_date.$i"),
                            'work_note' => old("work_note.$i"),
                        ])
                    @endforeach
                @elseif(isset($jobHistory) && $jobHistory->count())
                    @foreach($jobHistory as $i => $job)
                        @include('employees.create.partials._work_row', [
                            'index' => $i,
                            'position' => $job->status,
                            'work_unit' => $job->unit,
                            'start_date' => $job->start_date,
                            'work_note' => $job->note,
                        ])
                    @endforeach
                @else
                    @include('employees.create.partials._work_row', [
                        'index' => 0,
                        'position' => '',
                        'work_unit' => '',
                        'start_date' => '',
                        'work_note' => '',
                    ])
                @endif
            </div>
        </div>

        <!-- training section -->
        <!-- training section -->
<div class="bg-white shadow-md border border-gray-200 rounded-xl p-8 mb-8">
  <h3 class="text-xl font-semibold mb-6">Training / Pelatihan</h3>

  <div class="space-y-8">

    @forelse($trainings as $training)

    <div class="p-8 border border-gray-200 rounded-xl bg-gray-50 shadow-sm">

      <div class="flex items-center justify-between mb-6">
        <h4 class="text-sm font-semibold text-gray-700">Data Pelatihan</h4>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- NAMA TRAINING --}}
        <div>
          <p class="text-sm font-medium text-gray-700 mb-1">Nama Training</p>
          <p class="text-gray-800">{{ $training->title }}</p>
        </div>

        {{-- PROVIDER --}}
        <div>
          <p class="text-sm font-medium text-gray-700 mb-1">Penyelenggara</p>
          <p class="text-gray-800">{{ $training->provider }}</p>
        </div>

        {{-- TAHUN --}}
        <div>
          <p class="text-sm font-medium text-gray-700 mb-1">Tahun</p>
          <p class="text-gray-800">{{ $training->year }}</p>
        </div>

        {{-- LOKASI --}}
        <div>
          <p class="text-sm font-medium text-gray-700 mb-1">Lokasi</p>
          <p class="text-gray-800">{{ $training->location }}</p>
        </div>

        {{-- CERTIFICATE --}}
        <div class="md:col-span-2">
          <p class="text-sm font-medium text-gray-700 mb-2">Sertifikat</p>

          @if($training->certificate_path)

            <a href="{{ asset('storage/'.$training->certificate_path) }}"
               target="_blank"
               class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg shadow-sm hover:bg-blue-100">
              📄 Lihat Sertifikat
            </a>

          @else
            <p class="text-gray-400 italic">Tidak ada sertifikat</p>
          @endif

        </div>

      </div>

    </div>

    @empty

    <div class="text-gray-500 italic">
      Tidak ada data pelatihan.
    </div>

    @endforelse

  </div>
</div>

<!-- dokumen section -->
<div class="bg-white shadow-md border border-gray-200 rounded-xl p-8 mb-8">

    <h3 class="text-xl font-semibold mb-6">Dokumen Karyawan</h3>

    <div class="p-8 border border-gray-200 rounded-xl bg-gray-50 shadow-sm">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            @php
                $files = [
                    'CV' => $employee->file->cv ?? null,
                    'Pas Foto' => $employee->file->pas_foto ?? null,
                    'KTP' => $employee->file->ktp ?? null,
                    'Ijazah' => $employee->file->ijazah ?? null,
                    'Transkrip Nilai' => $employee->file->transkrip_nilai ?? null,
                    'Kartu BPJS' => $employee->file->kartu_bpjs ?? null,
                    'Surat Pengalaman Kerja' => $employee->file->suket_pengalaman_kerja ?? null,
                    'Daftar Riwayat Hidup' => $employee->file->daftar_riwayat_hidup ?? null,
                ];
            @endphp

            @foreach($files as $label => $path)

                <div>
                    <p class="text-sm font-medium text-gray-700 mb-2">{{ $label }}</p>

                    @if($path)

                        <a href="{{ asset('storage/'.$path) }}"
                           target="_blank"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg shadow-sm hover:bg-blue-100 transition text-sm">

                            📄 Lihat Dokumen

                        </a>

                    @else

                        <p class="text-gray-400 italic text-sm">
                            Tidak tersedia
                        </p>

                    @endif

                </div>

            @endforeach

        </div>

    </div>

</div>

    </form>

<a href="{{ route('employee.print', $employee->id) }}" target="_blank">
    Cetak Form
</a>
</div>

{{-- scripts for dynamic rows --}}
<script>
function addEducationRow() {
    const container = document.getElementById('educationContainer');
    const clone = container.children[0].cloneNode(true);
    clone.querySelectorAll('input').forEach(i => i.value = '');
    container.appendChild(clone);
}
function removeEducationRow(btn) {
    const container = document.getElementById('educationContainer');
    if (container.children.length > 1) {
        btn.closest('div.p-8').remove();
    }
}

function addDependentRow() {
    const container = document.getElementById('dependentContainer');
    const clone = container.children[0].cloneNode(true);
    clone.querySelectorAll('input, select').forEach(el => el.value = '');
    container.appendChild(clone);
}
function removeDependentRow(btn) {
    const container = document.getElementById('dependentContainer');
    if (container.children.length > 1) {
        btn.closest('div.p-8').remove();
    }
}

// Disable all input, select, textarea elements on page load
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('input, select, textarea').forEach(function(el) {
        el.disabled = true;
    });
});

function addWorkRow() {
    const container = document.getElementById('workContainer');
    const clone = container.children[0].cloneNode(true);
    clone.querySelectorAll('input, select, textarea').forEach(el => el.value = '');
    container.appendChild(clone);
}
function removeWorkRow(btn) {
    const container = document.getElementById('workContainer');
    if (container.children.length > 1) {
        btn.closest('div.p-8').remove();
    }
}

function addTrainingRow() {
    const container = document.getElementById('trainingContainer');
    const clone = container.children[0].cloneNode(true);
    clone.querySelectorAll('input, textarea').forEach(el => el.value = '');
    container.appendChild(clone);
}
function removeTrainingRow(btn) {
    const container = document.getElementById('trainingContainer');
    if (container.children.length > 1) {
        btn.closest('div.p-8').remove();
    }
}

function onlyString(input) {
    input.value = input.value.replace(/[^A-Za-z\s]/g, '');
}
</script>
@endsection
