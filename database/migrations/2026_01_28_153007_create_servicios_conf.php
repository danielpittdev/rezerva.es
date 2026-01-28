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
        Schema::create('servicios_conf', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('pregunta');
            $table->boolean('obligatorio')->default(false);
            $table->enum('tipo', ['check', 'text', 'textarea', 'number'])->default('text');
            $table->foreignId('servicio_id')->constrained('servicios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios_conf');
    }
};
