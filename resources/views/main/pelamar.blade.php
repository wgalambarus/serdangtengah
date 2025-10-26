{{-- pelamar.blade.php --}}
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
            <th class="px-6 py-3">Nomor HP</th>
            <th class="px-6 py-3">Jenis Kelamin</th>
            <th class="px-6 py-3 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody id="pelamarTableBody">
          @forelse($pelamars as $index => $pelamar)
          <tr class="{{ $index > 0 ? 'border-t border-gray-100' : '' }}">
            <td class="px-6 py-4">{{ $index + 1 }}</td>
            <td class="px-6 py-4 font-medium">{{ $pelamar->nama_lengkap }}</td>
            <td class="px-6 py-4">{{ $pelamar->nomor_hp ?? '-' }}</td>
            <td class="px-6 py-4">{{ $pelamar->jenis_kelamin ?? '-' }}</td>
            <td class="px-6 py-4 text-right">
              <button class="text-blue-600 hover:underline mr-3" onclick="showDetailModal({{ $pelamar->id }})">Detail</button>
              <button class="text-red-600 hover:underline" onclick="deletePelamar({{ $pelamar->id }})">Hapus</button>
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
}

async function handleSubmit(e) {
  e.preventDefault();

  // Validate all files before submit
  const cvValid = validateFile('cv');
  const pasFotoValid = validateFile('pas_foto');
  const transkripValid = validateFile('transkrip_nilai');

  if (!cvValid || !pasFotoValid || !transkripValid) {
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
      document.getElementById('detailTTL').textContent = data.tempat_tanggal_lahir || '-';
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

      if (!data.cv && !data.pas_foto && !data.transkrip_nilai) {
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
</script>

@endsection
