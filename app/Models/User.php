<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function achievements()
    {
        return $this->belongsToMany(Achievement::class)->withPivot('unlocked_at');
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Album::class, 'favorites', 'user_id', 'album_id')->withTimestamps();
    }

    public function trackedSeries()
    {
        return $this->belongsToMany(Serie::class, 'serie_user')->withTimestamps();
    }

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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Check if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin()
    {

        return $this->name === 'admin';
    }
}
