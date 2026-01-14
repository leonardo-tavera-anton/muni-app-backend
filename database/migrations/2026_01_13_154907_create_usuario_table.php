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
        /* importante definir mismo que el modelo */
        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->string('dni')->unique();
            $table->string('nombre'); // si existe mismo nombre
            $table->string('correo')->unique();
 
            /** informacion conectada */
            $table->unsignedBigInteger('id_info'); // clave foranea
            $table->foreign('id_info')->references('id')->on('info')->onDelete('cascade'); /* relacion con info */ 
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
