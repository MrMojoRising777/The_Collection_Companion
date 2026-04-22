<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Serie extends Model
{
    use HasFactory;

    protected $table = 'series';

    public function comic(): HasOne
    {
        return $this->hasOne(Comic::class);
    }

    public function albums(): BelongsToMany
    {
        return $this->belongsToMany(Album::class)
            ->withPivot('volume');
    }
}
