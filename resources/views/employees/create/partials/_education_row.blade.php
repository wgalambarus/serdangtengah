<div class="p-8 border border-gray-200 rounded-xl bg-gray-50 shadow-sm">

    <div class="flex items-center justify-between mb-6">
        <h4 class="text-sm font-semibold text-gray-700">Pendidikan</h4>

        <button type="button"
                onclick="removeEducationRow(this)"
                class="px-4 py-2 bg-red-200 text-red-700 border border-red-200 rounded-lg 
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

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Sekolah *</label>
            <input type="text" name="school_name[]"
                   value="{{ $school_name }}"
                   class="required-field w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg"/>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kota *</label>
            <input type="text" name="city[]"
                   value="{{ $city }}"
                   class="required-field w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg"/>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Jurusan *</label>
            <input type="text" name="major[]"
                   value="{{ $major }}"
                   class="required-field w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg"/>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Masuk *</label>
                <input type="number" name="year_in[]"
                       value="{{ $year_in }}"
                       inputmode="numeric"
                       pattern="[0-9]{4}"
                       oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,4)"
                       class="required-field w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg"/>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Lulus *</label>
                <input type="number" name="year_out[]"
                       value="{{ $year_out }}"
                       inputmode="numeric"
                       pattern="[0-9]{4}"
                       oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,4)"
                       class="required-field w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg"/>
            </div>
        </div>

    </div>

</div>
