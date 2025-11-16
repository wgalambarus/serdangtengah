<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeEducation extends Model
{
    use HasFactory;
    protected $table = 'employee_educations';
    protected $fillable = ['employee_id','school_name','city','major','year_in','year_out'];
    public function employee(){ return $this->belongsTo(Employee::class); }
}
