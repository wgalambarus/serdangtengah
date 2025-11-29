<div class="space-y-6 text-sm">

    <div>
        <h4 class="font-semibold mb-2 text-gray-800">Alamat KTP</h4>
        <div class="pl-2 border-l-4 border-blue-500 space-y-1">
            <p>{{ $d['alamat-karyawan']['ktp_address'] }}</p>
            <p>{{ $d['alamat-karyawan']['ktp_city'] }}, {{ $d['alamat-karyawan']['ktp_province'] }}</p>
            <p>Kode Pos: {{ $d['alamat-karyawan']['ktp_postal'] }}</p>
        </div>
    </div>

    <div>
        <h4 class="font-semibold mb-2 text-gray-800">Alamat Domisili</h4>
        <div class="pl-2 border-l-4 border-green-500 space-y-1">
            <p>{{ $d['alamat-karyawan']['dom_address'] }}</p>
            <p>{{ $d['alamat-karyawan']['dom_city'] }}, {{ $d['alamat-karyawan']['dom_province'] }}</p>
            <p>Kode Pos: {{ $d['alamat-karyawan']['dom_postal'] }}</p>
        </div>
    </div>

</div>
