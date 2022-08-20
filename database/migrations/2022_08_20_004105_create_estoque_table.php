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
        Schema::create('estoque', function (Blueprint $table) {
            $table->id();
            //
            $table->unsignedBigInteger('produto_especificacao_id');
            $table->foreign('produto_especificacao_id')->references('id')->on('produto_especificacao');
            //
            $table->integer('quantidade');
            $table->integer('maximo')->nullable(true);
            $table->integer('minimo');
            $table->softDeletes();
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
        Schema::dropIfExists('estoque');
    }
};
