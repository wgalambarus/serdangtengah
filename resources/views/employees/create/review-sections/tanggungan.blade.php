@if(!empty($d['tanggungan']['dependent_name']))
    <div class="space-y-4">

        @foreach($d['tanggungan']['dependent_name'] as $i => $v)
            <div class="p-4 border rounded-lg bg-gray-50">

                <h4 class="font-semibold text-gray-800 mb-2">{{ $v }}</h4>

                <div class="grid grid-cols-2 gap-3 text-sm">
                    <p><strong>Jenis Kelamin:</strong> {{ $d['tanggungan']['dependent_gender'][$i] }}</p>
                    <p><strong>Tanggal Lahir:</strong> {{ $d['tanggungan']['dependent_birth'][$i] }}</p>
                    <p><strong>Pendidikan:</strong> {{ $d['tanggungan']['dependent_education'][$i] }}</p>
                </div>

            </div>
        @endforeach

    </div>
@else
    <p class="text-sm text-gray-600">Tidak ada data tanggungan.</p>
@endif
