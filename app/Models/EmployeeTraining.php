<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeTraining extends Model
{
    use HasFactory;
    protected $table = 'employee_trainings';
    protected $fillable = ['employee_id','title','year','location','provider'];
    public function employee(){ return $this->belongsTo(Employee::class); }
}
