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
        Schema::create('resplibre', function (Blueprint $table) {
            $table->id('idprueba');
            $table->foreign('idprueba')->references('id')->on('prueba')->onDelete('cascade');
            $table->string('palabrasclaves');
            $table->integer('porcentaje');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resplibre');
    }
};
