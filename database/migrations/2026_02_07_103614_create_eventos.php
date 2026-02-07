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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('lugar');
            $table->timestamp('fecha');
            $table->bigInteger('stock')->nullable();
            $table->bigInteger('max_compra')->default(5); #
            $table->decimal('precio', places: 2, total: 9)->default(0);
            //
            $table->foreignId('negocio_id')->constrained('negocios')->onDelete('cascade');
            // Stripe
            $table->string('stripe_price')->nullable(); #
            $table->timestamps();
        });

        Schema::create('reservas_eventos', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->boolean('pagado')->default(false);
            $table->boolean('confirmacion')->default(false);
            $table->enum('metodo_pago', ['tarjeta', 'bizum', 'efectivo', 'presencial']);                             # Nota al reservar
            $table->bigInteger('cantidad')->default(1);
            $table->decimal('total', places: 2, total: 9)->default(0);
            //
            $table->foreignId('evento_id')->constrained('eventos')->onDelete('cascade');
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            // Stripe
            $table->json('stripe')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
        Schema::dropIfExists('reservas_eventos');
    }
};
