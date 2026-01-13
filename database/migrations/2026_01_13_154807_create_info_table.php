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
            $table->integer('dni');
            $table->string('foto');

            /** registro civil*/
            $table->date('nacimiento');
            $table->date('matrimonio');
            $table->date('defuncion');

            /** tributo municipales */
            $table->integer('impuesto');
            $table->integer('arbitrios');

            /** propiedad y vivienta */
            $table->string('titulo_propiedad');
            $table->string('constancia_vivienda');

            /** otros servicios */
            $table->integer('multas');
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
