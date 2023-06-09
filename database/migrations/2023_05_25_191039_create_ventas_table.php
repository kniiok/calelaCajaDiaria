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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idTipoProducto');
            $table->unsignedBigInteger('idFichaDiaria');
            $table->date('fecha');
            $table->string('detalle');
            $table->float('montoEfectivo', 10, 2);
            $table->float('montoTarjeta', 10, 2);
            $table->float('montoTransferencia', 10, 2);
            $table->timestamps();

            $table->foreign('idTipoProducto')->references('id')->on('tipoProductos');
            $table->foreign('idFichaDiaria')->references('id')->on('fichadiarias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta');
    }
};
