<div class="p-8 border border-gray-200 rounded-xl bg-gray-50 shadow-sm">

  <div class="flex items-center justify-between mb-6">
    <h4 class="text-sm font-semibold text-gray-700">Tanggungan</h4>

    <button type="button"
            onclick="removeDependentRow(this)"
            class="px-4 py-2 bg-red-50 text-red-700 border border-red-200 rounded-lg 
                   shadow-sm hover:bg-red-100 transition text-sm flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
           viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M6 18L18 6M6 6l12 12" />
      </svg>
      Hapus
    </button>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Nama --}}
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Nama *</label>
      <input type="text" name="dependent_name[]"
             value="{{ $name }}"
             class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg
                    focus:ring-2 focus:ring-blue-600" />
    </div>

    {{-- Tanggal Lahir --}}
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir *</label>
      <input type="date" name="dependent_birth[]"
             value="{{ $birth }}"
             class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg
                    focus:ring-2 focus:ring-blue-600" />
    </div>

    {{-- Jenis Kelamin --}}
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin *</label>
      <select name="dependent_gender[]"
              class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg
                     focus:ring-2 focus:ring-blue-600">
        <option value="">Pilih...</option>
        <option value="L" {{ $gender=='L'?'selected':'' }}>Laki-laki</option>
        <option value="P" {{ $gender=='P'?'selected':'' }}>Perempuan</option>
      </select>
    </div>

    {{-- Pendidikan Terakhir --}}
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Pendidikan Terakhir *</label>
      <select name="dependent_education[]"
              class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg
                     focus:ring-2 focus:ring-blue-600">
        <option value="">Pilih...</option>
        @foreach(['TK','SD','SMP','SMA/SMK','D3','S1','S2'] as $edu)
        <option value="{{ $edu }}" {{ $education==$edu?'selected':'' }}>{{ $edu }}</option>
        @endforeach
      </select>
    </div>

  </div>

</div>
