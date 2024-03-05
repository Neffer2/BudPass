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
        Schema::create('codigos', function (Blueprint $table) {
            $table->id(); 
            $table->string('codigo');
            $table->foreign('referencia_id')->references('id')->on('referencias');
            $table->foreignId('referencia_id');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreignId('estado_id');
            $table->foreign('tipo_id')->references('id')->on('tipos_codigo');
            $table->foreignId('tipo_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codigos');
    }
};
