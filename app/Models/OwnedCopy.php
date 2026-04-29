<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Condition;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OwnedCopy extends Model
{
    use HasFactory;

    protected $table = 'owned_copies';

    protected $fillable = [
        'user_id',
        'edition_id',
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
    public int $editionId {
        get => $this->getAttribute('edition_id');
        set {
            $this->setAttribute('edition_id', $value);
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
    public ?Condition $condition {
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
        'condition' => Condition::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function edition(): BelongsTo
    {
        return $this->belongsTo(Edition::class);
    }
}
