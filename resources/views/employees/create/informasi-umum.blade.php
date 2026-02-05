@extends('layouts.main', ['currentPage' => 'Karyawan'])

@section('title', 'Tambah Karyawan - Informasi Umum')

@section('content')
<div class="max-w-4xl mx-auto py-12">

  {{-- ========================= STEPPER ========================= --}}
  <div class="relative mb-32">
      <div class="absolute top-1/2 left-0 w-full h-1 bg-gray-200 rounded-full -translate-y-1/2"></div>

      <div class="absolute top-1/2 left-0 h-1 bg-gradient-to-r from-blue-600 to-indigo-600 
                  rounded-full -translate-y-1/2"
           style="width: 16.6%;"></div>

      <div class="relative flex justify-between items-center">
          <div class="flex flex-col items-center">
              <div class="flex items-center justify-center text-white font-semibold 
                          shadow-md bg-gradient-to-br from-blue-600 to-indigo-600"
                   style="width:46px;height:46px;border-radius:9999px;">
                1
              </div>
              <span class="text-xs text-gray-900 font-medium mt-2">Informasi Umum</span>
          </div>

          @foreach ([2=>'Alamat',3=>'Pendidikan',4=>'Tanggungan',5=>'Pekerjaan',6=>'Training'] as $num=>$label)
          <div class="flex flex-col items-center opacity-60">
              <div class="flex items-center justify-center text-gray-600 bg-white border border-gray-300"
                  style="width:46px;height:46px;border-radius:9999px;">
                  {{ $num }}
              </div>
              <span class="text-xs text-gray-500 mt-2">{{ $label }}</span>
          </div>
          @endforeach
      </div>
  </div>


  {{-- ========================= FORM ========================= --}}
  <form method="POST" action="{{ route('employee.create.store', 'informasi-umum') }}">
    @csrf

    <div class="bg-white shadow-md border border-gray-200 rounded-xl p-8 mb-14">
      <h2 class="text-xl font-semibold text-gray-900 mb-6">Informasi Umum</h2>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- FULL NAME --}}
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
          <input type="text" name="full_name"
                 value="{{ old('full_name') }}"
                 class="required-field w-full px-4 py-3 bg-gray-50 rounded-lg 
                        focus:ring-2 focus:ring-blue-600 focus:bg-white transition
                        @error('full_name') border-red-500 @else border-gray-300 @enderror">
          @error('full_name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- NIK --}}
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">NIK KTP *</label>
          <input type="text" name="national_id" maxlength="16"
                 value="{{ old('national_id') }}"
                 oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                 class="required-field w-full px-4 py-3 bg-gray-50 rounded-lg 
                        focus:ring-2 focus:ring-blue-600 transition
                        @error('national_id') border-red-500 @else border-gray-300 @enderror">
          @error('national_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- EMAIL --}}
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
          <input type="email" name="email"
                 value="{{ old('email') }}"
                 class="required-field w-full px-4 py-3 bg-gray-50 rounded-lg 
                        focus:ring-2 focus:ring-blue-600 transition
                        @error('email') border-red-500 @else border-gray-300 @enderror">
          @error('email') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- PHONE --}}
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP *</label>
          <input type="text" name="phone" maxlength="15"
                 value="{{ old('phone') }}"
                 oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                 class="required-field w-full px-4 py-3 bg-gray-50 rounded-lg 
                        focus:ring-2 focus:ring-blue-600 transition
                        @error('phone') border-red-500 @else border-gray-300 @enderror">
          @error('phone') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- PLACE OF BIRTH --}}
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir *</label>
          <input type="text" name="birth_place"
                 value="{{ old('birth_place') }}"
                 oninput="onlyString(this)"
                 class="required-field w-full px-4 py-3 bg-gray-50 rounded-lg
                        focus:ring-2 focus:ring-blue-600 transition
                        @error('birth_place') border-red-500 @else border-gray-300 @enderror">
          @error('birth_place') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- DATE OF BIRTH --}}
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir *</label>
          <input type="date" name="birth_date"
                 value="{{ old('birth_date') }}"
                 class="required-field w-full px-4 py-3 bg-gray-50 rounded-lg
                        focus:ring-2 focus:ring-blue-600 transition
                        @error('birth_date') border-red-500 @else border-gray-300 @enderror">
          @error('birth_date') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- GENDER --}}
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin *</label>
          <select name="gender"
                  class="required-field w-full px-4 py-3 bg-gray-50 rounded-lg
                         focus:ring-2 focus:ring-blue-600 transition
                         @error('gender') border-red-500 @else border-gray-300 @enderror">
            <option value="">Pilih...</option>
            <option value="L" {{ old('gender')=='L'?'selected':'' }}>Laki-laki</option>
            <option value="P" {{ old('gender')=='P'?'selected':'' }}>Perempuan</option>
          </select>
          @error('gender') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- LAST EDUCATION --}}
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan Terakhir *</label>
          <select name="last_education"
                  class="required-field w-full px-4 py-3 bg-gray-50 rounded-lg
                         focus:ring-2 focus:ring-blue-600 transition
                         @error('last_education') border-red-500 @else border-gray-300 @enderror">
            <option value="">Pilih...</option>
            @foreach(['SMA/SMK','D3','S1','S2','S3'] as $edu)
              <option {{ old('last_education')==$edu?'selected':'' }}>{{ $edu }}</option>
            @endforeach
          </select>
          @error('last_education') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- RELIGION --}}
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Agama *</label>
          <select name="religion"
                  class="required-field w-full px-4 py-3 bg-gray-50 rounded-lg
                         focus:ring-2 focus:ring-blue-600 transition
                         @error('religion') border-red-500 @else border-gray-300 @enderror">
            <option value="">Pilih...</option>
            @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $rel)
              <option {{ old('religion')==$rel?'selected':'' }}>{{ $rel }}</option>
            @endforeach
          </select>
          @error('religion') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- BLOOD TYPE --}}
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Golongan Darah *</label>
          <select name="blood_type"
                  class="required-field w-full px-4 py-3 bg-gray-50 rounded-lg
                         focus:ring-2 focus:ring-blue-600 transition
                         @error('blood_type') border-red-500 @else border-gray-300 @enderror">
            <option value="">Pilih...</option>
            @foreach(['A','B','AB','O'] as $bt)
              <option {{ old('blood_type')==$bt?'selected':'' }}>{{ $bt }}</option>
            @endforeach
          </select>
          @error('blood_type') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- BPJS TK --}}
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">BPJS Ketenagakerjaan</label>
          <input type="text" name="bpjs_tk"
                 value="{{ old('bpjs_tk') }}"
                 class="w-full px-4 py-3 bg-gray-50 rounded-lg
                        focus:ring-2 focus:ring-blue-600 transition border-gray-300">
        </div>

        {{-- BPJS KES --}}
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">BPJS Kesehatan</label>
          <input type="text" name="bpjs_kes"
                 value="{{ old('bpjs_kes') }}"
                 class="w-full px-4 py-3 bg-gray-50 rounded-lg
                        focus:ring-2 focus:ring-blue-600 transition border-gray-300">
        </div>

        {{-- MARITAL STATUS --}}
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Status Pernikahan *</label>
          <select name="marital_status"
                  class="required-field w-full px-4 py-3 bg-gray-50 rounded-lg
                         focus:ring-2 focus:ring-blue-600 transition
                         @error('marital_status') border-red-500 @else border-gray-300 @enderror">
            <option value="">Pilih...</option>
            @foreach(['BELUM_MENIKAH','MENIKAH','DUDA', 'JANDA'] as $ms)
              <option {{ old('marital_status')==$ms?'selected':'' }}>{{ $ms }}</option>
            @endforeach
          </select>
          @error('marital_status') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- NPWP --}}
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">NPWP</label>
          <input type="text" name="npwp"
                 value="{{ old('npwp') }}"
                 class="w-full px-4 py-3 bg-gray-50 rounded-lg
                        focus:ring-2 focus:ring-blue-600 transition border-gray-300">
        </div>

        {{-- SKILLS --}}
        <div class="md:col-span-2">
          <label class="block text-sm font-medium text-gray-700 mb-2">Keahlian / Skills</label>

          <input type="text" id="skillsInput" placeholder="Tambah skill lalu tekan Enter" name="skills[]"
                 class="w-full px-4 py-3 bg-gray-50 rounded-lg border 
                        @error('skills.*') border-red-500 @else border-gray-300 @enderror
                        focus:ring-2 focus:ring-blue-600 transition">

          @error('skills.*') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror

          <div id="skillsTags" class="flex flex-wrap gap-2 mt-3"></div>

          {{-- Serialized JSON --}}
          <input type="hidden" id="skillsHidden" name="skills" value="{{ old('skills') }}">
        </div>

        {{-- EMERGENCY CONTACT --}}
        <div class="md:col-span-2 mt-6">
          <h3 class="text-lg font-semibold text-gray-800 mb-4">Kontak Darurat</h3>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Nama *</label>
          <input type="text" name="emergency_name"
                 value="{{ old('emergency_name') }}"
                 oninput="onlyString(this)"
                 class="required-field w-full px-4 py-3 rounded-lg bg-gray-50 
                        focus:ring-2 focus:ring-blue-600
                        @error('emergency_name') border-red-500 @else border-gray-300 @enderror">
          @error('emergency_name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Hubungan *</label>
          <input type="text" name="emergency_relation"
                 value="{{ old('emergency_relation') }}"
                 oninput="onlyString(this)"
                 class="required-field w-full px-4 py-3 rounded-lg bg-gray-50
                        focus:ring-2 focus:ring-blue-600
                        @error('emergency_relation') border-red-500 @else border-gray-300 @enderror">
          @error('emergency_relation') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP *</label>
          <input type="text" name="emergency_phone" maxlength="15"
                 value="{{ old('emergency_phone') }}"
                 oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                 class="required-field w-full px-4 py-3 rounded-lg bg-gray-50
                        focus:ring-2 focus:ring-blue-600
                        @error('emergency_phone') border-red-500 @else border-gray-300 @enderror">
          @error('emergency_phone') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

      </div> {{-- end grid --}}
    </div> {{-- end card --}}

    {{-- NEXT BUTTON --}}
    <div class="flex justify-end mt-10">
      <button id="nextBtn" type="submit"
              class="px-8 py-3 bg-gradient-to-br from-blue-600 to-indigo-600 text-white rounded-lg
                     font-semibold shadow-lg hover:opacity-90 transition">
        Selanjutnya →
      </button>
    </div>

  </form>

</div>



{{-- ========================= SCRIPT ========================= --}}
<script>
// ========= Skills Tag Input ==========
const skillInput = document.getElementById("skillsInput");
const tagContainer = document.getElementById("skillsTags");
const hiddenSkills = document.getElementById("skillsHidden");

let skills = [];

if (hiddenSkills.value) {
    try { skills = JSON.parse(hiddenSkills.value); } catch {}
    renderTags();
}

skillInput.addEventListener("keypress", e => {
  if (e.key !== "Enter") return;
  e.preventDefault();

  const v = skillInput.value.trim();
  if (!v || skills.includes(v)) return;

  skills.push(v);
  skillInput.value = "";
  syncHidden();
  renderTags();
});

function removeSkill(s) {
  skills = skills.filter(item => item !== s);
  syncHidden();
  renderTags();
}

function syncHidden() {
  hiddenSkills.value = JSON.stringify(skills);
}

function renderTags() {
  tagContainer.innerHTML = "";
  skills.forEach(s => {
    tagContainer.innerHTML += `
      <div class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-sm flex items-center gap-2">
        ${s}
        <button type="button" onclick="removeSkill('${s}')" class="text-blue-600 text-xs">✕</button>
      </div>`;
  });
}

function onlyString(input) {
  input.value = input.value.replace(/[^A-Za-zs]/g, '');
}
</script>

@endsection
