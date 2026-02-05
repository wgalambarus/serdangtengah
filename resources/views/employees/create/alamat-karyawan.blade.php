@extends('layouts.main', ['currentPage' => 'Karyawan'])

@section('title', 'Manajemen Karyawan')

@section('header-actions')
<div class="relative w-80"></div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto py-12">

  <!-- ===================================================== -->
  <!--                    STEPPER SECTION 2                  -->
  <!-- ===================================================== -->
  <div class="relative mb-32">

    <!-- background line -->
    <div class="absolute top-1/2 left-0 w-full h-1 bg-gray-200 rounded-full -translate-y-1/2"></div>

    <!-- active progress bar (33%) -->
    <div class="absolute top-1/2 left-0 h-1 bg-gradient-to-r from-blue-600 to-indigo-600 
                rounded-full -translate-y-1/2"
         style="width: 33%;">
    </div>

    <!-- STEP ROW -->
    <div class="relative flex justify-between items-center">

      <!-- Completed Step -->
      <div class="flex flex-col items-center">
        <div
          class="flex items-center justify-center text-white font-semibold bg-blue-600 shadow"
          style="width:46px; height:46px; border-radius:9999px;">
          ✓
        </div>
        <span class="text-xs text-gray-700 mt-2">Informasi Umum</span>
      </div>

      <!-- Active Step -->
      <div class="flex flex-col items-center">
        <div
          class="flex items-center justify-center text-white font-semibold shadow-md bg-gradient-to-br from-blue-600 to-indigo-600"
          style="width:46px; height:46px; border-radius:9999px;">
          2
        </div>
        <span class="text-xs text-gray-900 font-medium mt-2">Alamat</span>
      </div>

      <!-- Upcoming -->
      @foreach ([3 => 'Pendidikan', 4 => 'Tanggungan', 5 => 'Pekerjaan', 6 => 'Training'] as $num => $label)
      <div class="flex flex-col items-center opacity-60">
        <div
          class="flex items-center justify-center text-gray-600 bg-white border border-gray-300"
          style="width:46px; height:46px; border-radius:9999px;">
          {{ $num }}
        </div>
        <span class="text-xs text-gray-500 mt-2">{{ $label }}</span>
      </div>
      @endforeach

    </div>
  </div>

<form method="POST" action="{{ route('employee.create.store', 'alamat-karyawan') }}">
@csrf

<div class="bg-white shadow-md border border-gray-200 rounded-xl mt-10 p-8 mb-14">

    <h2 class="text-xl font-semibold text-gray-900 mb-6">Alamat Karyawan</h2>

    {{-- ====================== ALAMAT KTP ====================== --}}
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Alamat KTP</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- ALAMAT --}}
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat *</label>

            <textarea name="ktp_address" rows="3"
                class="w-full px-4 py-3 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-600
                       @error('ktp_address') border-red-500 @else border-gray-300 @enderror">{{ old('ktp_address') }}</textarea>

            @error('ktp_address')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- PROVINSI --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi *</label>
            <input type="text" name="ktp_province"
                value="{{ old('ktp_province') }}"
                oninput="onlyString(this)"
                class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600
                       @error('ktp_province') border-red-500 @else border-gray-300 @enderror">
            @error('ktp_province') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- KOTA --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kota *</label>
            <input type="text" name="ktp_city"
                value="{{ old('ktp_city') }}"
                oninput="onlyString(this)"
                class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600
                       @error('ktp_city') border-red-500 @else border-gray-300 @enderror">
            @error('ktp_city') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- KECAMATAN --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan *</label>
            <input type="text" name="ktp_district"
                value="{{ old('ktp_district') }}"
                oninput="onlyString(this)"
                class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600
                       @error('ktp_district') border-red-500 @else border-gray-300 @enderror">
            @error('ktp_district') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- KELURAHAN --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kelurahan *</label>
            <input type="text" name="ktp_village"
                value="{{ old('ktp_village') }}"
                oninput="onlyString(this)"
                class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600
                       @error('ktp_village') border-red-500 @else border-gray-300 @enderror">
            @error('ktp_village') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- KODE POS --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos *</label>
            <input type="text" name="ktp_postal"
                inputmode="numeric"
                pattern="[0-9]*"
                maxlength="6"
                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                value="{{ old('ktp_postal') }}"
                class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600
                       @error('ktp_postal') border-red-500 @else border-gray-300 @enderror">
            @error('ktp_postal') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

    </div>


    {{-- ====================== ALAMAT DOMISILI ====================== --}}
    <div class="flex items-center justify-between mt-10 mb-4">
        <h3 class="text-lg font-semibold text-gray-800">Alamat Domisili</h3>

        <button type="button" onclick="copyAddress()"
            class="px-4 py-2 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg shadow-sm
                   hover:bg-blue-100 transition text-sm">
            Sama dengan alamat KTP
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- ALAMAT --}}
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat *</label>
            <textarea name="dom_address" rows="3"
                class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600
                       @error('dom_address') border-red-500 @else border-gray-300 @enderror">{{ old('dom_address') }}</textarea>
            @error('dom_address') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- PROVINSI --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi *</label>
            <input type="text" name="dom_province"
                value="{{ old('dom_province') }}"
                oninput="onlyString(this)"
                class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600
                       @error('dom_province') border-red-500 @else border-gray-300 @enderror">
            @error('dom_province') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- KOTA --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kota *</label>
            <input type="text" name="dom_city"
                value="{{ old('dom_city') }}"
                oninput="onlyString(this)"
                class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600
                       @error('dom_city') border-red-500 @else border-gray-300 @enderror">
            @error('dom_city') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- KECAMATAN --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan *</label>
            <input type="text" name="dom_district"
                value="{{ old('dom_district') }}"
                oninput="onlyString(this)"
                class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600
                       @error('dom_district') border-red-500 @else border-gray-300 @enderror">
            @error('dom_district') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- KELURAHAN --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kelurahan *</label>
            <input type="text" name="dom_village"
                value="{{ old('dom_village') }}"
                oninput="onlyString(this)"
                class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600
                       @error('dom_village') border-red-500 @else border-gray-300 @enderror">
            @error('dom_village') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- KODE POS --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos *</label>
            <input type="text" name="dom_postal"
                inputmode="numeric"
                pattern="[0-9]*"
                maxlength="6"
                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                value="{{ old('dom_postal') }}"
                class="w-full px-4 py-3 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-600
                       @error('dom_postal') border-red-500 @else border-gray-300 @enderror">
            @error('dom_postal') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

    </div>

</div>


{{-- NEXT BUTTON --}}
<div class="flex justify-end mt-10">
    <button type="submit"
        class="px-8 py-3 bg-gradient-to-br from-blue-600 to-indigo-600 text-white rounded-lg
               font-semibold shadow-lg hover:opacity-90 transition">
      Selanjutnya →
    </button>
</div>

</form>


<script>
function copyAddress() {
    const from = ["ktp_address","ktp_province","ktp_city","ktp_district","ktp_village","ktp_postal"];
    const to   = ["dom_address","dom_province","dom_city","dom_district","dom_village","dom_postal"];

    from.forEach((f, i) => {
        document.querySelector(`[name="${to[i]}"]`).value =
        document.querySelector(`[name="${f}"]`).value;
    });
}

function onlyString(input) {
    input.value = input.value.replace(/[^A-Za-zs]/g, '');
}

</script>

@endsection
