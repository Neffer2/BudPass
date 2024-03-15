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
        Schema::create('registros_codigo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('codigo_id');
            $table->foreign('codigo_id')->references('id')->on('codigos');
            $table->string('puntos_sumados');
            $table->string('punto_entrega')->nullable();
            $table->foreignId('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros_codigo');
    }
};
