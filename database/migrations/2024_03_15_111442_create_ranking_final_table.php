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
        Schema::create('ranking_final', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('documento')->nullable();
            $table->string('telefono')->nullable();

            $table->string('ciudad_id')->nullable();

            $table->string('fecha_nacimiento')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->integer('puntos')->nullable();

            $table->string('rol_id')->nullable();
            $table->string('estado_id')->nullable();
            
            $table->boolean('terminos')->nullable();
            $table->boolean('politicas')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ranking_final');
    }
};
