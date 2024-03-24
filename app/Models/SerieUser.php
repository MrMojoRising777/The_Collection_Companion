<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerieUser extends Model
{
    use HasFactory;

    protected $table = 'serie_user';

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }
}
