@extends('layouts.main', ['currentPage' => 'Pelamar'])

@section('title', 'Pelamar')

@section('header-actions')
<div class="relative w-80">
</div>
@endsection

@section('content')
<div class="max-w-6xl mx-auto">

  {{-- DAFTAR PELAMAR --}}
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8">
    <div class="flex justify-between items-center p-6 border-b border-gray-200">
      <h2 class="text-lg font-semibold text-gray-800">Daftar Pelamar</h2>
      <button id="btnTambahPelamar"
        class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
        + Tambah Pelamar
      </button>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-sm text-left text-gray-700">
        <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
          <tr>
            <th class="px-6 py-3">No</th>
            <th class="px-6 py-3">Nama Lengkap</th>
            <th class="px-6 py-3">Posisi Dilamar</th>
            <th class="px-6 py-3">Status</th>
            <th class="px-6 py-3 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody id="pelamarTableBody">
          <tr>
            <td class="px-6 py-4">1</td>
            <td class="px-6 py-4 font-medium">Ahmad Rizki</td>
            <td class="px-6 py-4">Full Stack Developer</td>
            <td class="px-6 py-4">
              <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Diterima</span>
            </td>
            <td class="px-6 py-4 text-right">
              <button class="text-blue-600 hover:underline" onclick="showDetailModal('Ahmad Rizki', 'Full Stack Developer', 'Diterima', 'Bandung, 2 Juni 1999', '081234567890', 'Jl. Merdeka No. 10, Bandung')">Detail</button>
            </td>
          </tr>
          <tr class="border-t border-gray-100">
            <td class="px-6 py-4">2</td>
            <td class="px-6 py-4 font-medium">Siti Nurhaliza</td>
            <td class="px-6 py-4">UI/UX Designer</td>
            <td class="px-6 py-4">
              <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">Proses</span>
            </td>
            <td class="px-6 py-4 text-right">
              <button class="text-blue-600 hover:underline" onclick="showDetailModal('Siti Nurhaliza', 'UI/UX Designer', 'Proses', 'Jakarta, 5 Mei 2000', '082223334444', 'Jl. Sudirman No. 21, Jakarta')">Detail</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

{{-- BACKDROP MODAL --}}
<div id="overlay"
  class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 transition-opacity duration-300">

  {{-- MODAL TAMBAH PELAMAR --}}
  <div id="modalForm" class="hidden bg-white rounded-xl shadow-lg w-full max-w-3xl p-8 relative overflow-y-auto max-h-[90vh]">
    <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
    <h2 class="text-xl font-semibold mb-6 text-gray-800">Tambah Pelamar Baru</h2>

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

    <form id="pelamarForm" onsubmit="handleSubmit(event)" class="space-y-6">
      {{-- STEP 1 --}}
      <div id="step1" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
            <input type="text" name="namaLengkap" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
            <input type="text" name="tempatLahir" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
            <input type="date" name="tanggalLahir" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
            <select name="jenisKelamin" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
              <option value="">Pilih jenis kelamin</option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
          <textarea name="alamat" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Nomor HP</label>
          <input type="tel" name="nomorHP" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="flex justify-end">
          <button type="button" onclick="nextStep()" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            Selanjutnya
          </button>
        </div>
      </div>

      {{-- STEP 2 --}}
      <div id="step2" class="space-y-6 hidden">
        @foreach (['cv' => 'CV', 'pasFoto' => 'Pas Foto', 'transkripNilai' => 'Transkrip Nilai'] as $field => $label)
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">{{ $label }} (.pdf)</label>
            <input type="file" name="{{ $field }}" accept=".pdf" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
          </div>
        @endforeach
        <div class="flex justify-between pt-6 border-t border-gray-200">
          <button type="button" onclick="prevStep()" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Kembali</button>
          <div class="flex gap-3">
            <button type="button" onclick="handleReset()" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Reset</button>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Simpan Pelamar</button>
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
      <p><span class="font-semibold">Posisi Dilamar:</span> <span id="detailPosisi"></span></p>
      <p><span class="font-semibold">Status:</span> <span id="detailStatus"></span></p>
      <p><span class="font-semibold">Tempat, Tanggal Lahir:</span> <span id="detailTTL"></span></p>
      <p><span class="font-semibold">Nomor HP:</span> <span id="detailHP"></span></p>
      <p><span class="font-semibold">Alamat:</span> <span id="detailAlamat"></span></p>
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

btnTambahPelamar.addEventListener('click', () => {
  overlay.classList.remove('hidden');
  modalForm.classList.remove('hidden');
});

function closeModal() {
  overlay.classList.add('hidden');
  modalForm.classList.add('hidden');
  modalDetail.classList.add('hidden');
  resetSteps();
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

function handleSubmit(e) {
  e.preventDefault();
  alert('Data pelamar berhasil disimpan! (Demo)');
  closeModal();
}

function handleReset() {
  document.getElementById('pelamarForm').reset();
}

function showDetailModal(nama, posisi, status, ttl, hp, alamat) {
  overlay.classList.remove('hidden');
  modalDetail.classList.remove('hidden');
  document.getElementById('detailNama').textContent = nama;
  document.getElementById('detailPosisi').textContent = posisi;
  document.getElementById('detailStatus').textContent = status;
  document.getElementById('detailTTL').textContent = ttl;
  document.getElementById('detailHP').textContent = hp;
  document.getElementById('detailAlamat').textContent = alamat;
}
</script>
@endsection
