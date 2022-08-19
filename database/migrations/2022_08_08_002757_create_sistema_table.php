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
        Schema::create('sistema', function (Blueprint $table) {
            $table->id();
            $table->string('sistema_razao_social');
            $table->string('sistema_nome_fantasia');
            $table->string('sistema_cnpj');
            $table->string('sistema_ie');
            $table->string('sistema_telefone_fixo');
            $table->string('sistema_telefone_movel');
            $table->string('sistema_email');
            $table->string('sistema_site_url');
            $table->string('sistema_cep');
            $table->string('sistema_endereco');
            $table->string('sistema_numero');
            $table->string('sistema_cidade');
            $table->string('sistema_estado');
            $table->string('sistema_produtos_destaques');
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
        Schema::dropIfExists('sistema');
    }
};
