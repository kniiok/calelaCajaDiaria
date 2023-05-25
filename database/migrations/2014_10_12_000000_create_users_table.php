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
            $table->unsignedBigInteger('rolUsuario');
            $table->unsignedBigInteger('estadoUsuario');
            $table->string('nombre');
            $table->string('clave');
            $table->boolean('rol');
            $table->boolean('estado');

            $table->foreign('rolUsuario')->references('id')->on('rol');
            $table->foreign('estadoUsuario')->references('id')->on('estado');

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
