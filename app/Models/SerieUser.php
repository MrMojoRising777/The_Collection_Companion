<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SerieUser extends Model
{
    use HasFactory;

    protected $table = 'serie_user';

    public function serie(): BelongsTo
    {
        return $this->belongsTo(Serie::class);
    }
}
