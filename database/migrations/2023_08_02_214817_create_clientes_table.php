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
            $table->integer('id', true)->unique();
            $table ->string('nombre');
            $table ->string('apellido');
            $table ->string('cedula')->unique();
            $table ->string('direccion');
            $table-> string('email')->unique();
            $table ->integer('telefono');
            $table ->string('resp_creacion');
            $table ->date('fecha_creacion');
        });

       //Añadimos el id_cliente a la tabla de "planillas"
            Schema::table('planillas', function(Blueprint $table){
            $table->integer('id_cliente')->nullable()->after('id'); 
            $table->foreign('id_cliente')->references('id')->on('clientes'); //Referenciamos la llave foranea
        });

       //Añadimos el id_cliente a la tabla de "pagos"
            Schema::table('pagos', function(Blueprint $table){
            $table->integer('id_cliente')->nullable()->after('id'); 
            $table->foreign('id_cliente')->references('id')->on('clientes'); //Referenciamos la llave foranea
        });

        //Añadimos el id_cliente a la tabla de "medidores"
            Schema::table('medidores', function(Blueprint $table){
            $table->integer('id_cliente')->nullable()->after('id'); 
            $table->foreign('id_cliente')->references('id')->on('clientes'); //Referenciamos la llave foranea
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
