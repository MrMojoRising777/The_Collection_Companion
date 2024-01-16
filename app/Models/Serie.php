<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    public function comics()
    {
        return $this->hasMany(Comic::class);
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }
}
