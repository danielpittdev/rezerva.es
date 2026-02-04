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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            //
            $table->foreignId('servicio_id')->constrained('servicios')->onDelete('cascade');
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('empleado_id')->nullable()->constrained('empleados')->onDelete('cascade');
            $table->foreignId('negocio_id')->nullable()->constrained('negocios')->onDelete('cascade');
            //
            $table->timestamp('fecha');
            $table->enum('estado', ['pendiente', 'confirmado', 'cancelado', 'completado', 'pago_pendiente'])->default('pendiente');
            // Stripe
            $table->foreignId('stripe_event')->nullable();
            //
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
