<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
    'employee_no','full_name','birth_place','birth_date','gender','last_education','marital_status','religion','blood_type',
    'national_id','npwp','bpjs_tk','bpjs_kes','phone','emergency_name','emergency_relation','emergency_phone','skills'
    ];


    protected $casts = [
    'birth_date' => 'date',
    'skills' => 'array'
    ];


    public function addresses()
    {
    return $this->hasMany(EmployeeAddress::class);
    }


    public function spouse()
    {
    return $this->hasOne(EmployeeSpouse::class);
    }


    public function children()
    {
    return $this->hasMany(EmployeeChild::class);
    }


    public function jobHistory()
    {
    return $this->hasMany(JobHistory::class)->orderBy('start_date','desc');
    }


    public function latestJob()
    {
    return $this->hasOne(JobHistory::class)->latestOfMany('start_date');
    }


    public function positionHistory()
    {
    return $this->hasMany(PositionHistory::class)->orderBy('start_date','desc');
    }


    public function latestPosition()
    {
    return $this->hasOne(PositionHistory::class)->latestOfMany('start_date');
    }


    public function educations()
    {
    return $this->hasMany(EmployeeEducation::class);
    }


    public function trainings()
    {
    return $this->hasMany(EmployeeTraining::class);
    }


    public function ranks()
    {
    return $this->hasMany(EmployeeRank::class);
    }


    public function files()
    {
    return $this->morphMany(File::class, 'owner');
    }
}
