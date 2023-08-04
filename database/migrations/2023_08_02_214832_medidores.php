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
        Schema::create('medidores', function (Blueprint $table) {
            $table->integer('id', true)->unique();
            $table ->date('fecha_instalacion');
            $table ->string('ubicacion');
            $table ->string('numero_medidor')->unique();
        });

        //Añadimos el id_medidor a la tabla de "planillas"
            Schema::table('planillas', function(Blueprint $table){
            $table->integer('id_medidor')->nullable()->after('id'); 
            $table->foreign('id_medidor')->references('id')->on('medidores'); //Referenciamos la llave foranea
        });

        //Añadimos el id_medidor a la tabla de "planillas"
            Schema::table('consumos', function(Blueprint $table){
            $table->integer('id_medidor')->nullable()->after('id'); 
            $table->foreign('id_medidor')->references('id')->on('medidores'); //Referenciamos la llave foranea
        });

       //Añadimos el id_medidor a la tabla de "mantenimientos"
            Schema::table('mantenimientos', function(Blueprint $table){
            $table->integer('id_medidor')->nullable()->after('id'); 
            $table->foreign('id_medidor')->references('id')->on('medidores'); //Referenciamos la llave foranea
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
