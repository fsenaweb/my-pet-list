<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->enum('sexo', ['M', 'F']);
            $table->date('nascimento');
            $table->unsignedBigInteger('criador_id');
            $table->foreign('criador_id')->references('id')->on('criadores');
            $table->unsignedBigInteger('especie_id');
            $table->foreign('especie_id')->references('id')->on('especies');
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
        Schema::dropIfExists('pets');
    }
}
