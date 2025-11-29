@php
    $i = $index ?? 0;

    $training_name     = $training_name     ?? old("training_name.$i", '');
    $training_provider = $training_provider ?? old("training_provider.$i", '');
    $training_year     = $training_year     ?? old("training_year.$i", '');
    $training_location = $training_location ?? old("training_location.$i", '');
@endphp

<div class="p-8 border border-gray-200 rounded-xl bg-gray-50 shadow-sm">

  <div class="flex items-center justify-between mb-6">
    <h4 class="text-sm font-semibold text-gray-700">Training</h4>
    <button type="button" onclick="removeTrainingRow(this)"
            class="px-4 py-2 bg-red-50 text-red-700 border border-red-200 rounded-lg">
      Hapus
    </button>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- NAMA TRAINING --}}
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pelatihan *</label>
      <input type="text" name="training_name[]" value="{{ $training_name }}"
             class="w-full px-4 py-3 bg-gray-50 border @error("training_name.$i") border-red-500 @else border-gray-300 @enderror rounded-lg">
      @error("training_name.$i") <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- PROVIDER --}}
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Penyelenggara *</label>
      <input type="text" name="training_provider[]" value="{{ $training_provider }}"
             class="w-full px-4 py-3 bg-gray-50 border @error("training_provider.$i") border-red-500 @else border-gray-300 @enderror rounded-lg">
      @error("training_provider.$i") <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Tahun + Lokasi --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- Kolom Kiri: Tahun -->
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Tahun *</label>
      <input type="number" name="training_year[]" value="{{ $training_year }}"
              inputmode="numeric"
              pattern="[0-9]{4}"
              oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,4)"
              class="w-full px-4 py-3 bg-gray-50 border @error("training_year.$i") border-red-500 @else border-gray-300 @enderror rounded-lg">
      @error("training_year.$i") <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Kolom Kanan: Lokasi -->
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
      <input type="text" name="training_location[]" value="{{ $training_location }}"
             class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg">
    </div>

</div>

<!-- SERTIFIKAT (opsional) → 1 kolom sendiri -->
<div">
    <label class="block text-sm font-medium text-gray-700 mb-1">Sertifikat (Opsional)</label>
    <input type="file" name="training_certificate[]"
           class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg">
</div>

</div>
