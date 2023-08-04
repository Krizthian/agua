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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->integer('id', true)->unique();
            $table-> string('usuario')->unique();
            $table-> string('password');
            $table-> string('nombre');
            $table-> string('apellido');
            $table-> string('cedula')->unique();
            $table-> string('rol');
            $table-> string('email')->unique();
            $table -> integer('telefono');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
