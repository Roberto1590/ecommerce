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
        Schema::create('rotas', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('descricao');
            $table->string('rota')->nullable();
            $table->string('controller_index')->nullable();
            $table->string('controller_get')->nullable();
            $table->string('controller_post')->nullable();
            $table->string('controller_put')->nullable();
            $table->string('controller_delete')->nullable();
            $table->string('controller_restore')->nullable();
            $table->integer('menu_pai');
            $table->integer('menu');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rotas');
    }
};
