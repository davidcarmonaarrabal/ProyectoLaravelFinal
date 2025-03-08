<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'image_url', 'user_id', 'status',
    ];

    // Relación con el usuario (vendedor)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con las transacciones (una carta puede estar en muchas transacciones)
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}