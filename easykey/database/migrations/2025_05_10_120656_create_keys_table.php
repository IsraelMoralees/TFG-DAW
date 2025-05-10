<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('keys', function (Blueprint $table) {
            $table->id();
            // FK a videojuegos, con borrado en cascada
            $table->foreignId('videojuego_id')
                ->constrained('videojuegos')
                ->cascadeOnDelete();
            // El código de la key
            $table->string('key_code')->unique();
            // Si ya se ha vendido
            $table->boolean('sold')->default(false);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('keys');
    }
};
