<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeSpouse extends Model
{
    use HasFactory;
    protected $table = 'employee_spouses';
    protected $fillable = ['employee_id','name','birth_date','last_education'];
    public function employee(){ return $this->belongsTo(Employee::class); }
}
