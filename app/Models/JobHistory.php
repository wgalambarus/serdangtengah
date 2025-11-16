<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobHistory extends Model
{
    use HasFactory;
    protected $table = 'job_histories';
    protected $fillable = ['employee_id','status','start_date','end_date','unit','note'];
    public function employee(){ return $this->belongsTo(Employee::class); }
}
