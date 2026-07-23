<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Collection;

/**
 * @property-read Collection<int, Edition> $editions
 */
class Album extends Model
{
    use HasFactory;

    protected $table = 'albums';

    protected $fillable = [
        'name',
    ];

    // region attributes
    public int $id {
        get => $this->getAttribute('id');
        set {
            $this->setAttribute('id', $value);
        }
    }
    public string $name {
        get => $this->getAttribute('name');
        set {
            $this->setAttribute('name', $value);
        }
    }
    // endregion

    public function series(): BelongsToMany
    {
        return $this->belongsToMany(Serie::class, 'editions')
            ->withPivot('volume', 'image', 'cover', 'color')
            ->withTimestamps();
    }

    public function editions(): HasMany
    {
        return $this->hasMany(Edition::class);
    }

    public function ownedCopies(): HasManyThrough
    {
        return $this->hasManyThrough(
            OwnedCopy::class,
            Edition::class,
            'album_id',
            'edition_id',
            'id',
            'id',
        );
    }
}
