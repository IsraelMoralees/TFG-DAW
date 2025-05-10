<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Key;

class Videojuego extends Model
{
    protected $fillable = [
        'titulo',
        'descripcion',
        'plataforma',
        'precio',
        'imagen',
    ];

    /**
     * Relación uno a muchos:
     * Un videojuego puede tener muchas keys.
     */
    public function keys()
    {
        return $this->hasMany(Key::class);
    }
}

