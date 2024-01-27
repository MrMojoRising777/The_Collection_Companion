<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    use HasFactory;

    protected $fillable = ['obtained'];

    public function series()
    {
        return $this->belongsTo(Serie::class);
    }

    public function albums()
    {
        return $this->hasMany(Album::class, 'comic_id');
    }
}
