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
        Schema::create('productos_factura', function (Blueprint $table) {
            $table->id();
            $table->foreign('factura_id')->references('id')->on('estados');
            $table->foreignId('factura_id');
            $table->foreign('producto_id')->references('id')->on('estados');
            $table->foreignId('producto_id');
            $table->integer('cantidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos_factura');
    }
};
