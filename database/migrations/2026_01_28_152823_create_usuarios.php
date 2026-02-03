<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email');
            $table->string('password');
            $table->string('avatar')->nullable();
            // Ajustes de interés
            // Otros ajustes
            $table->boolean('verificado')->default(false);
            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
