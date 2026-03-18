<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'files';
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


    // Polymorphic owner via owner_type/owner_id
    public function owner()
    {
    // Eloquent morphs expect type/value formats; we keep polymorphic simple via manual relations
    return $this->morphTo(__FUNCTION__, 'owner_type', 'owner_id');
    }
}