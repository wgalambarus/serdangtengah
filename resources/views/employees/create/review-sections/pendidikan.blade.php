<div class="space-y-4">
    @foreach($d['pendidikan']['school_name'] as $i => $v)
        <div class="p-4 border rounded-lg bg-gray-50">
            <h4 class="font-semibold text-gray-800 mb-2">{{ $v }}</h4>

            <div class="grid grid-cols-2 gap-3 text-sm">
                <p><strong>Kota:</strong> {{ $d['pendidikan']['city'][$i] }}</p>
                <p><strong>Jurusan:</strong> {{ $d['pendidikan']['major'][$i] }}</p>
                <p><strong>Tahun Masuk:</strong> {{ $d['pendidikan']['year_in'][$i] }}</p>
                <p><strong>Tahun Lulus:</strong> {{ $d['pendidikan']['year_out'][$i] }}</p>
            </div>
        </div>
    @endforeach
</div>
