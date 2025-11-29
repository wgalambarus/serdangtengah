@extends('layouts.main', ['currentPage' => 'Karyawan'])

@section('title', 'Tambah Karyawan - Training')

@section('content')
<div class="max-w-4xl mx-auto py-12">

  <!-- ===================================================== -->
  <!--                       STEPPER                         -->
  <!-- ===================================================== -->
  <div class="relative mb-32">

    <!-- background -->
    <div class="absolute top-1/2 left-0 w-full h-1 bg-gray-200 rounded-full -translate-y-1/2"></div>

    <!-- progress bar -->
    <div class="absolute top-1/2 left-0 h-1 bg-gradient-to-r from-blue-600 to-indigo-600 
                rounded-full -translate-y-1/2"
         style="width: 100%;"></div>

    <div class="relative flex justify-between items-center">

      @foreach ([1=>'Informasi Umum',2=>'Alamat',3=>'Pendidikan',4=>'Tanggungan',5=>'Pekerjaan'] as $num=>$label)
      <div class="flex flex-col items-center">
        <div class="flex items-center justify-center text-white font-semibold bg-blue-600 shadow-md"
             style="width:46px;height:46px;border-radius:9999px;">✓</div>
        <span class="text-xs text-gray-700 mt-2">{{ $label }}</span>
      </div>
      @endforeach

      <!-- Active -->
      <div class="flex flex-col items-center">
        <div class="flex items-center justify-center text-white font-semibold shadow-md 
                    bg-gradient-to-br from-blue-600 to-indigo-600"
             style="width:46px;height:46px;border-radius:9999px;">6</div>
        <span class="text-xs text-gray-900 font-medium mt-2">Training</span>
      </div>

    </div>
  </div>



  <!-- ===================================================== -->
  <!--                   CARD TRAINING                       -->
  <!-- ===================================================== -->
  <div class="bg-white shadow-md border border-gray-200 rounded-xl mt-10 p-8 mb-14">

    <div class="flex items-center justify-between mb-8">
      <h2 class="text-xl font-semibold text-gray-900">Training / Pelatihan</h2>

      <button type="button"
              onclick="addTrainingRow()"
              class="px-4 py-2 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg">
        Tambah Training
      </button>
    </div>


    <!-- ====================== FORM ====================== -->
    <form method="POST" action="{{ route('employee.create.store', 'pelatihan') }}" enctype="multipart/form-data">
      @csrf

      <div id="trainingContainer" class="space-y-12">

        {{-- 1. If validation error --}}
        @if(old('training_name'))
            @foreach(old('training_name') as $i => $val)
                @include('employees.create.partials._training_row', [
                    'index' => $i,
                    'training_name' => old("training_name.$i"),
                    'training_provider' => old("training_provider.$i"),
                    'training_year' => old("training_year.$i"),
                    'training_location' => old("training_location.$i"),
                ])
            @endforeach

        {{-- 2. If session data exists --}}
        @elseif(isset($data['training_name']))
            @foreach($data['training_name'] as $i => $val)
                @include('employees.create.partials._training_row', [
                    'index' => $i,
                    'training_name' => $data['training_name'][$i] ?? '',
                    'training_provider' => $data['training_provider'][$i] ?? '',
                    'training_year' => $data['training_year'][$i] ?? '',
                    'training_location' => $data['training_location'][$i] ?? '',
                ])
            @endforeach

        {{-- 3. Default empty row --}}
        @else
            @include('employees.create.partials._training_row', ['index' => 0])
        @endif

      </div>


      <!-- SUBMIT BUTTON (tidak ikut looping) -->
      <div class="flex justify-end mt-10">
        <button type="submit"
                class="px-8 py-3 bg-gradient-to-br from-blue-600 to-indigo-600 text-white rounded-lg font-semibold shadow-lg hover:opacity-90 transition">
          Selanjutnya →
        </button>
      </div>

    </form>
  </div>
</div>


<!-- ===================================================== -->
<!--                    JAVASCRIPT                         -->
<!-- ===================================================== -->
<script>
function addTrainingRow() {
  const container = document.getElementById('trainingContainer');
  const clone = container.children[0].cloneNode(true);

  // kosongkan value input
  clone.querySelectorAll("input, textarea").forEach(el => el.value = "");
  
  container.appendChild(clone);
}

function removeTrainingRow(btn) {
  const container = document.getElementById('trainingContainer');
  if (container.children.length > 1) {
    btn.closest("div.p-8").remove();
  }
}
</script>

@endsection
