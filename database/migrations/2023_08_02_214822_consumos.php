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
        Schema::create('consumos', function (Blueprint $table) {
            $table ->integer('id')->unique();
            $table ->decimal('consumo_actual');
            $table ->date('fecha_lectura_actual');
            $table ->decimal('consumo_anterior');
            $table ->date('fecha_lectura_anterior');
            $table ->string('responsable');
        });

          //Añadimos el id_consumo a la tabla de "planillas"
            Schema::table('planillas', function(Blueprint $table){
            $table->integer('id_consumo')->nullable()->after('id'); 
            $table->foreign('id_consumo')->references('id')->on('consumos'); //Referenciamos la llave foranea
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
