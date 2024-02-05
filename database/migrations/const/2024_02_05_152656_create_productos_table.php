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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->foreign('canal_id')->references('id')->on('users');
            $table->foreignId('canal_id');
            $table->string('sku');
            $table->string('descripcion');
            $table->foreign('referencia_id')->references('id')->on('referencias');
            $table->foreignId('referencia_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
