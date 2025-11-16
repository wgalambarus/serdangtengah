<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Applicant extends Model
{
    use HasFactory;
    protected $fillable = ['full_name','birth_place','birth_date','gender','address','phone','applied_position'];
    protected $casts = ['birth_date'=>'date'];
    
    public function files(){ 
        return $this->morphMany(File::class, 'owner'); 
    }

}
