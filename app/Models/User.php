<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,
        HasFactory,
        Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
    public string $email {
        get => $this->getAttribute('email');
        set {
            $this->setAttribute('email', $value);
        }
    }
    public ?CarbonImmutable $emailVerifiedAt {
        get => $this->getAttribute('email_verified_at');
        set {
            $this->setAttribute('email_verified_at', $value);
        }
    }
    // endregion

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function ownedCopies(): HasMany
    {
        return $this->hasMany(OwnedCopy::class);
    }

    public function trackedSeries(): BelongsToMany
    {
        return $this->belongsToMany(Serie::class, 'serie_user')->withTimestamps();
    }

    public function collectedEdition(Edition $edition): bool
    {
        return $this->ownedCopies()
            ->where('edition_id', $edition->id)
            ->exists();
    }
}
