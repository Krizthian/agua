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
        Schema::create('pagos', function (Blueprint $table) {
            $table ->integer('id','true','false');
            $table ->string('numero_medidor');
            $table ->string('nombre');
            $table ->string('apellido');
            $table ->decimal('valor_actual');
            $table ->integer('meses_mora');
            $table ->decimal('valor_pagado');
            $table ->decimal('valor_restante');
            $table ->date('fecha');
            $table ->date('fecha_factura');
            $table ->date('fecha_maxima');
            $table ->string('cedula');
            $table ->string('estado_servicio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
