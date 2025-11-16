<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeChild extends Model
{
    use HasFactory;
    protected $table = 'employee_childrens';
    protected $fillable = ['employee_id','name','birth_date','gender','last_education'];
    public function employee(){ return $this->belongsTo(Employee::class); }
}
