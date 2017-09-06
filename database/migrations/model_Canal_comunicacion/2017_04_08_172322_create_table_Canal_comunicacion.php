<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCanalComunicacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canal_comunicacion', function (Blueprint $table) {
            $table->increments('id_canal');
            $table->string('indicativo',50)->nullable();
            $table->string('canal', 100)->nullable();
            # FK
            $table->integer('id_usuario')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('canal_comunicacion');
    }
}
