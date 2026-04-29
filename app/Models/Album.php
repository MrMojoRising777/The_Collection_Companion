<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    use HasFactory;

    protected $table = 'albums';

    protected $fillable = [
        'name',
        'volume',
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

    public function ownedCopies(): HasMany
    {
        return $this->hasMany(OwnedCopy::class, 'edition_id');
    }
}
