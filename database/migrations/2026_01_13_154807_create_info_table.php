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
        Schema::create('info', function (Blueprint $table) {
            $table->id();
            /** identificacion*/
            $table->string('dni');

            /** registro civil*/
            $table->string('nacimiento');
            $table->string('matrimonio');
            $table->string('defuncion');

            /** tributo municipales */
            $table->string('impuesto');
            $table->string('arbitrios');

            /** propiedad y vivienta */
            $table->string('titulo_propiedad');
            $table->string('constancia_vivienda');

            /** otros servicios */
            $table->string('multas');
            $table->string('licencias');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info');
    }
};
