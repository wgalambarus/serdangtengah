@extends('layouts.main', ['currentPage' => 'Karyawan'])

@section('title', 'Tambah Karyawan - Pendidikan')

@section('content')
<div class="max-w-4xl mx-auto py-12">

  <!-- ===================================================== -->
  <!-- STEPPER (STEP 3) – mengikuti style referensi          -->
  <!-- ===================================================== -->
  <div class="relative mb-32">

    <!-- background line -->
    <div class="absolute top-1/2 left-0 w-full h-1 bg-gray-200 rounded-full -translate-y-1/2"></div>

    <!-- active progress bar (50%) -->
    <div class="absolute top-1/2 left-0 h-1 bg-gradient-to-r from-blue-600 to-indigo-600 
                rounded-full -translate-y-1/2"
         style="width: 50%;"></div>

    <!-- STEPS -->
    <div class="relative flex justify-between items-center">

      <!-- Step 1 -->
      <div class="flex flex-col items-center">
        <div class="flex items-center justify-center text-white font-semibold bg-blue-600 shadow"
             style="width:46px; height:46px; border-radius:9999px;">✓</div>
        <span class="text-xs text-gray-700 mt-2">Informasi Umum</span>
      </div>

      <!-- Step 2 -->
      <div class="flex flex-col items-center">
        <div class="flex items-center justify-center text-white font-semibold bg-blue-600 shadow"
             style="width:46px; height:46px; border-radius:9999px;">✓</div>
        <span class="text-xs text-gray-700 mt-2">Alamat</span>
      </div>

      <!-- Active Step -->
      <div class="flex flex-col items-center">
        <div class="flex items-center justify-center text-white font-semibold shadow-md 
                    bg-gradient-to-br from-blue-600 to-indigo-600"
             style="width:46px; height:46px; border-radius:9999px;">3</div>
        <span class="text-xs text-gray-900 font-medium mt-2">Pendidikan</span>
      </div>

      @foreach ([4=>'Tanggungan',5=>'Pekerjaan',6=>'Training'] as $n=>$label)
      <div class="flex flex-col items-center opacity-60">
        <div class="flex items-center justify-center text-gray-600 bg-white border border-gray-300"
             style="width:46px; height:46px; border-radius:9999px;">{{ $n }}</div>
        <span class="text-xs text-gray-500 mt-2">{{ $label }}</span>
      </div>
      @endforeach

    </div>
  </div>


  <!-- ===================================================== -->
  <!-- CARD SECTION – konsisten dengan referensi kamu        -->
  <!-- ===================================================== -->
  <form method="POST" action="{{ route('employee.create.store', 'pendidikan') }}">
  @csrf
  <div class="bg-white shadow-md border border-gray-200 rounded-xl mt-10 p-8 mb-14">

    <div class="flex items-center justify-between mb-8">
      <h2 class="text-xl font-semibold text-gray-900">Riwayat Pendidikan</h2>

      <!-- Button tambah pendidikan -->
      <button type="button"
              onclick="addEducationRow()"
              class="px-4 py-2 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg 
                     shadow-sm hover:bg-blue-100 transition text-sm font-medium flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4v16m8-8H4" />
        </svg>
        Tambah Pendidikan
      </button>
    </div>

    <!-- Education Rows Container -->
<div id="educationContainer" class="space-y-12">

    {{-- Jika ada data lama → looping sesuai jumlah --}}
    @if(isset($data['school_name']))
        @foreach ($data['school_name'] as $i => $val)
            @include('employees.create.partials._education_row', [
                'school_name' => $data['school_name'][$i],
                'city'        => $data['city'][$i],
                'major'       => $data['major'][$i],
                'year_in'     => $data['year_in'][$i],
                'year_out'    => $data['year_out'][$i]
            ])
        @endforeach

    {{-- Jika tidak ada data → tampilkan 1 row default --}}
    @else
        @include('employees.create.partials._education_row', [
            'school_name' => '',
            'city'        => '',
            'major'       => '',
            'year_in'     => '',
            'year_out'    => ''
        ])
    @endif

</div>


  </div>
  <!-- NEXT BUTTON -->
  <div class="flex justify-end mt-10">
    <button id="nextBtn"
            class="px-8 py-3 bg-gradient-to-br from-blue-600 to-indigo-600 text-white rounded-lg
                   font-semibold shadow-lg hover:opacity-90 transition">
      Selanjutnya →
    </button>
  </div>
</form>
</div>


<script>
function addEducationRow() {
  const container = document.getElementById('educationContainer');
  const clone = container.children[0].cloneNode(true);

  clone.querySelectorAll("input").forEach(i => i.value = "");

  container.appendChild(clone);
}

function removeEducationRow(btn) {
  const container = document.getElementById('educationContainer');
  if (container.children.length > 1) {
    btn.closest("div.p-8").remove();
  }
}
</script>
@endsection
