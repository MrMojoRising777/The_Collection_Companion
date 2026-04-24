<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AlbumSerie extends Model
{
    use HasFactory;

    protected $table = 'album_serie';

    // region attributes
    public int $id {
        get => $this->getAttribute('id');
        set {
            $this->setAttribute('id', $value);
        }
    }
    // endregion

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    public function serie(): BelongsTo
    {
        return $this->belongsTo(Serie::class);
    }

    public function collections(): HasMany
    {
        return $this->hasMany(Collection::class);
    }
}
