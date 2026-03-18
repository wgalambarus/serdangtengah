@extends('layouts.main', ['currentPage' => 'Karyawan'])

@section('title', 'Edit Karyawan')

@section('content')
<div class="max-w-4xl mx-auto py-12">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Edit Data Karyawan</h2>
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
                           class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition 
                                  @error('full_name') border-red-500 @else border-gray_300 @enderror">
                    @error('full_name')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- national_id --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">NIK KTP *</label>
                    <input type="text" name="national_id" maxlength="20" 
                           value="{{ old('national_id', $employee->national_id) }}" 
                           class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition 
                                  @error('national_id') border-red-500 @else border_gray-300 @enderror">
                    @error('national_id')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- email --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input type="email" name="email" 
                           value="{{ old('email', $employee->email) }}" 
                           class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition 
                                  @error('email') border-red-500 @else border-gray_300 @enderror">
                    @error('email')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- phone --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP *</label>
                    <input type="text" name="phone" maxlength="15" 
                           value="{{ old('phone', $employee->phone) }}" 
                           class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition 
                                  @error('phone') border-red-500 @else border-gray_300 @enderror">
                    @error('phone')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- birth_place --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir *</label>
                    <input type="text" name="birth_place" 
                           value="{{ old('birth_place', $employee->birth_place) }}" 
                           class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition 
                                  @error('birth_place') border-red-500 @else border_gray-300 @enderror">
                    @error('birth_place')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- birth_date --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir *</label>
                    <input type="date" name="birth_date" 
                           value="{{ old('birth_date', $employee->birth_date?->format('Y-m-d')) }}" 
                           class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition 
                                  @error('birth_date') border-red-500 @else border_gray-300 @enderror">
                    @error('birth_date')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- gender --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin *</label>
                    <select name="gender" 
                            class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition 
                                   @error('gender') border-red-500 @else border_gray-300 @enderror">
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
                           value="{{ old('marital_status', $employee->marital_status) }}" 
                           class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">
                </div>

                {{-- last_education --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan Terakhir *</label>
                    <input type="text" name="last_education" 
                           value="{{ old('last_education', $employee->last_education) }}" 
                           class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">
                </div>

                {{-- religion --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Agama *</label>
                    <input type="text" name="religion" 
                           value="{{ old('religion', $employee->religion) }}" 
                           class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">
                </div>

                {{-- blood_type --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Golongan Darah *</label>
                    <input type="text" name="blood_type" 
                           value="{{ old('blood_type', $employee->blood_type) }}" 
                           class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">
                </div>

                {{-- skills --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keahlian</label>
                    <textarea name="skills[]" rows="3" placeholder="Masukkan keahlian, satu per baris"
                            class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">
                    @if($employee->skills)
                        @foreach(json_decode($employee->skills, true) ?? [] as $skill)
                            {{ $skill }}
                        @endforeach
                    @endif
                </textarea>
            </div>

                {{-- bpjs_tk --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">BPJS Ketenagakerjaan</label>
                    <input type="text" name="bpjs_tk" 
                           value="{{ old('bpjs_tk', $employee->bpjs_tk) }}" 
                           class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">
                </div>

                {{-- bpjs_kes --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">BPJS Kesehatan</label>
                    <input type="text" name="bpjs_kes" 
                           value="{{ old('bpjs_kes', $employee->bpjs_kes) }}" 
                           class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">
                </div>

                {{-- npwp --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">NPWP</label>
                    <input type="text" name="npwp" 
                           value="{{ old('npwp', $employee->npwp) }}" 
                           class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">
                </div>

                {{-- emergency info --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kontak Darurat</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <input type="text" name="emergency_name" placeholder="Nama" 
                               value="{{ old('emergency_name', $employee->emergency_name) }}" 
                               class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">
                        <input type="text" name="emergency_relation" placeholder="Hubungan" 
                               value="{{ old('emergency_relation', $employee->emergency_relation) }}" 
                               class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">
                        <input type="text" name="emergency_phone" placeholder="Telepon" 
                               value="{{ old('emergency_phone', $employee->emergency_phone) }}" 
                               class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">
                    </div>
                </div>
                
                {{-- spouse section --}}
                {{-- spouse_name --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pasangan</label>
                    <input type="text" name="spouse_name"
                           value="{{ old('spouse_name', $spouse->name ?? '') }}"
                           class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">
                </div>

                {{-- spouse_birth_date --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir Pasangan</label>
                    <input type="date" name="spouse_birth_date"
                           value="{{ old('spouse_birth_date', $spouse->birth_date ?? '') }}"
                           class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">
                </div>

                {{-- spouse_education --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan Pasangan</label>
                    <input type="text" name="spouse_education"
                           value="{{ old('spouse_education', $spouse->last_education ?? '') }}"
                           class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">
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
                    <textarea name="ktp_address" rows="2" class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">{{ old('ktp_address', optional($ktpAddress)->address_line) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                    <input type="text" name="ktp_province" value="{{ old('ktp_province', optional($ktpAddress)->province) }}" class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                    <input type="text" name="ktp_city" value="{{ old('ktp_city', optional($ktpAddress)->city) }}" class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                    <input type="text" name="ktp_district" value="{{ old('ktp_district', optional($ktpAddress)->district) }}" class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kelurahan</label>
                    <input type="text" name="ktp_village" value="{{ old('ktp_village', optional($ktpAddress)->village) }}" class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                    <input type="text" name="ktp_postal" value="{{ old('ktp_postal', optional($ktpAddress)->postal_code) }}" class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">
                </div>
            </div>

            <h4 class="font-medium">Alamat Domisili</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <textarea name="dom_address" rows="2" class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">{{ old('dom_address', optional($currentAddress)->address_line) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                    <input type="text" name="dom_province" value="{{ old('dom_province', optional($currentAddress)->province) }}" class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                    <input type="text" name="dom_city" value="{{ old('dom_city', optional($currentAddress)->city) }}" class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                    <input type="text" name="dom_district" value="{{ old('dom_district', optional($currentAddress)->district) }}" class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kelurahan</label>
                    <input type="text" name="dom_village" value="{{ old('dom_village', optional($currentAddress)->village) }}" class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                    <input type="text" name="dom_postal" value="{{ old('dom_postal', optional($currentAddress)->postal_code) }}" class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600 transition">
                </div>
            </div>
        </div>

        <!-- pendidikan section -->
        <div class="bg-white shadow-md border border-gray-200 rounded-xl p-8 mb-8">
            <h3 class="text-xl font-semibold mb-4">Riwayat Pendidikan</h3>
            <div class="flex items-center justify-between mb-8">
                <h4 class="text-lg font-medium">Tambah / Update Pendidikan</h4>
                <button type="button" onclick="addEducationRow()" class="px-4 py-2 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg shadow-sm hover:bg-blue-100 transition text-sm font-medium flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Pendidikan
                </button>
            </div>
            <div id="educationContainer" class="space-y-12">
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
                @elseif(isset($educations) && $educations->count())
                    @foreach($educations as $i => $edu)
                        @include('employees.create.partials._education_row', [
                            'index' => $i,
                            'school_name' => $edu->school_name,
                            'city'        => $edu->city,
                            'major'       => $edu->major,
                            'year_in'     => $edu->year_in,
                            'year_out'    => $edu->year_out,
                        ])
                    @endforeach
                @else
                    @include('employees.create.partials._education_row', [
                        'index' => 0,
                        'school_name' => '',
                        'city' => '',
                        'major' => '',
                        'year_in' => '',
                        'year_out' => '',
                    ])
                @endif
            </div>
        </div>

        <!-- dependents section -->
        <div class="bg-white shadow-md border border-gray-200 rounded-xl p-8 mb-8">
            <h3 class="text-xl font-semibold mb-4">Tanggungan</h3>
            <div class="flex items-center justify-between mb-8">
                <h4 class="text-lg font-medium">Tambah / Update Tanggungan</h4>
                <button type="button" onclick="addDependentRow()" class="px-4 py-2 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg shadow-sm hover:bg-blue-100 transition text-sm font-medium flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Tanggungan
                </button>
            </div>
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
            <div class="flex items-center justify-between mb-8">
                <h4 class="text-lg font-medium">Tambah / Update Pekerjaan</h4>
                <button type="button" onclick="addWorkRow()" class="px-4 py-2 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg shadow-sm hover:bg-blue-100 transition text-sm font-medium flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Riwayat
                </button>
            </div>
            <div id="workContainer" class="space-y-12">
                @if(old('position'))
                    @foreach(old('position') as $i => $v)
                        @include('employees.create.partials._work_row', [
                            'index' => $i,
                            'position' => old("position.$i"),
                            'status' => old("work_status.$i"),
                            'work_grade' => old("work_grade.$i"),
                            'work_unit' => old("work_unit.$i"),
                            'start_date' => old("start_date.$i"),
                            'work_note' => old("work_note.$i"),
                        ])
                    @endforeach
                @elseif(isset($jobHistory) && $jobHistory->count())
                    @foreach($jobHistory as $i => $job)
                        @include('employees.create.partials._work_row', [
                            'index' => $i,
                            'position' => $job->position,
                            'work_status' => $job->status,
                            'work_grade' => $job->grade,
                            'work_unit' => $job->unit,
                            'start_date' => $job->start_date,
                            'work_note' => $job->note,
                        ])
                    @endforeach
                @else
                    @include('employees.create.partials._work_row', [
                        'index' => 0,
                        'position' => '',
                        'work_status' => '',
                        'work_grade' => '',
                        'work_unit' => '',
                        'start_date' => '',
                        'work_note' => '',
                    ])
                @endif
            </div>
        </div>

        <!-- training section -->
        <div class="bg-white shadow-md border border-gray-200 rounded-xl p-8 mb-8">
            <h3 class="text-xl font-semibold mb-4">Training / Pelatihan</h3>
            <div class="flex items-center justify-between mb-8">
                <h4 class="text-lg font-medium">Tambah / Update Pelatihan</h4>
                <button type="button" onclick="addTrainingRow()" class="px-4 py-2 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg shadow-sm hover:bg-blue-100 transition text-sm font-medium flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Training
                </button>
            </div>
            <div id="trainingContainer" class="space-y-12">
                @if(old('training_name'))
                    @foreach(old('training_name') as $i => $val)
                        @include('employees.create.partials._training_row', [
                            'index' => $i,
                            'training_name' => old("training_name.$i"),
                            'training_provider' => old("training_provider.$i"),
                            'training_year' => old("training_year.$i"),
                            'training_location' => old("training_location.$i"),
                            'existing_certificate' => old("existing_certificate.$i"),
                        ])
                    @endforeach
                @elseif(isset($trainings) && $trainings->count())
                    @foreach($trainings as $i => $t)
                        @include('employees.create.partials._training_row', [
                            'index' => $i,
                            'training_name' => $t->title,
                            'training_provider' => $t->provider,
                            'training_year' => $t->year,
                            'training_location' => $t->location,
                            'existing_certificate' => $t->certificate_path,
                        ])
                    @endforeach
                @else
                    @include('employees.create.partials._training_row', ['index' => 0])
                @endif
            </div>
        </div>

        <!-- dokumen section -->
        <div class="bg-white shadow-md border border-gray-200 rounded-xl p-8 mb-8">
            <h3 class="text-xl font-semibold mb-4">Dokumen Karyawan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @php
                    $file = $employee->file ?? null;
                @endphp

                @foreach ([
                    ['name' => 'ijazah', 'label' => 'Ijazah'],
                    ['name' => 'cv', 'label' => 'CV'],
                    ['name' => 'pas_foto', 'label' => 'Pas Foto'],
                    ['name' => 'transkrip_nilai', 'label' => 'Transkrip Nilai'],
                    ['name' => 'ktp', 'label' => 'KTP'],
                    ['name' => 'kartu_bpjs', 'label' => 'Kartu BPJS'],
                    ['name' => 'suket_pengalaman_kerja', 'label' => 'Surat Keterangan Pengalaman Kerja'],
                    ['name' => 'daftar_riwayat_hidup', 'label' => 'Daftar Riwayat Hidup'],
                ] as $doc)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ $doc['label'] }}</label>
                        @if($file && $file->{$doc['name']})
                            <div class="mb-2">
                                <a href="{{ asset('storage/'.$file->{$doc['name']}) }}" target="_blank" class="text-blue-600 hover:underline text-xs">📄 Lihat {{ $doc['label'] }}</a>
                            </div>
                        @endif
                        <input type="file" name="{{ $doc['name'] }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" />
                        @error($doc['name'])<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700">
                Simpan Perubahan
            </button>
        </div>
    </form>
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
