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
        'name', 'volume', 'cover', 'color', 'print_year',
        'obtained', 'condition', 'purchase_place', 'purchase_price', 'purchase_date',
        'notes', 'image', 'first_print', 'favorite', 'wanted', 'first_print_obtained',
        'value', 'damaged', 'damage'
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

    public function comics()
    {
        return $this->belongsTo(Comic::class, 'comic_id');
    }

    public function collections(): HasMany
    {
        return $this->hasMany(Collection::class);
    }

    public function isInCollection()
    {
        return $this->collections()->where('user_id', auth()->id())->exists();
    }

    public function collection()
    {
        return $this->collections()
            ->where('user_id', auth()->id())
            ->first();
    }

    public function series(): belongsToMany
    {
        return $this->belongsToMany(Serie::class)
            ->withPivot('volume');
    }

    public function albumSeries(): HasMany
    {
        return $this->hasMany(AlbumSerie::class);
    }
}
