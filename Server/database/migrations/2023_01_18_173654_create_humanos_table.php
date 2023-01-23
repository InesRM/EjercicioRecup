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
        Schema::create('human_data', function (Blueprint $table) {
            $table->id('ID');
            $table->foreign('ID')->references('ID')->on('users')->onDelete('cascade');
            $table->integer('destino');
            $table->unsignedBigInteger('protection');
            $table->foreign('protection')->references('ID')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('humanos');
    }
};
