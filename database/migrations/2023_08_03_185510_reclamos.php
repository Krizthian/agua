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
     Schema::create('reclamos', function (Blueprint $table) {
            $table->integer('id', true)->unique();
            $table ->string('nombre');
            $table ->string('apellido');
            $table ->string('numero_medidor');
            $table ->string('numero_planilla');
            $table ->string('email');
            $table ->string('motivo');
            $table ->string('estado_reclamo');
            $table ->string('observacion')->nullable();
            $table ->date('fecha_reclamo');
            $table ->string('telefono');
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
