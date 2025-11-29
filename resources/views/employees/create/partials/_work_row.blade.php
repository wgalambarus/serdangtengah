@php
    $i = $index ?? 0;

    $position   = $position   ?? old("position.$i", '');
    $work_unit  = $work_unit  ?? old("work_unit.$i", '');
    $start_date = $start_date ?? old("start_date.$i", '');
    $end_date   = $end_date   ?? old("end_date.$i", '');
    $work_note  = $work_note  ?? old("work_note.$i", '');
@endphp

<div class="p-8 border border-gray-200 rounded-xl bg-gray-50 shadow-sm">

  <div class="flex items-center justify-between mb-6">
    <h4 class="text-sm font-semibold text-gray-700">Riwayat Pekerjaan</h4>

    <button type="button"
            onclick="removeWorkRow(this)"
            class="px-4 py-2 bg-red-50 text-red-700 border border-red-200 rounded-lg shadow">
      Hapus
    </button>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- POSISI --}}
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Posisi / Jabatan *</label>
      <input type="text" name="position[]" value="{{ $position }}"
             class="w-full px-4 py-3 bg-gray-50 border @error("position.$i") border-red-500 @else border-gray-300 @enderror rounded-lg">
      @error("position.$i")
        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
      @enderror
    </div>

    {{-- UNIT --}}
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Unit / Bidang *</label>
      <input type="text" name="work_unit[]" value="{{ $work_unit }}"
             class="w-full px-4 py-3 bg-gray-50 border @error("work_unit.$i") border-red-500 @else border-gray-300 @enderror rounded-lg">
      @error("work_unit.$i")
        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="grid grid-cols-2 gap-6">

      {{-- TANGGAL MULAI --}}
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai *</label>
        <input type="date" name="start_date[]" value="{{ $start_date }}"
               class="w-full px-4 py-3 bg-gray-50 border @error("start_date.$i") border-red-500 @else border-gray-300 @enderror rounded-lg">
        @error("start_date.$i")
          <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- TANGGAL SELESAI --}}
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
        <input type="date" name="end_date[]" value="{{ $end_date }}"
               class="w-full px-4 py-3 bg-gray-50 border @error("end_date.$i") border-red-500 @else border-gray-300 @enderror rounded-lg">
        @error("end_date.$i")
          <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

    </div>

    {{-- CATATAN --}}
    <div class="md:col-span-2">
      <label class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
      <textarea name="work_note[]" rows="3"
                class="w-full px-4 py-3 bg-gray-50 border @error("work_note.$i") border-red-500 @else border-gray-300 @enderror rounded-lg">{{ $work_note }}</textarea>
      @error("work_note.$i")
        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
      @enderror
    </div>

  </div>

</div>
