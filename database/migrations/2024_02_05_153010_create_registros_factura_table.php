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
        Schema::create('registros_factura', function (Blueprint $table) {
            $table->id();
            $table->string('nom_factura');
            $table->string('foto_selfie');
            $table->string('foto_factura');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('user_id');
            $table->string('puntos_sumados');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreignId('estado_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros_factura');
    }
};
