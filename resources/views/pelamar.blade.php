<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data Pelamar</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
  <div class="flex min-h-screen">
    <!-- Sidebar -->
     {{-- Sidebar --}}
  <aside class="w-60 bg-white border-r border-gray-200 p-6 flex flex-col">
    <h2 class="text-xl font-bold mb-6 text-gray-800">SmartRecruiter</h2>

    <nav class="flex flex-col space-y-2">
      <a href="main" class="px-4 py-2 rounded-lg font-medium hover:bg-green-700 hover:text-white {{ Route::is('dashboard') ? 'bg-green-700 text-white' : 'text-gray-700' }}">Dashboard</a>
      <a href="/pelamar" class="px-4 py-2 rounded-lg font-medium hover:bg-green-700 hover:text-white {{ Route::is('pelamar.*') ? 'bg-green-700 text-white' : 'text-gray-700' }}">Pelamar</a>
      <a href="/karyawan" class="px-4 py-2 rounded-lg font-medium hover:bg-green-700 hover:text-white {{ Route::is('karyawan.*') ? 'bg-green-700 text-white' : 'text-gray-700' }}">Karyawan</a>
      {{-- <a href="{{ route('tambahdata') }}" class="px-4 py-2 rounded-lg font-medium hover:bg-green-700 hover:text-white {{ Route::is('tambahdata') ? 'bg-green-700 text-white' : 'text-gray-700' }}">Tambah Data</a>
      <a href="{{ route('laporan') }}" class="px-4 py-2 rounded-lg font-medium hover:bg-green-700 hover:text-white {{ Route::is('laporan') ? 'bg-green-700 text-white' : 'text-gray-700' }}">Laporan</a>
      <a href="{{ route('pengaturan') }}" class="px-4 py-2 rounded-lg font-medium hover:bg-green-700 hover:text-white {{ Route::is('pengaturan') ? 'bg-green-700 text-white' : 'text-gray-700' }}">Pengaturan</a> --}}
    </nav>
  </aside>
    {{-- <div class="w-56 bg-gray-100 p-4 border-r">
      <div class="flex flex-col items-center gap-3">
        <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center">Logo</div>
        <p class="font-semibold text-lg">PT. Serdang Tengah</p>
      </div>
      <div class="mt-8 space-y-3">
        <a href="#" class="block">🏠 Home</a>
        <a href="/pelamar" class="block font-bold text-green-700">📋 Pelamar</a>
        <a href="/karyawan" class="block">👥 Karyawan</a>
      </div>
    </div> --}}

    <!-- Main -->
    <div class="flex-1 p-8">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">PELAMAR</h1>
        <button onclick="openModal(1)" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">+ ADD</button>
      </div>

      <div class="bg-white rounded-lg shadow p-4">
        <table class="w-full text-left border">
          <thead class="bg-green-600 text-white">
            <tr>
              <th class="p-2">Nama</th>
              <th class="p-2">Edit</th>
              <th class="p-2">Hapus</th>
            </tr>
          </thead>
          <tbody>
            {{-- @foreach ($pelamars as $p) --}}
            <tr class="border-b">
              <td class="p-2">Nama</td>
              {{-- {{ $p->nama_identitas }} --}}
              <td class="p-2 text-blue-600 cursor-pointer">Edit</td>
              <td class="p-2 text-red-600 cursor-pointer">Hapus</td>
            </tr>
            {{-- @endforeach --}}
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal Multi-Step -->
  <div id="modal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-[700px] shadow-lg relative">
      <h2 class="text-2xl font-bold mb-2 text-center">PT NAMA</h2>

      <!-- Step 1 -->
      <form id="formStep1" action="javascript:void(0)" onsubmit="nextStep()" class="grid grid-cols-2 gap-4">
        <p class="text-center text-gray-500 col-span-2 mb-3">Identitas Pribadi</p>
        <input type="text" name="nama_identitas" placeholder="Nama Identitas" class="border p-2 rounded" required>
        <input type="text" name="tempat_lahir" placeholder="Tempat Lahir" class="border p-2 rounded" required>
        <input type="date" name="tanggal_lahir" class="border p-2 rounded" required>
        <select name="jenis_kelamin" class="border p-2 rounded" required>
          <option value="">Pilih Jenis Kelamin</option>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
        <input type="text" name="alamat" placeholder="Alamat" class="border p-2 rounded col-span-2" required>
        <input type="text" name="no_hp" placeholder="No HP" class="border p-2 rounded col-span-2" required>

        <div class="col-span-2 flex justify-end mt-4">
          <button type="button" onclick="closeModal()" class="mr-3 text-gray-500">Batal</button>
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Selanjutnya</button>
        </div>
      </form>

      <!-- Step 2 -->
      <form id="formStep2" enctype="multipart/form-data" class="grid grid-cols-2 gap-4 hidden">
         {{-- method="POST" action="{{ route('pelamar.store') }}" --}}
        @csrf
        <input type="hidden" name="nama_identitas">
        <input type="hidden" name="tempat_lahir">
        <input type="hidden" name="tanggal_lahir">
        <input type="hidden" name="jenis_kelamin">
        <input type="hidden" name="alamat">
        <input type="hidden" name="no_hp">

        <p class="text-center text-gray-500 col-span-2 mb-3">Dokumen Pribadi</p>

        <label>Riwayat Hidup (PDF)<input type="file" name="riwayat_hidup" accept=".pdf" class="border p-2 rounded w-full"></label>
        <label>Fotokopi Ijazah (PDF)<input type="file" name="fotokopi_ijazah" accept=".pdf" class="border p-2 rounded w-full"></label>
        <label>Fotokopi Transkrip Nilai (PDF)<input type="file" name="fotokopi_transkrip" accept=".pdf" class="border p-2 rounded w-full"></label>
        <label>Fotokopi KTP (PDF)<input type="file" name="fotokopi_ktp" accept=".pdf" class="border p-2 rounded w-full"></label>
        <label>Pasfoto (JPG/JPEG)<input type="file" name="pasfoto" accept=".jpg,.jpeg" class="border p-2 rounded w-full"></label>
        <label>Curriculum Vitae (PDF)<input type="file" name="cv" accept=".pdf" class="border p-2 rounded w-full"></label>

        <div class="col-span-2 flex justify-between mt-4">
          <button type="button" onclick="prevStep()" class="text-gray-500">Kembali</button>
          <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Verifikasi</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const modal = document.getElementById('modal');
    const step1 = document.getElementById('formStep1');
    const step2 = document.getElementById('formStep2');

    function openModal() { modal.classList.remove('hidden'); step1.classList.remove('hidden'); step2.classList.add('hidden'); }
    function closeModal() { modal.classList.add('hidden'); }
    function nextStep() {
      const formData = new FormData(step1);
      step2.querySelector('[name=nama_identitas]').value = formData.get('nama_identitas');
      step2.querySelector('[name=tempat_lahir]').value = formData.get('tempat_lahir');
      step2.querySelector('[name=tanggal_lahir]').value = formData.get('tanggal_lahir');
      step2.querySelector('[name=jenis_kelamin]').value = formData.get('jenis_kelamin');
      step2.querySelector('[name=alamat]').value = formData.get('alamat');
      step2.querySelector('[name=no_hp]').value = formData.get('no_hp');
      step1.classList.add('hidden');
      step2.classList.remove('hidden');
    }
    function prevStep() {
      step1.classList.remove('hidden');
      step2.classList.add('hidden');
    }
  </script>
</body>
</html>
