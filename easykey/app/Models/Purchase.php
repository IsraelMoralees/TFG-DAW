<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'user_id',
        'videojuego_id',
        'key_id',
        'purchased_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function videojuego()
    {
        return $this->belongsTo(Videojuego::class);
    }

    public function key()
    {
        return $this->belongsTo(Key::class);
    }
}
