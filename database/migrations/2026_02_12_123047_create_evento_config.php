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
        Schema::create('evento_toppings', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('nombre');
            $table->string('descripcion')->nullable;
            $table->string('icono')->nullable;
            $table->decimal('precio', total: 9, places: 2)->default(0);
            $table->foreignId('evento_id')->constrained('eventos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evento_toppings');
    }
};
