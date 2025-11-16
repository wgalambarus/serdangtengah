<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PositionHistory extends Model
{
    use HasFactory;
    protected $table = 'position_histories';
    protected $fillable = ['employee_id','position_name','unit','start_date','end_date'];
    public function employee(){ return $this->belongsTo(Employee::class); }
}
