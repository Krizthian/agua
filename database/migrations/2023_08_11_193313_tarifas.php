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
     Schema::create('tarifas', function (Blueprint $table) {
            $table->integer('id', true)->unique();
            $table->decimal('tarifa_a')->default(0.308);
            $table->decimal('tarifa_b')->default(0.457);
            $table->decimal('tarifa_c')->default(0.646);
            $table->decimal('tarifa_d')->default(0.810);
            $table->decimal('tarifa_e')->default(0.903);
            $table->decimal('tarifa_f')->default(1.401);
            $table->decimal('tarifa_g')->default(1.798);
            $table->decimal('tarifa_h')->default(2.956);
        });
        DB::table('tarifas')->insert([
            'tarifa_a' => 0.308,
            'tarifa_b' => 0.457,
            'tarifa_c' => 0.646,
            'tarifa_d' => 0.810,
            'tarifa_e' => 0.903,
            'tarifa_f' => 1.401,
            'tarifa_g' => 1.798,
            'tarifa_h' => 2.956,
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
