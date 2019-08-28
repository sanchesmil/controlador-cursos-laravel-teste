<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemporadasTable extends Migration
{

    public function up()
    {
        Schema::create('temporadas', function (Blueprint $table) {
            $table->bigIncrements('id');  // Chave primária desta tabela
            $table->integer('numero');
            $table->integer('serie_id');  // Chave estrangeira para a tabela series
            $table->foreign('serie_id')->references('id')->on('series');  //Faz referencia à chave 'id' da tabela series
        });
    }

    public function down()
    {
        Schema::dropIfExists('temporadas');
    }
}
