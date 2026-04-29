<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Comic extends Model
{
    use HasFactory;

    protected $table = 'comics';

    protected $fillable = ['name'];

    public function series(): HasMany
    {
        return $this->hasMany(Serie::class);
    }

    public function albums(): HasManyThrough
    {
        return $this->hasManyThrough(
            Album::class, Edition::class,
            'serie_id', 'id',
            'id', 'album_id',
        );
    }
}
