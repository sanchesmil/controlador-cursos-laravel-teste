<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaSeries extends Migration
{
    // Add table 'series'
    public function up()
    {
        Schema::create('series', function (Blueprint $table){
            $table->increments('id'); // Cria o campo ID auto-incrementavel
            $table->string('nome');   // O Laravel trata string conforme o banco (varchar, text, etc), 
            //$table->timestamp();    // Habilito qd desejo informar data/hora das modificações
        });
    }

    // Remove table 'series'
    public function down()
    {
        Schema::drop('series');
    }
}
