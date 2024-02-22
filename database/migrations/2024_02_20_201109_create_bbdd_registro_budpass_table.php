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
        Schema::create('bbdd_registro_budpass', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('correo');
            $table->string('fecha_nacimiento');
            $table->string('ciudad');
            $table->string('numero_factura');
            $table->string('numero_nit');
            $table->string('codigos_redimidos');
            $table->string('puntaje_acumulado');
            $table->string('premios_redimidos');
            $table->string('pusto_ranking');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bbdd_registro_budpass');
    }
};
