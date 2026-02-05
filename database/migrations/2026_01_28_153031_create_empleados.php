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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            // Personal
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            // Configuracion
            $table->enum('tipo', ['empleado', 'colaborador', 'administrador']);
            $table->enum('estado', ['activo', 'inactivo']);

            // FK
            $table->foreignId('negocio_id')->constrained('negocios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
