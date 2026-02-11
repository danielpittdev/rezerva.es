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
        Schema::create('negocios', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('nombre');
            $table->string('slug');
            $table->string('descripcion')->nullable();
            $table->enum('tipo', ['barbería', 'psicología', 'spa', 'clínica', 'gimnasio', 'consultoría', 'otros']);
            // Información postal
            $table->boolean('online')->default(false);
            //
            $table->string('postal_direccion')->nullable();
            $table->string('postal_codigo')->nullable();
            $table->string('postal_ciudad')->nullable();
            $table->string('postal_pais')->nullable();
            // Información contacto
            $table->string('info_email')->nullable();
            $table->string('info_telefono')->nullable();
            // Complementos
            $table->string('icono')->nullable();
            $table->string('banner')->nullable();
            $table->enum('moneda', ['EUR', 'COP', 'USD', 'GBP'])->default('EUR');
            // Stripe
            $table->string('stripe_account_id')->nullable();
            // Otros ajustes
            $table->boolean('verificado')->default(false);
            // FK
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negocios');
    }
};
