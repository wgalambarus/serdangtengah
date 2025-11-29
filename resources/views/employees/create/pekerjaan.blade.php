@extends('layouts.main', ['currentPage' => 'Karyawan'])

@section('title', 'Tambah Karyawan - Pekerjaan')

@section('content')
<div class="max-w-4xl mx-auto py-12">

  <!-- ===================================================== -->
  <!--                     STEPPER STEP 5                    -->
  <!-- ===================================================== -->
  <div class="relative mb-32">

    <!-- background -->
    <div class="absolute top-1/2 left-0 w-full h-1 bg-gray-200 rounded-full -translate-y-1/2"></div>

    <!-- progress bar (83%) -->
    <div class="absolute top-1/2 left-0 h-1 bg-gradient-to-r from-blue-600 to-indigo-600 
                rounded-full -translate-y-1/2"
         style="width: 83%;"></div>

    <div class="relative flex justify-between items-center">

      <!-- step 1–4 complete -->
      @foreach ([1=>'Informasi Umum',2=>'Alamat',3=>'Pendidikan',4=>'Tanggungan'] as $num=>$label)
      <div class="flex flex-col items-center">
        <div class="flex items-center justify-center text-white font-semibold bg-blue-600 shadow"
             style="width:46px;height:46px;border-radius:9999px;">✓</div>
        <span class="text-xs text-gray-700 mt-2">{{ $label }}</span>
      </div>
      @endforeach

      <!-- Active Step -->
      <div class="flex flex-col items-center">
        <div class="flex items-center justify-center text-white font-semibold shadow-md 
                    bg-gradient-to-br from-blue-600 to-indigo-600"
             style="width:46px;height:46px;border-radius:9999px;">5</div>
        <span class="text-xs text-gray-900 font-medium mt-2">Pekerjaan</span>
      </div>

      <!-- Step 6 upcoming -->
      <div class="flex flex-col items-center opacity-60">
        <div class="flex items-center justify-center text-gray-600 bg-white border border-gray-300"
             style="width:46px;height:46px;border-radius:9999px;">6</div>
        <span class="text-xs text-gray-500 mt-2">Training</span>
      </div>

    </div>
  </div>



  <!-- ===================================================== -->
  <!--                CARD — RIWAYAT PEKERJAAN               -->
  <!-- ===================================================== -->
  <div class="bg-white shadow-md border border-gray-200 rounded-xl mt-10 p-8 mb-14">
    <form method="POST" action="{{ route('employee.create.store', 'pekerjaan') }}">
      @csrf
    <div class="flex items-center justify-between mb-8">
      <h2 class="text-xl font-semibold text-gray-900">Riwayat Pekerjaan</h2>

      <button type="button"
              onclick="addWorkRow()"
              class="px-4 py-2 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg 
                     shadow-sm hover:bg-blue-100 transition text-sm font-medium flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4v16m8-8H4" />
        </svg>
        Tambah Riwayat
      </button>
    </div>


<div id="workContainer" class="space-y-12">

    {{-- 1. OLD INPUT (VALIDATION ERROR) --}}
    @if(old('position'))
        @foreach(old('position') as $i => $v)
            @include('employees.create.partials._work_row', [
                'index' => $i,
                'position' => old("position.$i"),
                'work_unit' => old("work_unit.$i"),
                'start_date' => old("start_date.$i"),
                'end_date' => old("end_date.$i"),
                'work_note' => old("work_note.$i"),
            ])
        @endforeach

    {{-- 2. SESSION --}}
    @elseif(isset($data['position']))
        @foreach($data['position'] as $i => $v)
            @include('employees.create.partials._work_row', [
                'index' => $i,
                'position' => $data['position'][$i] ?? '',
                'work_unit' => $data['work_unit'][$i] ?? '',
                'start_date' => $data['start_date'][$i] ?? '',
                'end_date' => $data['end_date'][$i] ?? '',
                'work_note' => $data['work_note'][$i] ?? '',
            ])
        @endforeach

    {{-- 3. DEFAULT EMPTY ROW --}}
    @else
        @include('employees.create.partials._work_row', [
            'index' => 0,
            'position' => '',
            'work_unit' => '',
            'start_date' => '',
            'end_date' => '',
            'work_note' => '',
        ])
    @endif

</div>


  </div>



  <!-- NEXT BUTTON -->
  <div class="flex justify-end mt-10">
    <button id="nextBtn" type="submit"
            class="px-8 py-3 bg-gradient-to-br from-blue-600 to-indigo-600 text-white rounded-lg
                   font-semibold shadow-lg hover:opacity-90 transition">
      Selanjutnya →
    </button>
  </div>
</form>
</div>



<script>
function addWorkRow() {
  const container = document.getElementById('workContainer');
  const clone = container.children[0].cloneNode(true);

  clone.querySelectorAll("input, select, textarea").forEach(el => el.value = "");
  container.appendChild(clone);
}

function removeWorkRow(btn) {
  const container = document.getElementById('workContainer');
  if (container.children.length > 1) {
    btn.closest("div.p-8").remove();
  }
}
</script>

@endsection
