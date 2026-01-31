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
            //
            $table->foreignId('negocio_id')->constrained('negocios')->nullOnDelete();
            $table->json('negocio_data');
            $table->json('servicio_data');
            $table->json('stripe');
            //
            $table->decimal('entrante', total: 9, places: 2);
            $table->decimal('comision', total: 9, places: 2);
            $table->decimal('total', total: 9, places: 2);
            //
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
