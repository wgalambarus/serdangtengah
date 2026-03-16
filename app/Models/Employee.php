<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_no', 'full_name', 'email', 'birth_place', 'birth_date', 'gender', 
        'last_education', 'marital_status', 'religion', 'blood_type',
        'national_id', 'npwp', 'bpjs_tk', 'bpjs_kes', 'phone', 
        'emergency_name', 'emergency_relation', 'emergency_phone', 'skills'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'skills' => 'array'
    ];

    /**
     * Relasi ke Dokumen/File Karyawan
     * Menggunakan EmployeeFile::class (Bukan File::class)
     */
    public function employeeFile(): HasOne
    {
        return $this->hasOne(EmployeeFile::class, 'employee_id');
    }

    /**
     * Relasi ke Alamat
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(EmployeeAddress::class, 'employee_id');
    }

    /**
     * Generator Nomor Karyawan Otomatis
     */
    public static function generateEmployeeNo()
    {
        $lastEmployee = self::orderBy('id', 'desc')->first();

        $nextNumber = $lastEmployee
            ? ((int) substr($lastEmployee->employee_no, -6)) + 1
            : 1;

        return 'EMP-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }

    /**
     * Relasi Keluarga dan Riwayat
     */
    public function spouse(): HasOne
    {
        return $this->hasOne(EmployeeSpouse::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(EmployeeChild::class);
    }

    public function jobHistory(): HasMany
    {
        return $this->hasMany(JobHistory::class)->orderBy('start_date', 'desc');
    }

    public function latestJob(): HasOne
    {
        return $this->hasOne(JobHistory::class)->latestOfMany('start_date');
    }

    public function positionHistory(): HasMany
    {
        return $this->hasMany(PositionHistory::class)->orderBy('start_date', 'desc');
    }

    public function latestPosition(): HasOne
    {
        return $this->hasOne(PositionHistory::class)->latestOfMany('start_date');
    }

    public function educations(): HasMany
    {
        return $this->hasMany(EmployeeEducation::class);
    }

    public function trainings(): HasMany
    {
        return $this->hasMany(EmployeeTraining::class);
    }

    public function ranks(): HasMany
    {
        return $this->hasMany(EmployeeRank::class);
    }
}