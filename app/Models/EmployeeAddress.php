<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeAddress extends Model
{
    use HasFactory;
    protected $table = 'employee_addresses';
    protected $fillable = ['employee_id','type','address_line','village','district','city','province','postal_code'];


    public function employee(){ return $this->belongsTo(Employee::class); }
}
