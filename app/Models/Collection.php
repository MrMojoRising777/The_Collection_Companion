<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'album_serie_id',
        'acquisition_date',
        'favorite',
        'first_print',
        'condition',
        'notes',
        'print_year',
    ];

    // region attributes
    public int $id {
        get => $this->getAttribute('id');
        set {
            $this->setAttribute('id', $value);
        }
    }
    public int $userId {
        get => $this->getAttribute('user_id');
        set {
            $this->setAttribute('user_id', $value);
        }
    }
    public int $albumId {
        get => $this->getAttribute('album_id');
        set {
            $this->setAttribute('album_id', $value);
        }
    }
    public int $serieId {
        get => $this->getAttribute('serie_id');
        set {
            $this->setAttribute('serie_id', $value);
        }
    }
    public CarbonImmutable $acquisitionDate {
        get => $this->getAttribute('acquisition_date');
        set {
            $this->setAttribute('acquisition_date', $value);
        }
    }
    public bool $favorite {
        get => $this->getAttribute('favorite');
        set {
            $this->setAttribute('favorite', $value);
        }
    }
    public bool $firstPrint {
        get => $this->getAttribute('first_print');
        set {
            $this->setAttribute('first_print', $value);
        }
    }
    public ?string $condition {
        get => $this->getAttribute('condition');
        set {
            $this->setAttribute('condition', $value);
        }
    }
    public ?string $notes {
        get => $this->getAttribute('notes');
        set {
            $this->setAttribute('notes', $value);
        }
    }
    public ?string $printYear {
        get => $this->getAttribute('print_year');
        set {
            $this->setAttribute('print_year', $value);
        }
    }
    public ?CarbonImmutable $createdAt {
        get => $this->getAttribute('created_at');
        set {
            $this->setAttribute('created_at', $value);
        }
    }
    public ?CarbonImmutable $updatedAt {
        get => $this->getAttribute('updated_at');
        set {
            $this->setAttribute('updated_at', $value);
        }
    }
    // endregion

    /**
     * The attributes that should be cast.
     *
     * @property array<string, string> $casts
     */
    protected $casts = [
        'acquisition_date' => 'datetime',
        'favorite' => 'boolean',
        'first_print' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    public function serie(): BelongsTo
    {
        return $this->belongsTo(Serie::class);
    }

    public function albumSerie(): BelongsTo
    {
        return $this->belongsTo(AlbumSerie::class);
    }
}
