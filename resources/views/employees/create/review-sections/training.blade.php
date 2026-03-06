@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto py-10">

<form method="POST"
      action="{{ route('employee.create.storeStep','pelatihan') }}"
      enctype="multipart/form-data">

    @csrf

    <div id="training-container" class="space-y-6">

        {{-- Jika ada data lama dari session --}}
        @if(!empty($data['training_name']))
            @foreach($data['training_name'] as $i => $v)

                @include('employees.create.partials._training_row', [
                    'index' => $i,
                    'training_name' => $data['training_name'][$i],
                    'training_provider' => $data['training_provider'][$i],
                    'training_year' => $data['training_year'][$i],
                    'training_location' => $data['training_location'][$i] ?? ''
                ])

            @endforeach
        @else

            {{-- Default row --}}
            @include('employees.create.partials._training_row', [
                'index' => 0
            ])

        @endif

    </div>

    <div class="flex justify-between mt-8">

        <button type="button"
                onclick="addTrainingRow()"
                class="px-4 py-2 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg">
            + Tambah Training
        </button>

        <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded-lg">
            Lanjut
        </button>

    </div>

</form>

</div>

@endsection
<script>

function addTrainingRow() {

    const container = document.getElementById('training-container');
    const index = container.children.length;

    fetch("{{ route('employee.training.row') }}?index=" + index)
        .then(res => res.text())
        .then(html => {
            container.insertAdjacentHTML('beforeend', html);
        });

}

function removeTrainingRow(button) {

    const row = button.closest('.p-8');
    row.remove();

}

</script>