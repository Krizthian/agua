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
        Schema::create('planillas', function (Blueprint $table) {
            $table->integer('id', true)->unique();
            $table ->decimal('valor_actual');
            $table ->date('fecha_factura');
            $table ->date('fecha_maxima');
            $table ->string('estado_servicio');
        });

        //Añadimos el id_planilla a la tabla de "pagos"
            Schema::table('pagos', function(Blueprint $table){
            $table->integer('id_planilla')->nullable()->after('id'); 
            $table->foreign('id_planilla')->references('id')->on('planillas'); //Referenciamos la llave foranea
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planillas');
    }
};
