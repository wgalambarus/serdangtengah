<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <style>
        @page {
            size: A4;
            margin-top: 5mm;

        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10px;
            color: #000;
        }

        .page {
            width: 100%;
        }

        /* Untuk mendorong tulisan GOL ke pojok kanan baris .value */
        .value-container {
            display: block;
            width: 100%;
        }

        .gol-label {
            float: right;
            font-weight: normal;
            padding-right: 5px;
        }

        /* Label Di Unit tanpa garis bawah */
        .unit-label {
            width: 60px;
            text-align: center;
            vertical-align: bottom;
            font-style: italic;
        }

        /* Perlebar min-width agar garis isi cukup panjang */
        .info-underlined {
            border-bottom: 1px solid #000;
            text-align: center;
            min-width: 120px;
            vertical-align: bottom;
            padding-bottom: 2px;
        }

        /* Pastikan section membungkus semua halaman jika data banyak */
        .section {
            border: 1px solid #000;
            padding: 12px;
            box-decoration-break: clone;
            -webkit-box-decoration-break: clone;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .footer-table td {
            vertical-align: top;
        }

        u {
            text-decoration: underline;
        }

        .company {
            font-weight: bold;
            font-size: 16px;
        }

        .title {
            font-size: 16px;
            font-weight: bold;
            margin-top: 2px;
        }

        .data-kepegawaian {
            font-size: 16px;
            font-weight: bold;
            margin-top: 2px;
        }

        .table-bordered {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #000;
            padding: 4px;
            font-size: 11px;
        }

        .table-bordered th {
            text-align: center;
            font-weight: bold;
        }

        .header-right {
            font-size: 11px;
            text-align: right;
        }

        .section {
            border: 1px solid #000;
            padding: 12px;
        }

        .section-title {
            font-weight: bold;
            margin: 15px 0 8px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            padding: 3px;
        }

        .table td {
            padding: 3px 1px;
            vertical-align: top;
        }

        .no {
            width: 10px;
        }

        .label {
            width: 160px;
        }

        .dot {
            width: 10px;
        }

        .value {
            border-bottom: 1px solid #000;
            padding-left: 10px;
            width: 30%
        }

        .sub-value {
            padding-left: 5px;
        }

        .small {
            font-size: 11px;
        }

        .spacer {
            width: 10px;
        }

        .info-text {
            font-style: italic;
            padding-left: 5px;
        }

        /* Untuk label dd/mm/yyyy agar di tengah */
        .info-header {
            text-align: center;
            font-size: 10px;
            /* Lebih kecil agar manis */
            vertical-align: bottom;
        }

        /* Untuk nilai tanggal agar ada garis bawah dan di tengah */
        .info-underlined {
            border-bottom: 1px solid #000;
            text-align: center;
            min-width: 100px;
            /* Memberikan panjang garis yang konsisten */
            vertical-align: bottom;
        }

        .footer-container {
            margin-top: 30px;
            border-top: 1px solid #000;
            /* GARIS DI ATAS FOOTER */
            padding-top: 10px;
            margin-left: -10px;
            /* Menarik garis ke kiri agar menempel border section */
            margin-right: -10px;
            /* Menarik garis ke kanan agar menempel border section */
            padding-left: 10px;
            /* Mengembalikan jarak teks agar tidak menempel ke kiri */
            padding-right: 10px;
            /* Mengembalikan jarak teks agar tidak menempel ke kanan */
        }
    </style>

</head>

<body>

    <div class="page">

        <div class="header">

            <div>
                <div class="company">PT. SERDANG TENGAH</div>
                <div class="title">DATA KEPEGAWAIAN / PERSONALIA</div>
            </div>

            <div class="header-right">
                <div style="text-align: right;">
                    <div style="margin-bottom: 8px;">Unit Kerja: {{ $unit_kerja ?? 'Kebun Tanjung Purba (*)' }}</div>
                    <div>N.I.K: {{ $nik_kerja ?? '' }}</div>
                </div>
            </div>

        </div>

        <div class="section">

            <div class="section-title">I. DATA PRIBADI</div>

            <table class="table">

                <tr>
                <tr>
                    <td class="no">1</td>
                    <td class="label">Nama</td>
                    <td class="dot">:</td>
                    <td class="value">{{ $employee->full_name }}</td>
                    <td class="spacer"></td>
                    <td class="info-header">dd/mm/yyyy</td>
                </tr>

                <tr>
                    <td class="no">2</td>
                    <td class="label">Tempat / Tanggal Lahir</td>
                    <td class="dot">:</td>
                    <td class="value">{{ $employee->birth_place }}</td>
                    <td class="spacer"></td>
                    <td class="info-underlined">
                        {{ \Carbon\Carbon::parse($employee->birth_date)->format('d/m/Y') }}
                    </td>
                </tr>

                <tr>
                    <td class="no">3</td>
                    <td class="label">Jenis Kelamin</td>
                    <td class="dot">:</td>
                    <td class="value">{{ $employee->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td class="spacer"></td>
                    <td class="info-text">( Laki - laki / Perempuan )</td>
                </tr>

                <tr>
                    <td class="no">4</td>
                    <td class="label">Pendidikan Terakhir</td>
                    <td class="dot">:</td>
                    <td class="value">{{ $employee->last_education }}</td>
                    <td class="spacer"></td>
                    <td class="info-text">( Pendidikan Formal dengan Ijazah Tertinggi )</td>
                </tr>

                <tr>
                    <td class="no">5</td>
                    <td class="label">Status Perkawinan (**)</td>
                    <td class="dot">:</td>
                    <td class="value">{{ ucwords(str_replace('_', ' ', strtolower($employee->marital_status))) }}</td>
                    <td class="spacer"></td>
                    <td class="info-text">( Menikah / Duda / Janda / Belum Menikah )</td>
                </tr>

                <tr>
                    <td class="no">6</td>
                    <td class="label">Agama</td>
                    <td class="dot">:</td>
                    <td class="value">{{ $employee->religion }}</td>

                </tr>

                <tr>
                    <td class="no">7</td>
                    <td class="label">Golongan Darah</td>
                    <td class="dot">:</td>
                    <td class="value">{{ $employee->blood_type }}</td>
                </tr>

                <tr>
                    <td class="no">8</td>
                    <td class="label">Keahlian</td>
                    <td class="dot">:</td>
                    <td class="value">
                        {{ $employee->skills ? (is_array($decoded = json_decode($employee->skills, true)) ? implode(', ', $decoded) : str_replace(' ', ', ', $employee->skills)) : '' }}
                    </td>
                    <td class="spacer"></td>
                    <td class="info-text">( Sebutkan secara spesifik)</td>
                </tr>

                <tr>
                    <td class="no">9</td>
                    <td class="label">No. KTP</td>
                    <td class="dot">:</td>
                    <td class="value">{{ $employee->national_id }}</td>
                </tr>

                <tr>
                    <td class="no">10</td>
                    <td class="label">Alamat Sesuai KTP</td>
                    <td class="dot">:</td>
                    <td class="value">{{ $ktp->address_line ?? '' }}</td>
                </tr>

                <tr>
                    <td class="no">11</td>
                    <td class="label">Desa / Kelurahan Kecamatan</td>
                    <td class="dot">:</td>
                    <td class="value">{{ $ktp->village ?? '' }} / {{ $ktp->district ?? '' }}</td>
                </tr>


                <tr>
                    <td class="no">12</td>
                    <td class="label">Kabupaten / Kota</td>
                    <td class="dot">:</td>
                    <td class="value">{{ $ktp->city ?? '' }}</td>
                </tr>

                <tr>
                    <td class="no">13</td>
                    <td class="label">Alamat Tempat Tinggal Saat Ini</td>
                    <td class="dot">:</td>
                    <td class="value">{{ $dom->address_line ?? '' }}</td>
                </tr>

                <tr>
                    <td class="no">14</td>
                    <td class="label">Desa / Kelurahan Kecamatan</td>
                    <td class="dot">:</td>
                    <td class="value">{{ $dom->village ?? '' }} / {{ $dom->district ?? '' }}</td>
                </tr>


                <tr>
                    <td class="no">15</td>
                    <td class="label">Kabupaten / Kota</td>
                    <td class="dot">:</td>
                    <td class="value">{{ $dom->city ?? '' }}</td>
                </tr>

                <tr>
                    <td class="no">16</td>
                    <td class="label">No. NPWP</td>
                    <td class="dot">:</td>
                    <td class="value">{{ $employee->npwp }}</td>
                </tr>

                <tr>
                    <td class="no">17</td>
                    <td class="label">No. KTA BPJS Tenaga Kerja</td>
                    <td class="dot">:</td>
                    <td class="value">{{ $employee->bpjs_tk }}</td>
                </tr>

                <tr>
                    <td class="no">18</td>
                    <td class="label">No. KTA BPJS Kesehatan</td>
                    <td class="dot">:</td>
                    <td class="value">{{ $employee->bpjs_kes }}</td>
                </tr>

                <tr>
                    <td class="no">19</td>
                    <td class="label">No. HP</td>
                    <td class="dot">:</td>
                    <td class="value">{{ $employee->phone }}</td>
                </tr>

                <tr>
                    <td class="no">20</td>
                    <td class="label">Nama Keluarga yg bisa dihubungi</td>
                    <td class="dot">:</td>
                    <td class="value">{{ $employee->emergency_name }}</td>
                </tr>

                <tr>
                    <td class="no">21</td>
                    <td class="label">Hubungan</td>
                    <td class="dot">:</td>
                    <td class="value">{{ $employee->emergency_name }}</td>
                </tr>

                <tr>
                    <td class="no">22</td>
                    <td class="label">No. HP</td>
                    <td class="dot">:</td>
                    <td class="value">{{ $employee->emergency_phone }}</td>
                    <td></td>
                </tr>
            </table>


            <div class="section-title">II. DATA ISTRI / SUAMI</div>


            <table class="table">

                <tr>
                    <td class="no">1</td>
                    <td class="label">Nama Istri / Suami (*)</td>
                    <td class="dot">:</td>
                    <td class="value">{{ $spouse->name ?? '' }}</td>
                    <td></td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>Tanggal Lahir</td>
                    <td>:</td>
                    <td class="value">{{ $spouse->birth_date ?? '' }}</td>
                    <td></td>
                </tr>

                <tr>
                    <td>3</td>
                    <td>Pendidikan Terakhir</td>
                    <td>:</td>
                    <td class="value">{{ $spouse->last_education ?? '' }}</td>
                    <td class="spacer"></td>
                    <td class="info-text">( Pendidikan Formal dengan Ijazah Tertinggi )</td>
                </tr>
            </table>


            <div class="section-title">III. DATA ANAK / TANGGUNGAN</div>

            <table class="table">

                @php
                    $letters = ['a', 'b', 'c', 'd', 'e'];
                @endphp

                @foreach($children as $i => $child)

                    <tr>
                        <td class="no">{{ $i + 1 }}a</td>
                        <td class="label">Nama Anak / Tanggungan (*)</td>
                        <td class="dot">:</td>
                        <td class="value">{{ $child->name }}</td>
                    </tr>

                    <tr>
                        <td class="no">{{ $i + 1 }}b</td>
                        <td>Tanggal Lahir</td>
                        <td>:</td>
                        <td class="value">{{ \Carbon\Carbon::parse($child->birth_date)->format('d-m-Y') }}</td>
                    </tr>

                    <tr>
                        <td class="no">{{ $i + 1 }}c</td>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td class="value">{{ $child->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td class="spacer"></td>
                        <td class="info-text">( Laki - Laki / Perempuan )</td>
                    </tr>

                    <tr>
                        <td class="no">{{ $i + 1 }}d</td>
                        <td>Pendidikan Terakhir</td>
                        <td>:</td>
                        <td class="value">{{ $child->last_education }}</td>
                        <td class="spacer"></td>
                        <td class="info-text">( Pendidikan Formal dengan Ijazah Tertinggi )</td>
                    </tr>

                    {{-- Spacer --}}
                    <tr>
                        <td colspan="4" style="height: 15px;"></td>
                    </tr>

                @endforeach
            </table>


            <div class="section-title">IV. RIWAYAT PEKERJAAN</div>

            <table class="table">
                <tr>
                    <td class="no">1</td>
                    <td class="label">Status Kepegawaian saat ini</td>
                    <td class="dot">:</td>
                    <td class="value">
                        {{ $firstJob->status ?? '' }}
                        <span class="gol-label">GOL :{{ $firstJob->grade ?? '' }}</span>
                    </td>
                    <td class="spacer"></td>
                    <td class="info-underlined">
                        {{-- Isi SKU di sini --}}
                        SKU{{ $firstJob->sku_number ?? '' }}
                    </td>
                </tr>

                <tr>
                    <td class="no">2</td>
                    <td class="label">Tanggal mulai Karyawan</td>
                    <td class="dot">:</td>
                    <td class="value">
                        @if($firstJob->status == 'Karyawan')
                            {{ \Carbon\Carbon::parse($firstJob->start_date)->format('d-m-Y') }}
                        @else
                            {{-- Garis kosong jika status bukan Karyawan --}}
                        @endif
                    </td>
                    <td class="unit-label">Di Unit :</td>
                    <td class="info-underlined">
                        @if($firstJob->status == 'Karyawan')
                            {{ $firstJob->unit }}
                        @else
                            {{-- Garis kosong jika status bukan Karyawan --}}
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class="no">3</td>
                    <td class="label">Tanggal mulai Pegawai</td>
                    <td class="dot">:</td>
                    <td class="value">
                        @if($firstJob->status == 'Pegawai')
                            {{ \Carbon\Carbon::parse($firstJob->start_date)->format('d-m-Y') }}
                        @else
                            {{-- Garis kosong jika status bukan Pegawai --}}
                        @endif
                    </td>
                    <td class="unit-label">Di Unit :</td>
                    <td class="info-underlined">
                        @if($firstJob->status == 'Pegawai')
                            {{ $firstJob->unit }}
                        @else
                            {{-- Garis kosong jika status bukan Pegawai --}}
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class="no">4</td>
                    <td class="label">Tanggal mulai Staff</td>
                    <td class="dot">:</td>
                    <td class="value">
                        @if($firstJob->status == 'Staff')
                            {{ \Carbon\Carbon::parse($firstJob->start_date)->format('d-m-Y') }}
                        @else
                            {{-- Garis kosong jika status bukan Staff --}}
                        @endif
                    </td>
                    <td class="unit-label">Di Unit :</td>
                    <td class="info-underlined">
                        @if($firstJob->status == 'Staff')
                            {{ $firstJob->unit }}
                        @else
                            {{-- Garis kosong jika status bukan Staff --}}
                        @endif
                    </td>
                </tr>
            </table>


            <div class="section-title">V. RIWAYAT JABATAN</div>

            <table class="table">
                @forelse($restJobs as $i => $job)
                    <tr>
                        <td class="no">{{ $loop->iteration }}a</td>
                        <td class="label">Nama Jabatan</td>
                        <td class="dot">:</td>
                        <td class="value">{{ $job->position ?? '' }}</td>
                        <td class="unit-label">Di :</td>
                        <td class="info-underlined">{{ $job->unit ?? '' }}</td>
                    </tr>

                    <tr>
                        <td class="no">{{ $loop->iteration }}b</td>
                        <td class="label">Tanggal mulai menjabat</td>
                        <td class="dot">:</td>
                        <td class="value">{{ \Carbon\Carbon::parse($job->start_date)->format('d-m-Y') }}</td>
                        <td colspan="2"></td>
                    </tr>

                    {{-- Jarak antar riwayat jabatan --}}
                    <tr>
                        <td colspan="6" style="height: 10px;"></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; font-style: italic; color: #888; padding: 10px;">
                            Tidak ada riwayat jabatan tambahan.
                        </td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>
    <div style="page-break-before: always;"></div>
    <div class="page">

        <div class="header">

            <div>
                <div class="data-kepegawaian">DATA KEPEGAWAIAN</div>
            </div>

        </div>
        <div class="page">

            <div class="section">
                <div class="section-title">VI. DATA PENDIDIKAN</div>

                <table class="table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Sekolah</th>
                            <th>Kota</th>
                            <th>Jurusan</th>
                            <th width="12%">Tahun Masuk</th>
                            <th width="12%">Tahun Lulus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($educations as $i => $edu)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $edu->school_name }}</td>
                                <td>{{ $edu->city }}</td>
                                <td>{{ $edu->major }}</td>
                                <td>{{ $edu->year_in }}</td>
                                <td>{{ $edu->year_out }}</td>
                            </tr>
                        @empty
                            @for($i = 0; $i < 5; $i++)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>&nbsp;</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endfor
                        @endforelse
                    </tbody>
                </table>

                <div class="small" style="margin-top:5px; font-style: italic;">
                    Note: Urutkan dari yang terendah
                </div>


                {{-- VII --}}
                <div class="section-title">VII. DATA TRAINING, PELATIHAN & PENGHARGAAN / JUBELIUM</div>

                <table class="table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Pelatihan / Penghargaan</th>
                            <th width="10%">Tahun</th>
                            <th width="15%">Lokasi</th>
                            <th>Penyelenggara / Pelaksana</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($trainings as $i => $t)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $t->title }}</td>
                                <td>{{ $t->year }}</td>
                                <td>{{ $t->location }}</td>
                                <td>{{ $t->provider }}</td>
                            </tr>
                        @empty
                            @for($i = 0; $i < 8; $i++)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>&nbsp;</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endfor
                        @endforelse
                    </tbody>
                </table>


                {{-- VIII --}}
                <div class="section-title">VIII. DATA KEPANGKATAN / PENGGOLONGAN / PROMOSI / MUTASI / DEMOSI</div>

                <table class="table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Status</th>
                            <th>Jabatan</th>
                            <th width="15%">Golongan</th>
                            <th width="12%">Tahun</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $i => $job)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $job->status ?? '' }}</td>
                                <td>{{ $job->position ?? '' }}</td>
                                <td>{{ $job->grade ?? '' }}</td>
                                <td>{{ $job->start_date ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- FOOTER --}}
                <div class="footer-container" style="margin-top: 20px;">

                    <table width="100%" style="font-size: 11px;">
                        <tr>
                            {{-- KIRI --}}
                            <td style="text-align: left; width: 50%;">
                                <br><br><br>
                                Disetujui Oleh,
                                <br><br><br><br>
                                <u>{{ $kepala_kebun ?? '' }}</u><br>
                                Kepala Kebun
                            </td>

                            {{-- KANAN --}}
                            <td style="text-align: center; width: 50%;">
                                {{ $unit_kerja ?? 'Kebun Tanjung Purba (*)' }}, {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}
                                <br><br>
                                Dibuat Oleh,
                                <br><br><br><br>
                                <u>{{ $employee->full_name }}</u>
                            </td>
                        </tr>
                    </table>

                </div>
                <div style="margin-top: 10px; font-size: 10px;">
                    (*) Coret yang tidak perlu <br>
                    (**) Lampirkan fotocopy KTP / Kartu Keluarga / KTA BPJS Tenaga Kerja / BPJS Kesehatan / NPWP /
                    Ijazah Terakhir / Sertifikat Pelatihan / SK Pengangkatan / Kenaikan Golongan / Mutasi / Demosi
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        window.print()
    </script>

</body>

</html>