<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    protected $fillable = [
        'videojuego_id',
        'key_code',
        'sold',
    ];

    /**
     * Cada key pertenece a un videojuego.
     */
    public function videojuego()
    {
        return $this->belongsTo(Videojuego::class);
    }
}
