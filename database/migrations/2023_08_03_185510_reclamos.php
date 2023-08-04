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
            $table ->integer('id')->unique();
            $table ->string('motivo');
            $table ->string('email');
            $table ->string('estado_reclamo');
            $table ->date('fecha_reclamo');
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
