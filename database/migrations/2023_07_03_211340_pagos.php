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
            $table->integer('id', true)->unique();
            $table->string('numero_recibo')->unique();
            $table ->decimal('valor_pagado');
            $table ->decimal('valor_restante');
            $table ->date('fecha_pago');
            $table ->string('forma_pago');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
