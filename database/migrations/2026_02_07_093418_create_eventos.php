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
            $table->bigInteger('stock')->nullable();
            $table->decimal('precio', places: 2, total: 9)->default(0);
            //
            $table->foreignId('negocio_id')->constrained('negocios')->onDelete('cascade');
            //
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
