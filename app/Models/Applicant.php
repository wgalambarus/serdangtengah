<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Applicant extends Model
{
    protected $table = 'applicants';

    protected $fillable = [
        'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 
        'pendidikan_terakhir', 'alamat', 'nomor_hp', 'cv', 'pas_foto', 
        'transkrip_nilai', 'ktp', 'ijazah', 'kartu_bpjs', 
        'suket_pengalaman_kerja', 'daftar_riwayat_hidup', 'status'
    ];
}
