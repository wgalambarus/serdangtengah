<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeFile extends Model
{
    use HasFactory;

    // Menentukan tabel yang digunakan
    protected $table = 'files';

    // Daftar kolom yang boleh diisi
    protected $fillable = [
        'employee_id',
        'cv',
        'pas_foto',
        'ktp',
        'ijazah',
        'transkrip_nilai',
        'kartu_bpjs',
        'suket_pengalaman_kerja',
        'daftar_riwayat_hidup',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}