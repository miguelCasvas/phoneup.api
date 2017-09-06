<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLogin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login', function (Blueprint $table) {
            $table->increments('id_login');
            $table->string('usuario',200);
            $table->string('contrasenia', 200);
            $table->integer('contador_contrasenia')->unsigned();
            $table->integer('is_estado_contrasenia')->unsigned();
            # FK
            $table->integer('id_usuario')->unsigned();
            $table->integer('id_estado_usuario')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('login');
    }
}
