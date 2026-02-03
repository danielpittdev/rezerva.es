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
        Schema::create('factura', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->decimal('monto', places: 2, total: 9);
            $table->decimal('comision', places: 2, total: 9);
            $table->decimal('total', places: 2, total: 9);
            $table->json('datos');
            $table->foreignId('reserva_id')->constrained('reservas')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factura');
    }
};
