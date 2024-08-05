<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Families extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function parents()
    {
        return $this->hasMany(Parents::class);
    }

    public function children()
    {
        return $this->hasMany(Children::class);
    }
}
