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
        Schema::create('canal_comunicaciones', function (Blueprint $table) {
            $table->increments('id_canal');
            $table->string('indicativo',50);
            $table->string('canal', 100);

            $table->timestamps();
            $table->integer('id_conjunto')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('canal_comunicaciones');
    }
}
