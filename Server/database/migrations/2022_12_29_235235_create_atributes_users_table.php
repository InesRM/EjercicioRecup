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
        Schema::create('atributes_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('atributeID');
            $table->foreign('atributeID')->references('ID')->on('atributes')->onDelete('cascade');
            $table->unsignedBigInteger('userID');
            $table->foreign('userID')->references('ID')->on('users')->onDelete('cascade');
            $table->integer('value');
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
        Schema::dropIfExists('atributes_users');
    }
};
