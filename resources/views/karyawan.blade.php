<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data Pelamar</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
<div class="flex min-h-screen">
    {{-- Sidebar --}}
    <div class="w-56 bg-gray-100 p-4 border-r">
        <div class="flex flex-col items-center gap-3">
            <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center">Logo</div>
            <p class="font-semibold text-lg">PT. Serdang Tengah</p>
        </div>
        <div class="mt-8 space-y-3">
            <a href="#" class="block">🏠 Home</a>
            <a href="/pelamar" class="block">📋 Pelamar</a>
            <a href="/karyawan" class="block font-bold text-green-700">👥 Karyawan</a>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="flex-1 p-8 bg-gray-50">
        <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">KARYAWAN</h1>
        <button onclick="openModal(1)" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">+ ADD</button>
      </div>

        {{-- Tabel Data --}}
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
                    {{-- @foreach ($karyawans as $k) --}}
                    <tr class="border-b">
                        {{-- <td class="p-2">{{ $k->nama }}</td> --}}
                        <td class="p-2 text-blue-600 cursor-pointer">Nama</td>
                        <td class="p-2 text-blue-600 cursor-pointer">Edit</td>
                        <td class="p-2 text-red-600 cursor-pointer">Hapus</td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">
  <div class="bg-white rounded-lg p-6 w-[700px] shadow-lg relative">
    <h2 class="text-2xl font-bold mb-2 text-center">PT NAMA</h2>

    <!-- Step 1 -->
    <form id="formStep1" action="javascript:void(0)" onsubmit="nextStep(1)" class="grid grid-cols-2 gap-4">
      <p class="text-center text-gray-500 col-span-2 mb-3">Halaman 1</p>

      <!-- isi kolommu nanti di sini -->

      <div class="col-span-2 flex justify-end mt-4">
        <button type="button" onclick="closeModal()" class="mr-3 text-gray-500">Batal</button>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Selanjutnya</button>
      </div>
    </form>

    <!-- Step 2 -->
    <form id="formStep2" action="javascript:void(0)" onsubmit="nextStep(2)" class="grid grid-cols-2 gap-4 hidden">
      <p class="text-center text-gray-500 col-span-2 mb-3">Halaman 2</p>

      <!-- isi kolommu nanti di sini -->

      <div class="col-span-2 flex justify-between mt-4">
        <button type="button" onclick="prevStep(2)" class="text-gray-500">Kembali</button>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Selanjutnya</button>
      </div>
    </form>

    <!-- Step 3 -->
    <form id="formStep3" action="javascript:void(0)" onsubmit="nextStep(3)" class="grid grid-cols-2 gap-4 hidden">
      <p class="text-center text-gray-500 col-span-2 mb-3">Halaman 3</p>

      <!-- isi kolommu nanti di sini -->

      <div class="col-span-2 flex justify-between mt-4">
        <button type="button" onclick="prevStep(3)" class="text-gray-500">Kembali</button>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Selanjutnya</button>
      </div>
    </form>

    <!-- Step 4 -->
    <form id="formStep4" action="javascript:void(0)" onsubmit="nextStep(4)" class="grid grid-cols-2 gap-4 hidden">
      <p class="text-center text-gray-500 col-span-2 mb-3">Halaman 4</p>

      <!-- isi kolommu nanti di sini -->

      <div class="col-span-2 flex justify-between mt-4">
        <button type="button" onclick="prevStep(4)" class="text-gray-500">Kembali</button>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Selanjutnya</button>
      </div>
    </form>

    <!-- Step 5 -->
    <form id="formStep5" action="javascript:void(0)" onsubmit="nextStep(5)" class="grid grid-cols-2 gap-4 hidden">
      <p class="text-center text-gray-500 col-span-2 mb-3">Halaman 5</p>

       <form id="formStep5" action="javascript:void(0)" class="grid grid-cols-2 gap-4">
      <p class="text-center text-gray-500 col-span-2 mb-3">Halaman 5 - Pengalaman Organisasi</p>

      <!-- DAFTAR ORGANISASI -->
      <div id="orgList" class="col-span-2 space-y-2">
        <div id="emptyOrg" class="text-center text-gray-500 py-4 border rounded">
          Belum ada data. Tekan tombol + untuk menambahkan.
        </div>
      </div>

      <!-- TOMBOL + -->
      <div class="col-span-2 flex justify-center mt-4">
        <button
          type="button"
          id="addOrgBtn"
          onclick="showOrgForm()"
          class="bg-blue-600 text-white text-3xl w-12 h-12 rounded-full hover:bg-blue-700"
        >+</button>
      </div>

      <!-- FORM INPUT ORGANISASI -->
      <div id="orgForm" class="hidden col-span-2 border-t pt-4 grid grid-cols-2 gap-4">
        <input type="text" id="nama_organisasi" placeholder="Nama Organisasi" class="border p-2 rounded col-span-2" required>
        <input type="text" id="jabatan" placeholder="Jabatan / Posisi" class="border p-2 rounded col-span-2" required>
        <input type="text" id="periode" placeholder="Periode (contoh: 2014-2018)" class="border p-2 rounded col-span-2" required>
        <input type="text" id="tanggung_jawab" placeholder="Tugas / Tanggung Jawab" class="border p-2 rounded col-span-2">
        <input type="text" id="prestasi" placeholder="Prestasi / Pencapaian" class="border p-2 rounded col-span-2">
        <div class="col-span-2 flex justify-end mt-2">
          <button type="button" onclick="cancelOrgForm()" class="text-gray-500 mr-3">Batal</button>
          <button type="button" onclick="saveOrgData()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
        </div>
      </div>

      <div class="col-span-2 flex justify-between mt-4">
        <button type="button" onclick="prevStep(5)" class="text-gray-500">Kembali</button>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Selanjutnya</button>
      </div>
    </form>

    <!-- Step 6 -->
    <form id="formStep6" enctype="multipart/form-data" class="grid grid-cols-2 gap-4 hidden">
      <p class="text-center text-gray-500 col-span-2 mb-3">Halaman 6 (Terakhir)</p>

       <form id="formStep5" action="javascript:void(0)" class="grid grid-cols-2 gap-4">
      <p class="text-center text-gray-500 col-span-2 mb-3">Halaman 6 - Pengalaman Perusahaan</p>

      <!-- DAFTAR ORGANISASI -->
      <div id="orgList" class="col-span-2 space-y-2">
        <div id="emptyOrg" class="text-center text-gray-500 py-4 border rounded">
          Belum ada data. Tekan tombol + untuk menambahkan.
        </div>
      </div>

      <!-- TOMBOL + -->
      <div class="col-span-2 flex justify-center mt-4">
        <button
          type="button"
          id="addOrgBtn"
          onclick="showOrgForm()"
          class="bg-blue-600 text-white text-3xl w-12 h-12 rounded-full hover:bg-blue-700"
        >+</button>
      </div>

      <!-- FORM INPUT ORGANISASI -->
      <div id="orgForm" class="hidden col-span-2 border-t pt-4 grid grid-cols-2 gap-4">
        <input type="text" id="nama_organisasi" placeholder="Nama Organisasi" class="border p-2 rounded col-span-2" required>
        <input type="text" id="jabatan" placeholder="Jabatan / Posisi" class="border p-2 rounded col-span-2" required>
        <input type="text" id="periode" placeholder="Periode (contoh: 2014-2018)" class="border p-2 rounded col-span-2" required>
        <input type="text" id="tanggung_jawab" placeholder="Tugas / Tanggung Jawab" class="border p-2 rounded col-span-2">
        <input type="text" id="prestasi" placeholder="Prestasi / Pencapaian" class="border p-2 rounded col-span-2">
        <div class="col-span-2 flex justify-end mt-2">
          <button type="button" onclick="cancelOrgForm()" class="text-gray-500 mr-3">Batal</button>
          <button type="button" onclick="saveOrgData()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
        </div>
      </div>

      <div class="col-span-2 flex justify-between mt-4">
        <button type="button" onclick="prevStep(6)" class="text-gray-500">Kembali</button>
        <button type="button" onclick="submitAll()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Selesai</button>
      </div>
    </form>
  </div>
