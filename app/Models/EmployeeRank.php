<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeRank extends Model
{
    use HasFactory;
    protected $table = 'employee_ranks';
    protected $fillable = ['employee_id','status','position','grade','year'];
    
    public function employee(){ 
        return $this->belongsTo(Employee::class); 
    }
}
