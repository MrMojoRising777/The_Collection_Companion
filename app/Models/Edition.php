<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read Serie $serie
 */
class Edition extends Model
{
    use HasFactory;

    protected $table = 'editions';

    protected $fillable = [
        'album_id',
        'serie_id',
        'volume',
        'image',
        'cover',
        'color',
    ];

    // region attributes
    public int $id {
        get => $this->getAttribute('id');
        set {
            $this->setAttribute('id', $value);
        }
    }
    public int $albumId {
        get => $this->getAttribute('album_id');
        set {
            $this->setAttribute('album_id', $value);
        }
    }
    public string $volume {
        get => $this->getAttribute('volume');
        set {
            $this->setAttribute('volume', $value);
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

    public function ownedCopies(): HasMany
    {
        return $this->hasMany(OwnedCopy::class, 'edition_id');
    }
}
