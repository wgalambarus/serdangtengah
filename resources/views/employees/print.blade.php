<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>

@page{
    size:A4;
    margin:15mm;
}

body{
    font-family: Arial, Helvetica, sans-serif;
    font-size:12px;
    color:#000;
}

.page{
    width:100%;
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    margin-bottom:15px;
}

.company{
    font-weight:bold;
    font-size:14px;
}

.title{
    font-size:16px;
    font-weight:bold;
    margin-top:2px;
}

.header-right{
    font-size:11px;
    text-align:right;
}

.section{
    border:1px solid #000;
    padding:12px;
}

.section-title{
    font-weight:bold;
    margin:15px 0 8px 0;
}

.table{
    width:100%;
    border-collapse:collapse;
}

.table td{
    padding:3px 2px;
    vertical-align:top;
}

.no{
    width:25px;
}

.label{
    width:230px;
}

.dot{
    width:10px;
}

.value{
    border-bottom:1px solid #000;
    padding-left:5px;
}

.sub-value{
    padding-left:5px;
}

.small{
    font-size:11px;
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
Unit Kerja : ___________________<br>
N.I.K : ___________________
</div>

</div>

<div class="section">

<div class="section-title">I. DATA PRIBADI</div>

<table class="table">

<tr>
<td class="no">1</td>
<td class="label">Nama</td>
<td class="dot">:</td>
<td class="value">{{ $employee->full_name }}</td>
</tr>

<tr>
<td>2</td>
<td>Tempat / Tanggal Lahir</td>
<td>:</td>
<td class="value">{{ $employee->birth_place }}, {{ $employee->birth_date }}</td>
</tr>

<tr>
<td>3</td>
<td>Jenis Kelamin</td>
<td>:</td>
<td class="value">{{ $employee->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
</tr>

<tr>
<td>4</td>
<td>Pendidikan Terakhir</td>
<td>:</td>
<td class="value">{{ $employee->last_education }}</td>
</tr>

<tr>
<td>5</td>
<td>Status Perkawinan</td>
<td>:</td>
<td class="value">{{ $employee->marital_status }}</td>
</tr>

<tr>
<td>6</td>
<td>Agama</td>
<td>:</td>
<td class="value">{{ $employee->religion }}</td>
</tr>

<tr>
<td>7</td>
<td>Golongan Darah</td>
<td>:</td>
<td class="value">{{ $employee->blood_type }}</td>
</tr>

<tr>
<td>8</td>
<td>No. KTP</td>
<td>:</td>
<td class="value">{{ $employee->national_id }}</td>
</tr>

<tr>
<td>9</td>
<td>Alamat Sesuai KTP</td>
<td>:</td>
<td class="value">{{ $ktp->address_line ?? '' }}</td>
</tr>

<tr>
<td>10</td>
<td>Desa / Kelurahan Kecamatan</td>
<td>:</td>
<td class="value">{{ $ktp->village ?? '' }} / {{ $ktp->district ?? '' }}</td>
</tr>


<tr>
<td>11</td>
<td>Kabupaten / Kota</td>
<td>:</td>
<td class="value">{{ $ktp->city ?? '' }}</td>
</tr>

<tr>
<td>12</td>
<td>Alamat Tempat Tinggal Saat Ini</td>
<td>:</td>
<td class="value">{{ $dom->address_line ?? '' }}</td>
</tr>

<tr>
<td>13</td>
<td>Desa / Kelurahan Kecamatan</td>
<td>:</td>
<td class="value">{{ $dom->village ?? '' }} / {{ $dom->district ?? '' }}</td>
</tr>


<tr>
<td>14</td>
<td>Kabupaten / Kota</td>
<td>:</td>
<td class="value">{{ $dom->city ?? '' }}</td>
</tr>

<tr>
<td>16</td>
<td>No. NPWP</td>
<td>:</td>
<td class="value">{{ $employee->npwp }}</td>
</tr>

<tr>
<td>17</td>
<td>No. KTA BPJS Tenaga Kerja</td>
<td>:</td>
<td class="value">{{ $employee->bpjs_tk }}</td>
</tr>

<tr>
<td>18</td>
<td>No. KTA BPJS Kesehatan</td>
<td>:</td>
<td class="value">{{ $employee->bpjs_kes }}</td>
</tr>

<tr>
<td>19</td>
<td>No. HP</td>
<td>:</td>
<td class="value">{{ $employee->phone }}</td>
</tr>

<tr>
<td>20</td>
<td>Nama Keluarga yg bisa dihubungi</td>
<td>:</td>
<td class="value">{{ $employee->emergency_name }}</td>
</tr>

<tr>
<td>21</td>
<td>Hubungan</td>
<td>:</td>
<td class="value">{{ $employee->emergency_name }}</td>
</tr>

<tr>
<td>22</td>
<td>No. HP</td>
<td>:</td>
<td class="value">{{ $employee->emergency_phone }}</td>
</tr>
</table>


<div class="section-title">II. DATA ISTRI / SUAMI</div>

@if($spouse)

<table class="table">

<tr>
<td class="no">1</td>
<td class="label">Nama</td>
<td class="dot">:</td>
<td class="value">{{ $spouse->name }}</td>
</tr>

<tr>
<td>2</td>
<td>Tanggal Lahir</td>
<td>:</td>
<td class="value">{{ $spouse->birth_date }}</td>
</tr>

</table>

@endif


<div class="section-title">III. DATA ANAK / TANGGUNGAN</div>

<table class="table">

@foreach($children as $i => $child)

<tr>
<td class="no">{{ $i+1 }}</td>
<td class="label">Nama Anak / Tangunggan (*)</td>
<td class="dot">:</td>
<td class="value">{{ $child->name }}</td>
</tr>

<tr>
<td></td>
<td>Tanggal Lahir</td>
<td>:</td>
<td class="value">{{ $child->birth_date }}</td>
</tr>

<tr>
<td></td>
<td>Jenis Kelamin</td>
<td>:</td>
<td class="value">{{ $child->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
</tr>

<tr>
<td></td>
<td>Pendidikan Terakhir</td>
<td>:</td>
<td class="value">{{ $child->last_education }}</td>
</tr>

@endforeach

</table>


<div class="section-title">IV. RIWAYAT PEKERJAAN</div>

<table class="table">

@foreach($jobs as $i => $job)

<tr>
<td class="no">{{ $i+1 }}</td>
<td class="label">Status</td>
<td class="dot">:</td>
<td class="value">{{ $job->status }}</td>
</tr>

<tr>
<td></td>
<td>Unit</td>
<td>:</td>
<td class="value">{{ $job->unit }}</td>
</tr>

@endforeach

</table>


<div class="section-title">V. RIWAYAT JABATAN</div>

<table class="table">

@foreach($jobs as $i => $job)

<tr>
<td class="no">{{ $i+1 }}</td>
<td class="label">Nama Jabatan</td>
<td class="dot">:</td>
<td class="value">{{ $job->status }}</td>
</tr>

<tr>
<td></td>
<td>Tanggal Mulai</td>
<td>:</td>
<td class="value">{{ $job->start_date }}</td>
</tr>

@endforeach

</table>

</div>

</div>

<script>
window.print()
</script>

</body>
</html>