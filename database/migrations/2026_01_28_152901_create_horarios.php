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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->enum('dia', ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']);
            $table->time('franja_inicio');
            $table->time('franja_final');
            $table->foreignId('negocio_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('horarios_excepciones', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->date('fecha');
            $table->time('franja_inicio')->nullable();
            $table->time('franja_final')->nullable();
            $table->boolean('cerrado')->default(false);
            $table->foreignId('negocio_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
        Schema::dropIfExists('horarios_excepciones');
    }
};
