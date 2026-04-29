<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Serie extends Model
{
    use HasFactory;

    protected $table = 'series';

    public function comic(): BelongsTo
    {
        return $this->belongsTo(Comic::class);
    }

    public function editions(): HasMany
    {
        return $this->hasMany(Edition::class);
    }

    public function albums(): BelongsToMany
    {
        return $this->belongsToMany(Album::class, 'editions')
            ->withPivot('volume', 'image', 'cover', 'color')
            ->withTimestamps();
    }
}
