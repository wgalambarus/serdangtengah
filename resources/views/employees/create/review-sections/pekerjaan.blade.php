<div class="space-y-4">

    @foreach($d['pekerjaan']['position'] as $i => $v)
        <div class="p-4 border rounded-lg bg-gray-50">

            <h4 class="font-semibold text-gray-800 mb-2">{{ $v }}</h4>

            <div class="grid grid-cols-2 gap-3 text-sm">
                <p><strong>Unit / Bidang:</strong> {{ $d['pekerjaan']['work_unit'][$i] }}</p>
                <p><strong>Tanggal Mulai:</strong> {{ $d['pekerjaan']['start_date'][$i] }}</p>
                <p><strong>Tanggal Selesai:</strong> {{ $d['pekerjaan']['end_date'][$i] ?? '-' }}</p>
                <p><strong>Catatan:</strong> {{ $d['pekerjaan']['work_note'][$i] ?? '-' }}</p>
            </div>

        </div>
    @endforeach

</div>
