<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'comic_id', 'serie_id', 'volume', 'cover', 'color', 'print_year',
        'obtained', 'condition', 'purchase_place', 'purchase_price', 'purchase_date',
        'notes', 'image', 'first_print', 'favorite', 'wanted', 'first_print_obtained',
        'value', 'damaged', 'damage'
    ];

    public function comics()
    {
        return $this->belongsTo(Comic::class, 'comic_id');
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function isInCollection()
    {
        $userId = auth()->id();
        return $this->collections()->where('user_id', $userId)->exists();
    }

    public function collection()
    {
        $userId = auth()->id();
        return $this->collections()->where('user_id', $userId)->first();
    }
}
