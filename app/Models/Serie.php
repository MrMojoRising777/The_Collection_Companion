<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @property-read int $total
 * @property-read int $obtained
 */
class Serie extends Model
{
    use HasFactory;

    protected $table = 'series';

    // region attributes
    public int $id {
        get => $this->getAttribute('id');
        set {
            $this->setAttribute('id', $value);
        }
    }
    public string $abbreviation {
        get => $this->getAttribute('abbreviation');
        set {
            $this->setAttribute('abbreviation', $value);
        }
    }
    // endregion

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

    public function ownedCopies(): HasManyThrough
    {
        return $this->hasManyThrough(
            OwnedCopy::class,
            Edition::class,
            'serie_id',
            'edition_id',
            'id',
            'id',
        );
    }
}