</div>

<script>
  const modal = document.getElementById('modal');
  const steps = [
    document.getElementById('formStep1'),
    document.getElementById('formStep2'),
    document.getElementById('formStep3'),
    document.getElementById('formStep4'),
    document.getElementById('formStep5'),
    document.getElementById('formStep6')
  ];

  // Data organisasi/perusahaan
  let orgData = [];
  let companyData = [];

  function openModal() {
    modal.classList.remove('hidden');
    steps.forEach((s, i) => s.classList.toggle('hidden', i !== 0));
  }

  function closeModal() {
    modal.classList.add('hidden');
  }

  function nextStep(current) {
    // Selalu lanjut, walau data kosong
    if (current < steps.length) {
      steps[current - 1].classList.add('hidden');
      steps[current].classList.remove('hidden');
    }
  }

  function prevStep(current) {
    steps[current - 1].classList.add('hidden');
    steps[current - 2].classList.remove('hidden');
  }

  // ==== Step 5 (Pengalaman Organisasi) ====
  function showOrgForm() {
    document.getElementById('orgForm').classList.remove('hidden');
  }

  function cancelOrgForm() {
    document.getElementById('orgForm').classList.add('hidden');
    document.getElementById('nama_organisasi').value = '';
    document.getElementById('jabatan').value = '';
    document.getElementById('periode').value = '';
    document.getElementById('tanggung_jawab').value = '';
    document.getElementById('prestasi').value = '';
  }

  function saveOrgData() {
    const nama = document.getElementById('nama_organisasi').value.trim();
    const jabatan = document.getElementById('jabatan').value.trim();
    const periode = document.getElementById('periode').value.trim();
    const tanggung = document.getElementById('tanggung_jawab').value.trim();
    const prestasi = document.getElementById('prestasi').value.trim();

    if (nama && jabatan && periode) {
      orgData.push({ nama, jabatan, periode, tanggung, prestasi });
      cancelOrgForm();
      renderOrgList();
    } else {
      alert("Isi minimal Nama, Jabatan, dan Periode!");
    }
  }

  function renderOrgList() {
    const orgList = document.getElementById('orgList');
    orgList.innerHTML = '';

    if (orgData.length === 0) {
      orgList.innerHTML = `<div id="emptyOrg" class="text-center text-gray-500 py-4 border rounded">
        Belum ada data. Tekan tombol + untuk menambahkan.
      </div>`;
      return;
    }

    orgData.forEach((org, i) => {
      const div = document.createElement('div');
      div.className = 'flex justify-between items-center border p-3 rounded bg-gray-50';
      div.innerHTML = `
        <div>
          <p class="font-semibold">${org.nama}</p>
          <p class="text-sm text-gray-500">${org.jabatan}</p>
          <p class="text-sm text-gray-400">${org.periode}</p>
        </div>
        <button onclick="deleteOrg(${i})" class="text-red-600 hover:underline">Hapus</button>
      `;
      orgList.appendChild(div);
    });
  }

  function deleteOrg(index) {
    orgData.splice(index, 1);
    renderOrgList();
  }

  // ==== Step 6 (Pengalaman Perusahaan) ====
  function showCompanyForm() {
    document.getElementById('companyForm').classList.remove('hidden');
  }

  function cancelCompanyForm() {
    document.getElementById('companyForm').classList.add('hidden');
  }

  function saveCompanyData() {
    const nama = document.getElementById('nama_perusahaan').value.trim();
    const jabatan = document.getElementById('jabatan_perusahaan').value.trim();
    const periode = document.getElementById('periode_perusahaan').value.trim();

    if (nama && jabatan && periode) {
      companyData.push({ nama, jabatan, periode });
      cancelCompanyForm();
      renderCompanyList();
    } else {
      alert("Isi minimal Nama, Jabatan, dan Periode!");
    }
  }

  function renderCompanyList() {
    const companyList = document.getElementById('companyList');
    companyList.innerHTML = '';

    if (companyData.length === 0) {
      companyList.innerHTML = `<div id="emptyCompany" class="text-center text-gray-500 py-4 border rounded">
        Belum ada data. Tekan tombol + untuk menambahkan.
      </div>`;
      return;
    }

    companyData.forEach((c, i) => {
      const div = document.createElement('div');
      div.className = 'flex justify-between items-center border p-3 rounded bg-gray-50';
      div.innerHTML = `
        <div>
          <p class="font-semibold">${c.nama}</p>
          <p class="text-sm text-gray-500">${c.jabatan}</p>
          <p class="text-sm text-gray-400">${c.periode}</p>
        </div>
        <button onclick="deleteCompany(${i})" class="text-red-600 hover:underline">Hapus</button>
      `;
      companyList.appendChild(div);
    });
  }

  function deleteCompany(index) {
    companyData.splice(index, 1);
    renderCompanyList();
  }

  function submitAll() {
    // Tidak peduli apakah orgData atau companyData kosong
    alert('Semua data siap dikirim! (nanti bisa dihubungkan ke backend)');
    closeModal();
  }
</script>



{{-- Modal --}}
</body>
</html>

