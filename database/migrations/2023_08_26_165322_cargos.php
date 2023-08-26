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
     Schema::create('cargos', function (Blueprint $table) {
            $table->integer('id', true)->unique();
            $table->decimal('alcantarillado')->default(0.15);
            $table->decimal('administracion')->default(0.50);
        });
        DB::table('cargos')->insert([
            'alcantarillado' => 0.15,
            'administracion' => 0.50,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
