<div class="space-y-4">

    @foreach($d['pelatihan']['training_name'] as $i => $v)
        <div class="p-4 border rounded-lg bg-gray-50">

            <h4 class="font-semibold text-gray-800 mb-2">{{ $v }}</h4>

            <div class="grid grid-cols-2 gap-3 text-sm">
                <p><strong>Penyelenggara:</strong> {{ $d['pelatihan']['training_provider'][$i] }}</p>
                <p><strong>Tahun:</strong> {{ $d['pelatihan']['training_year'][$i] }}</p>
                <p><strong>Lokasi:</strong> {{ $d['pelatihan']['training_location'][$i] ?? '-' }}</p>
            </div>

        </div>
    @endforeach

</div>
