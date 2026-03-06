<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PositionHistory extends Model
{
    use HasFactory;
    protected $table = 'position_histories';
    protected $fillable = ['employee_id','status','unit','start_date','end_date'];
    public function employee(){ return $this->belongsTo(Employee::class); }


}
