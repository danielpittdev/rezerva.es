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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            // Stripe
            $table->string('stripe_id');
            $table->string('stripe_monto');
            // Configuracion
            $table->decimal('monto', total: 9, places: 2);
            $table->decimal('comision', total: 9, places: 2);
            $table->decimal('total', total: 9, places: 2);
            // Negocio
            $table->foreignId('negocio')->constrained('negocios')->onDelete('cascade');
            $table->foreignId('servicio')->constrained('servicios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
