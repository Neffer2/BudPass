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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('documento')->unique();
            $table->string('telefono')->unique();

            $table->foreign('ciudad_id')->references('id')->on('ciudades');
            $table->foreignId('ciudad_id');

            $table->string('fecha_nacimiento');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('puntos')->default(0);

            $table->foreignId('rol_id')->default(1);
            $table->foreign('rol_id')->references('id')->on('roles');
            $table->foreignId('estado_id')->default(1);
            $table->foreign('estado_id')->references('id')->on('estados');
            
            $table->boolean('terminos');
            $table->boolean('politicas');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
