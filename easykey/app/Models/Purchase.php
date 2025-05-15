<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Purchase extends Model
{
    protected $fillable = [
        'user_id',
        'videojuego_id',
        'key_id',
        'purchased_at',
    ];

    // Indica a Laravel que "purchased_at" es un datetime
    protected $casts = [
        'purchased_at' => 'datetime',
    ];

    public function videojuego()
    {
        return $this->belongsTo(Videojuego::class);
    }

    public function key()
    {
        return $this->belongsTo(Key::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}