<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_asignados', function (Blueprint $table) {
            $table->unsignedBigInteger('idprueba');
            $table->unsignedBigInteger('idusuario');
            $table->primary(['idprueba','idusuario']);
            $table->foreign('idprueba')->references('id')->on('prueba')->onDelete('cascade');
            $table->foreign('idusuario')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios_asignados');
    }
};
