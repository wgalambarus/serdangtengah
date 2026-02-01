{{-- pelamar.blade.php --}}
@extends('layouts.main', ['currentPage' => 'Pelamar'])

@section('title', 'Manajemen Pelamar')

@section('header-actions')
<div class="relative w-80">
</div>
@endsection

@section('content')
<div class="flex flex-col lg:flex-row justify-between items-center mb-6 mt-4 gap-4">

    <div>
        <h2 class="text-2xl font-semibold text-gray-800 tracking-tight">
            Semua Pelamar ({{ $applicants->total() }})
        </h2>
    </div>

    {{-- FILTER + SEARCH + ADD --}}
    <div class="flex flex-wrap items-center gap-3 w-full lg:w-auto">

        {{-- SEARCH --}}
        <form method="GET" class="relative">
            <input type="text" name="search" value="{{ $search }}"
                placeholder="Cari nama pelamar"
                class="w-48 lg:w-60 px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg 
                       focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all">
            <span class="absolute right-3 top-2.5 text-gray-400 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35m0 0A7 7 0 1110.65 6.65a7 7 0 016 9.99z" />
                </svg>
            </span>
        </form>

        {{-- FILTER DROPDOWN BUTTON --}}
        <div class="relative">
            <button id="filterBtn"
                class="flex items-center gap-2 px-4 py-2 border border-gray-300 bg-white rounded-lg 
                       text-gray-700 hover:bg-gray-50 active:scale-[0.97] transition select-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4h18M6 8h12M10 12h4M12 16h0" />
                </svg>
                Filters
            </button>

            {{-- DROPDOWN CONTENT --}}
            <div id="filterDropdown"
                class="hidden absolute right-0 mt-2 w-72 bg-white shadow-xl border border-gray-200 rounded-lg overflow-hidden p-4 z-20">

                <form method="GET" class="space-y-4">

                    {{-- TEMPAT LAHIR --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="{{ $tempatLahir }}"
                            class="w-full px-3 py-2 border rounded-lg bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500">
                    </div>

                    {{-- JENIS KELAMIN --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select name="jenis_kelamin"
                            class="w-full px-3 py-2 border rounded-lg bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua</option>
                            <option value="Laki-laki" {{ $jenisKelamin=='Laki-laki'?'selected':'' }}>Laki-laki</option>
                            <option value="Perempuan" {{ $jenisKelamin=='Perempuan'?'selected':'' }}>Perempuan</option>
                        </select>
                    </div>

                    {{-- UMUR --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700">Umur</label>
                        <div class="flex gap-2">
                            <input type="number" placeholder="Min" name="umur_min" value="{{ $umurMin }}"
                                class="w-1/2 px-3 py-2 border rounded-lg bg-gray-50 focus:bg-white focus:ring-blue-500">
                            <input type="number" placeholder="Max" name="umur_max" value="{{ $umurMax }}"
                                class="w-1/2 px-3 py-2 border rounded-lg bg-gray-50 focus:bg-white focus:ring-blue-500">
                        </div>
                    </div>

                    {{-- APPLY BUTTON --}}
                    <button type="submit"
                        class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Terapkan Filter
                    </button>

                </form>

            </div>
        </div>

        {{-- TOMBOL TAMBAH --}}
        <button id="btnTambahPelamar"
            class="flex items-center gap-2 px-5 py-2.5 rounded-lg text-white font-medium shadow-sm 
                   bg-gradient-to-r from-blue-600 to-indigo-600 hover:opacity-90 active:scale-[0.97] transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4v16m8-8H4" />
            </svg>
            Tambah Pelamar
        </button>

    </div>
</div>

<div class="max-w-6xl mx-auto">
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8">
    <div class="flex justify-between items-center p-6 border-b border-gray-200">
       <h3 class="text-lg font-semibold text-gray-800 tracking-tight">Daftar Pelamar</h3>
    </div>
  
    <div class="overflow-x-auto">
      <table class="w-full text-sm text-left text-gray-700">
<thead class="bg-gray-100 text-gray-600 uppercase text-xs">
  <tr>
    <th class="px-6 py-3">
      <label class="chk-container">
        <input type="checkbox" id="selectAll" class="chk-custom">
      </label>
    </th>

    {{-- NAMA LENGKAP --}}
    <th class="px-6 py-3">
      <button
        type="button"
        class="flex items-center gap-1 hover:text-gray-900"
        onclick="window.location='{{ route('pelamar.index', array_merge(request()->all(), ['sort_by' => 'nama_lengkap', 'sort_dir' => ($sortBy === 'nama_lengkap' && $sortDir === 'asc') ? 'desc' : 'asc' ])) }}'">
        Nama Lengkap
        <!-- Sort Icons (original icons preserved) -->
        <span class="flex flex-col -mt-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 {{ ($sortBy === 'nama_lengkap' && $sortDir === 'asc') ? 'text-blue-600' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M10 3l5 7H5l5-7z"/></svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 {{ ($sortBy === 'nama_lengkap' && $sortDir === 'desc') ? 'text-blue-600' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M10 17l-5-7h10l-5 7z"/></svg>
        </span>
      </button>
    </th>

    {{-- NOMOR HP --}}
    <th class="px-6 py-3">
      <button
        type="button"
        class="flex items-center gap-1 hover:text-gray-900"
        onclick="window.location='{{ route('pelamar.index', array_merge(request()->all(), ['sort_by' => 'nomor_hp', 'sort_dir' => ($sortBy === 'nomor_hp' && $sortDir === 'asc') ? 'desc' : 'asc' ])) }}'">
        Nomor HP
        <span class="flex flex-col -mt-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 {{ ($sortBy === 'nomor_hp' && $sortDir === 'asc') ? 'text-blue-600' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M10 3l5 7H5l5-7z"/></svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 {{ ($sortBy === 'nomor_hp' && $sortDir === 'desc') ? 'text-blue-600' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M10 17l-5-7h10l-5 7z"/></svg>
        </span>
      </button>
    </th>

    {{-- JENIS KELAMIN --}}
    <th class="px-6 py-3">
      <button
        type="button"
        class="flex items-center gap-1 hover:text-gray-900"
        onclick="window.location='{{ route('pelamar.index', array_merge(request()->all(), ['sort_by' => 'jenis_kelamin', 'sort_dir' => ($sortBy === 'jenis_kelamin' && $sortDir === 'asc') ? 'desc' : 'asc' ])) }}'">
        Jenis Kelamin
        <span class="flex flex-col -mt-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 {{ ($sortBy === 'jenis_kelamin' && $sortDir === 'asc') ? 'text-blue-600' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M10 3l5 7H5l5-7z"/></svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 {{ ($sortBy === 'jenis_kelamin' && $sortDir === 'desc') ? 'text-blue-600' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M10 17l-5-7h10l-5 7z"/></svg>
        </span>
      </button>
    </th>

    <th class="px-6 py-3 text-right">Aksi</th>
  </tr>
</thead>

        <tbody id="pelamarTableBody">
          @forelse($applicants as $index => $applicant)
          <tr class="{{ $index > 0 ? 'border-t border-gray-100' : '' }}">
            <td class="px-6 py-4">
              <label class="chk-container">
                <input type="checkbox" class="chk-custom row-check" value="{{ $applicant->id }}">
              </label>
            </td>
            <td class="px-6 py-4 font-medium">{{ $applicant->nama_lengkap }}</td>
            <td class="px-6 py-4">{{ $applicant->nomor_hp ?? '-' }}</td>
             <td class="px-6 py-4">
              <span class="px-2 py-1 text-xs rounded-lg 
                {{ $applicant->jenis_kelamin === 'Laki-laki'
                    ? 'bg-blue-100 text-blue-700'
                    : 'bg-pink-100 text-pink-700' }}">
                {{ $applicant->jenis_kelamin ?? '-' }}
              </span>
            </td>
            <td class="px-6 py-4 text-right">
              <button class="text-blue-600 hover:underline mr-3" onclick="showDetailModal({{ $applicant->id }})">Detail</button>
              <button class="text-red-600 hover:underline" onclick="deletePelamar({{ $applicant->id }})">Hapus</button>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada data pelamar</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
    <div class="p-6 border-t border-gray-200">
      <div class="flex justify-center">
        {{ $applicants->links() }}
      </div>
    </div>
{{-- BACKDROP MODAL --}}
<div id="overlay"
  class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 transition-opacity duration-300">

  {{-- MODAL TAMBAH/EDIT PELAMAR --}}
  <div id="modalForm" class="hidden bg-white rounded-xl shadow-lg w-full max-w-3xl p-8 relative overflow-y-auto max-h-[90vh]">
    <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
    <h2 id="modalTitle" class="text-xl font-semibold mb-6 text-gray-800">Tambah Pelamar Baru</h2>

    {{-- Step Indicator --}}
    <div class="flex items-center justify-center mb-6">
      <div id="step1Indicator" class="flex items-center text-blue-600 font-semibold">
        <div class="w-8 h-8 flex items-center justify-center rounded-full bg-blue-600 text-white mr-2">1</div>
        Data Diri
      </div>
      <div class="flex-1 border-t border-gray-300 mx-4"></div>
      <div id="step2Indicator" class="flex items-center text-gray-400">
        <div class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 mr-2">2</div>
        Dokumen
      </div>
    </div>

    <form id="pelamarForm" onsubmit="handleSubmit(event)" class="space-y-6" enctype="multipart/form-data" novalidate>
      @csrf
      <input type="hidden" id="pelamarId" name="pelamar_id">
      <input type="hidden" id="formMethod" name="_method" value="POST">

      {{-- STEP 1 --}}
      <div id="step1" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
              Nama Lengkap <span class="text-red-500">*</span>
            </label>
            <input type="text"
                   name="nama_lengkap"
                   id="nama_lengkap"
                   required
                   minlength="3"
                   maxlength="255"
                   pattern="[A-Za-z\s.]+"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <p class="text-xs text-red-500 mt-1 hidden" id="error_nama_lengkap">Nama lengkap harus diisi (min. 3 karakter, hanya huruf)</p>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
            <input type="text"
                   name="tempat_lahir"
                   id="tempat_lahir"
                   maxlength="255"
                   pattern="[A-Za-z\s]+"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            <p class="text-xs text-red-500 mt-1 hidden" id="error_tempat_lahir">Tempat lahir hanya boleh berisi huruf</p>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
            <input type="date"
                   name="tanggal_lahir"
                   id="tanggal_lahir"
                   max="{{ date('Y-m-d') }}"
                   min="1950-01-01"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            <p class="text-xs text-red-500 mt-1 hidden" id="error_tanggal_lahir">Tanggal lahir tidak valid</p>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
            <select name="jenis_kelamin"
                    id="jenis_kelamin"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
              <option value="">Pilih jenis kelamin</option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
            <p class="text-xs text-red-500 mt-1 hidden" id="error_jenis_kelamin">Pilih jenis kelamin</p>
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
          <textarea name="alamat"
                    id="alamat"
                    rows="3"
                    maxlength="500"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
          <p class="text-xs text-gray-500 mt-1">
            <span id="alamat_count">0</span>/500 karakter
          </p>
          <p class="text-xs text-red-500 mt-1 hidden" id="error_alamat">Alamat terlalu panjang (max. 500 karakter)</p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Nomor HP</label>
          <input type="tel"
                 name="nomor_hp"
                 id="nomor_hp"
                 pattern="[0-9]{10,15}"
                 maxlength="15"
                 placeholder="Contoh: 081234567890"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
          <p class="text-xs text-red-500 mt-1 hidden" id="error_nomor_hp">Nomor HP tidak valid (10-15 digit angka)</p>
        </div>

        <div class="flex justify-end">
          <button type="button"
                  onclick="validateStep1()"
                  class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            Selanjutnya
          </button>
        </div>
      </div>

      {{-- STEP 2 --}}
      <div id="step2" class="space-y-6 hidden">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">CV (.pdf)</label>
          <input type="file"
                 name="cv"
                 id="cv"
                 accept=".pdf"
                 onchange="validateFile('cv')"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
          <p id="cv_current" class="text-xs text-gray-500 mt-1"></p>
          <p class="text-xs text-red-500 mt-1 hidden" id="error_cv">File harus berformat PDF dan maksimal 2MB</p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Pas Foto (.pdf)</label>
          <input type="file"
                 name="pas_foto"
                 id="pas_foto"
                 accept=".pdf"
                 onchange="validateFile('pas_foto')"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
          <p id="pas_foto_current" class="text-xs text-gray-500 mt-1"></p>
          <p class="text-xs text-red-500 mt-1 hidden" id="error_pas_foto">File harus berformat PDF dan maksimal 2MB</p>
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">KTP (.pdf)</label>
          <input type="file"
                 name="ktp"
                 id="ktp"
                 accept=".pdf"
                 onchange="validateFile('ktp')"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
          <p id="ktp_current" class="text-xs text-gray-500 mt-1"></p>
          <p class="text-xs text-red-500 mt-1 hidden" id="error_ktp">File harus berformat PDF dan maksimal 2MB</p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Ijazah (.pdf)</label>
          <input type="file"
                 name="ijazah"
                 id="ijazah"
                 accept=".pdf"
                 onchange="validateFile('ijazah')"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
          <p id="ijazah_current" class="text-xs text-gray-500 mt-1"></p>
          <p class="text-xs text-red-500 mt-1 hidden" id="error_ijazah">File harus berformat PDF dan maksimal 2MB</p>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Transkrip Nilai (.pdf)</label>
          <input type="file"
                 name="transkrip_nilai"
                 id="transkrip_nilai"
                 accept=".pdf"
                 onchange="validateFile('transkrip_nilai')"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
          <p id="transkrip_nilai_current" class="text-xs text-gray-500 mt-1"></p>
          <p class="text-xs text-red-500 mt-1 hidden" id="error_transkrip_nilai">File harus berformat PDF dan maksimal 2MB</p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Kartu BPJS (.pdf)</label>
          <input type="file"
                 name="kartu_bpjs"
                 id="kartu_bpjs"
                 accept=".pdf"
                 onchange="validateFile('kartu_bpjs')"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
          <p id="kartu_bpjs_current" class="text-xs text-gray-500 mt-1"></p>
          <p class="text-xs text-red-500 mt-1 hidden" id="error_kartu_bpjs">File harus berformat PDF dan maksimal 2MB</p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Surat Keterangan Pengalaman Kerja (.pdf)</label>
          <input type="file"
                 name="suket_pengalaman_kerja"
                 id="suket_pengalaman_kerja"
                 accept=".pdf"
                 onchange="validateFile('suket_pengalaman_kerja')"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
          <p id="suket_pengalaman_kerja_current" class="text-xs text-gray-500 mt-1"></p>
          <p class="text-xs text-red-500 mt-1 hidden" id="error_suket_pengalaman_kerja">File harus berformat PDF dan maksimal 2MB</p>
        </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Daftar Riwayat Hidup (.pdf)</label>
          <input type="file"
                 name="daftar_riwayat_hidup"
                 id="daftar_riwayat_hidup"
                 accept=".pdf"
                 onchange="validateFile('daftar_riwayat_hidup')"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
          <p id="daftar_riwayat_hidup_current" class="text-xs text-gray-500 mt-1"></p>
          <p class="text-xs text-red-500 mt-1 hidden" id="error_daftar_riwayat_hidup">File harus berformat PDF dan maksimal 2MB</p>
        </label>
      </div>
        <div class="flex justify-between pt-6 border-t border-gray-200">
          <button type="button"
                  onclick="prevStep()"
                  class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
            Kembali
          </button>
          <div class="flex gap-3">
            <button type="button"
                    onclick="handleReset()"
                    class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
              Reset
            </button>
            <button type="submit"
                    id="submitBtn"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
              Simpan Pelamar
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>

  {{-- MODAL DETAIL --}}
  <div id="modalDetail" class="hidden bg-white rounded-xl shadow-lg w-full max-w-2xl p-8 relative">
    <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
    <h2 class="text-xl font-semibold mb-6 text-gray-800">Detail Pelamar</h2>

    <div class="space-y-3 text-gray-700">
      <p><span class="font-semibold">Nama Lengkap:</span> <span id="detailNama"></span></p>
      <p><span class="font-semibold">Tempat, Tanggal Lahir:</span> <span id="detailTTL"></span></p>
      <p><span class="font-semibold">Jenis Kelamin:</span> <span id="detailJenisKelamin"></span></p>
      <p><span class="font-semibold">Nomor HP:</span> <span id="detailHP"></span></p>
      <p><span class="font-semibold">Alamat:</span> <span id="detailAlamat"></span></p>
      <div class="mt-6 pt-6 border-t border-gray-200">
        <p class="font-semibold mb-3">Dokumen:</p>
        <div id="detailDokumen" class="space-y-2"></div>
      </div>
    </div>
  </div>
</div>

{{-- SCRIPT --}}
<script>
const overlay = document.getElementById('overlay');
const modalForm = document.getElementById('modalForm');
const modalDetail = document.getElementById('modalDetail');
const step1 = document.getElementById('step1');
const step2 = document.getElementById('step2');
const step1Indicator = document.getElementById('step1Indicator');
const step2Indicator = document.getElementById('step2Indicator');
const btnTambahPelamar = document.getElementById('btnTambahPelamar');
const pelamarForm = document.getElementById('pelamarForm');

let isEditMode = false;

// Real-time validation
  document.getElementById("selectAll")?.addEventListener("change", function () {
    document.querySelectorAll(".row-check").forEach(chk => {
      chk.checked = this.checked;
    });
  });
  
document.getElementById('nama_lengkap').addEventListener('input', function(e) {
  validateField('nama_lengkap');
});

document.getElementById('tempat_lahir').addEventListener('input', function(e) {
  validateField('tempat_lahir');
});

document.getElementById('nomor_hp').addEventListener('input', function(e) {
  // Hanya izinkan angka
  this.value = this.value.replace(/[^0-9]/g, '');
  validateField('nomor_hp');
});

document.getElementById('alamat').addEventListener('input', function(e) {
  const count = this.value.length;
  document.getElementById('alamat_count').textContent = count;
  validateField('alamat');
});

document.getElementById('tanggal_lahir').addEventListener('change', function(e) {
  validateField('tanggal_lahir');
});

document.getElementById('jenis_kelamin').addEventListener('change', function(e) {
  validateField('jenis_kelamin');
});

// Validate individual field
function validateField(fieldName) {
  const field = document.getElementById(fieldName);
  const error = document.getElementById(`error_${fieldName}`);
  let isValid = true;

  // Reset
  field.classList.remove('border-red-500');
  error.classList.add('hidden');

  switch(fieldName) {
    case 'nama_lengkap':
      const namaValue = field.value.trim();
      if (namaValue.length < 3) {
        isValid = false;
        error.textContent = 'Nama lengkap minimal 3 karakter';
      } else if (!/^[A-Za-z\s.]+$/.test(namaValue)) {
        isValid = false;
        error.textContent = 'Nama lengkap hanya boleh berisi huruf';
      }
      break;

    case 'tempat_lahir':
      const tempatValue = field.value.trim();
      if (tempatValue && !/^[A-Za-z\s]+$/.test(tempatValue)) {
        isValid = false;
        error.textContent = 'Tempat lahir hanya boleh berisi huruf';
      }
      break;

    case 'tanggal_lahir':
      const tglValue = field.value;
      if (tglValue) {
        const selectedDate = new Date(tglValue);
        const today = new Date();
        const minDate = new Date('1950-01-01');

        if (selectedDate > today) {
          isValid = false;
          error.textContent = 'Tanggal lahir tidak boleh di masa depan';
        } else if (selectedDate < minDate) {
          isValid = false;
          error.textContent = 'Tanggal lahir tidak valid';
        }
      }
      break;

    case 'nomor_hp':
      const hpValue = field.value.trim();
      if (hpValue && (hpValue.length < 10 || hpValue.length > 15)) {
        isValid = false;
        error.textContent = 'Nomor HP harus 10-15 digit';
      } else if (hpValue && !/^[0-9]+$/.test(hpValue)) {
        isValid = false;
        error.textContent = 'Nomor HP hanya boleh berisi angka';
      }
      break;

    case 'alamat':
      if (field.value.length > 500) {
        isValid = false;
        error.textContent = 'Alamat maksimal 500 karakter';
      }
      break;
  }

  if (!isValid) {
    field.classList.add('border-red-500');
    error.classList.remove('hidden');
  }

  return isValid;
}

// Validate file upload
function validateFile(fieldName) {
  const field = document.getElementById(fieldName);
  const error = document.getElementById(`error_${fieldName}`);
  const file = field.files[0];

  // Reset
  field.classList.remove('border-red-500');
  error.classList.add('hidden');

  if (!file) return true;

  let isValid = true;

  // Check file type
  if (file.type !== 'application/pdf') {
    isValid = false;
    error.textContent = 'File harus berformat PDF';
  }

  // Check file size (max 2MB)
  if (file.size > 2 * 1024 * 1024) {
    isValid = false;
    error.textContent = 'Ukuran file maksimal 2MB';
  }

  if (!isValid) {
    field.classList.add('border-red-500');
    error.classList.remove('hidden');
    field.value = ''; // Clear invalid file
  }

  return isValid;
}

// Validate Step 1
function validateStep1() {
  const namaValid = validateField('nama_lengkap');

  // Validasi nama lengkap wajib
  if (!namaValid) {
    alert('Mohon perbaiki form sebelum melanjutkan');
    return false;
  }

  const namaLengkap = document.getElementById('nama_lengkap').value.trim();
  if (namaLengkap.length < 3) {
    alert('Nama lengkap harus diisi minimal 3 karakter');
    document.getElementById('nama_lengkap').focus();
    return false;
  }

  // Validasi field opsional jika diisi
  validateField('tempat_lahir');
  validateField('tanggal_lahir');
  validateField('nomor_hp');
  validateField('alamat');

  nextStep();
}

btnTambahPelamar.addEventListener('click', () => {
  isEditMode = false;
  document.getElementById('modalTitle').textContent = 'Tambah Pelamar Baru';
  document.getElementById('pelamarId').value = '';
  document.getElementById('formMethod').value = 'POST';
  pelamarForm.reset();
  clearFileInfo();
  clearErrors();
  overlay.classList.remove('hidden');
  modalForm.classList.remove('hidden');
});

function closeModal() {
  overlay.classList.add('hidden');
  modalForm.classList.add('hidden');
  modalDetail.classList.add('hidden');
  resetSteps();
  clearErrors();
}

function clearErrors() {
  // Remove all error states
  document.querySelectorAll('.border-red-500').forEach(el => {
    el.classList.remove('border-red-500');
  });
  document.querySelectorAll('[id^="error_"]').forEach(el => {
    el.classList.add('hidden');
  });
}

function nextStep() {
  step1.classList.add('hidden');
  step2.classList.remove('hidden');
  step1Indicator.classList.remove('text-blue-600');
  step2Indicator.classList.replace('text-gray-400', 'text-blue-600');
  step2Indicator.querySelector('div').classList.replace('bg-gray-200', 'bg-blue-600');
  step2Indicator.querySelector('div').classList.add('text-white');
}

function prevStep() {
  step1.classList.remove('hidden');
  step2.classList.add('hidden');
  resetStepIndicator();
}

function resetSteps() {
  step1.classList.remove('hidden');
  step2.classList.add('hidden');
  resetStepIndicator();
}

function resetStepIndicator() {
  step1Indicator.classList.add('text-blue-600');
  step2Indicator.classList.replace('text-blue-600', 'text-gray-400');
  step2Indicator.querySelector('div').classList.replace('bg-blue-600', 'bg-gray-200');
}

function handleReset() {
  if (confirm('Apakah Anda yakin ingin mereset form?')) {
    pelamarForm.reset();
    clearFileInfo();
    clearErrors();
    document.getElementById('alamat_count').textContent = '0';
  }
}

function clearFileInfo() {
  document.getElementById('cv_current').textContent = '';
  document.getElementById('pas_foto_current').textContent = '';
  document.getElementById('transkrip_nilai_current').textContent = '';
  document.getElementById('ktp_current').textContent = '';
  document.getElementById('ijazah_current').textContent = '';
  document.getElementById('kartu_bpjs_current').textContent = '';
  document.getElementById('suket_pengalaman_kerja_current').textContent = '';
  document.getElementById('daftar_riwayat_hidup_current').textContent = '';
  
}

async function handleSubmit(e) {
  e.preventDefault();

  // Validate all files before submit
  const cvValid = validateFile('cv');
  const pasFotoValid = validateFile('pas_foto');
  const transkripValid = validateFile('transkrip_nilai');
  const ktpValid = validateFile('ktp');
  const ijazahValid = validateFile('ijazah');
  const kartuBpjsValid = validateFile('kartu_bpjs');
  const suketPengalamanValid = validateFile('suket_pengalaman_kerja');
  const daftarRiwayatHidupValid = validateFile('daftar_riwayat_hidup');

  if (!cvValid || !pasFotoValid || !transkripValid || !ktpValid || !ijazahValid || !kartuBpjsValid || !suketPengalamanValid || !daftarRiwayatHidupValid) {
    alert('Mohon perbaiki file yang diupload');
    return;
  }

  const submitBtn = document.getElementById('submitBtn');
  submitBtn.disabled = true;
  submitBtn.textContent = 'Menyimpan...';

  const formData = new FormData(pelamarForm);

  try {
    const response = await fetch('{{ route("pelamar.store") }}', {
      method: 'POST',
      body: formData,
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Accept': 'application/json'
      }
    });

    const result = await response.json();

    if (result.success) {
      alert(result.message);
      closeModal();
      window.location.reload();
    } else {
      let errorMsg = result.message;
      if (result.errors) {
        errorMsg += '\n\nDetail error:\n';
        Object.values(result.errors).forEach(errArr => {
          errorMsg += '- ' + errArr.join(', ') + '\n';
        });
      }
      alert(errorMsg);
    }

  } catch (error) {
    console.error('Error:', error);
    alert('Terjadi kesalahan saat mengirim data: ' + error.message);
  } finally {
    submitBtn.disabled = false;
    submitBtn.textContent = 'Simpan Pelamar';
  }
}

async function showDetailModal(pelamarId) {
  try {
    const response = await fetch(`/pelamar/${pelamarId}`);
    const result = await response.json();

    if (result.success) {
      const data = result.data;

      document.getElementById('detailNama').textContent = data.nama_lengkap;
      document.getElementById('detailTTL').textContent = data.tempat_lahir + ', ' + data.tanggal_lahir  || '-';
      document.getElementById('detailJenisKelamin').textContent = data.jenis_kelamin || '-';
      document.getElementById('detailHP').textContent = data.nomor_hp || '-';
      document.getElementById('detailAlamat').textContent = data.alamat || '-';

      const dokumenDiv = document.getElementById('detailDokumen');
      dokumenDiv.innerHTML = '';

      if (data.cv) {
        dokumenDiv.innerHTML += `<p>• CV: <a href="/storage/${data.cv}" target="_blank" class="text-blue-600 hover:underline">Lihat Dokumen</a></p>`;
      }
      if (data.pas_foto) {
        dokumenDiv.innerHTML += `<p>• Pas Foto: <a href="/storage/${data.pas_foto}" target="_blank" class="text-blue-600 hover:underline">Lihat Dokumen</a></p>`;
      }
      if (data.transkrip_nilai) {
        dokumenDiv.innerHTML += `<p>• Transkrip Nilai: <a href="/storage/${data.transkrip_nilai}" target="_blank" class="text-blue-600 hover:underline">Lihat Dokumen</a></p>`;
      }

      if (data.ktp) {
        dokumenDiv.innerHTML += `<p>• KTP: <a href="/storage/${data.ktp}" target="_blank" class="text-blue-600 hover:underline">Lihat Dokumen</a></p>`;
      }

      if (data.ijazah) {
        dokumenDiv.innerHTML += `<p>• Ijazah: <a href="/storage/${data.ijazah}" target="_blank" class="text-blue-600 hover:underline">Lihat Dokumen</a></p>`;
      }

      if (data.kartu_bpjs) {
        dokumenDiv.innerHTML += `<p>• Kartu BPJS: <a href="/storage/${data.kartu_bpjs}" target="_blank" class="text-blue-600 hover:underline">Lihat Dokumen</a></p>`;
      }

      if (data.suket_pengalaman_kerja) {
        dokumenDiv.innerHTML += `<p>• Surat Keterangan Pengalaman Kerja: <a href="/storage/${data.suket_pengalaman_kerja}" target="_blank" class="text-blue-600 hover:underline">Lihat Dokumen</a></p>`;
      }

      if (data.daftar_riwayat_hidup) {
        dokumenDiv.innerHTML += `<p>• Daftar Riwayat Hidup: <a href="/storage/${data.daftar_riwayat_hidup}" target="_blank" class="text-blue-600 hover:underline">Lihat Dokumen</a></p>`;
      }

      if (!data.cv && !data.pas_foto && !data.transkrip_nilai && !data.ktp && !data.ijazah && !data.kartu_bpjs && !data.suket_pengalaman_kerja && !data.daftar_riwayat_hidup) {
        dokumenDiv.innerHTML = '<p class="text-gray-500">Belum ada dokumen</p>';
      }

      overlay.classList.remove('hidden');
      modalDetail.classList.remove('hidden');
    }
  } catch (error) {
    console.error('Error:', error);
    alert('Terjadi kesalahan saat mengambil data');
  }
}

async function deletePelamar(pelamarId) {
  if (!confirm('Apakah Anda yakin ingin menghapus data pelamar ini?')) {
    return;
  }

  try {
    const response = await fetch(`/pelamar/${pelamarId}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Content-Type': 'application/json'
      }
    });

    const result = await response.json();

    if (result.success) {
      alert(result.message);
      window.location.reload();
    } else {
    alert('Terjadi kesalahan saat menghapus data');
    }
  } catch (error) {
    console.error('Error:', error);
    alert('Terjadi kesalahan saat menghapus data');
  }
}

overlay.addEventListener('click', (e) => {
  if (e.target === overlay) {
    closeModal();
  }
});

  document.getElementById('filterBtn').addEventListener('click', () => {
    const dd = document.getElementById('filterDropdown');
    dd.classList.toggle('hidden');
  });

  window.addEventListener('click', (e) => {
    const btn = document.getElementById('filterBtn');
    const dd = document.getElementById('filterDropdown');

    if (!btn.contains(e.target) && !dd.contains(e.target)) {
      dd.classList.add('hidden');
    }
  });
</script>

@endsection
