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
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('nombre');
            $table->string('descripcion')->nullable();
            $table->decimal('duracion', total: 2, places: 0)->nullable();
            $table->decimal('precio', total: 8, places: 2);
            $table->boolean('pago_online')->default(false);
            $table->boolean('nota_rapida')->default(false);
            $table->string('stripe_id')->nullable();
            // Complementos
            $table->string('icono')->nullable();
            // Negocio
            $table->foreignId('negocio_id')->constrained('negocios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
