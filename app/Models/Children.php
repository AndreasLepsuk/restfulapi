<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'family_id'];

    public function families()
    {
        return $this->belongsTo(Families::class);
    }
}
