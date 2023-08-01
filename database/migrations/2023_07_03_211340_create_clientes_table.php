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
        Schema::create('clientes', function (Blueprint $table) {
            $table ->integer('id','true','false');
            $table ->string('numero_medidor')->unique();
            $table ->string('nombre');
            $table ->string('apellido');
            $table ->string('cedula');
            $table ->string('direccion');
            $table ->integer('telefono');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
