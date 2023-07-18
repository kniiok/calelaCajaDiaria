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
        Schema::create('fichadiarias', function (Blueprint $table) {
            $table->id();
            $table->float('inicioCaja', 10, 2);
            $table->float('totalVentas', 10, 2);
            $table->float('totalTela', 10, 2)->default(0);
            $table->float('totalArreglo', 10, 2)->default(0);
            $table->float('aPozo', 10, 2);
            $table->float('cajaChica', 10, 2);
            $table->text('descripcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fichadiaria');
    }
};
