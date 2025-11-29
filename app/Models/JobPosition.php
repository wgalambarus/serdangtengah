<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPosition extends Model
{
    protected $fillable = [
        'title',
        'description',
        'location',
        'salary',
        'start_date',
        'end_date',
        'is_active'
    ];

    public function pelamars()
{
    return $this->belongsToMany(Pelamar::class, 'job_position_pelamar')
                ->withPivot(['created_at', 'updated_at'])
                ->withTimestamps();
}
}
