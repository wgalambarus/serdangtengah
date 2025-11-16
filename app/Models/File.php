<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class File extends Model
{
    use HasFactory;
    protected $table = 'files';
    protected $fillable = ['owner_type','owner_id','file_type','path','filename','size'];


    // Polymorphic owner via owner_type/owner_id
    public function owner()
    {
    // Eloquent morphs expect type/value formats; we keep polymorphic simple via manual relations
    return $this->morphTo(__FUNCTION__, 'owner_type', 'owner_id');
    }
}
