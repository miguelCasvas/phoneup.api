<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsuarioExt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_extensiones', function (Blueprint $table) {
            $table->increments('id_usuario_extension');

            # Fk
            $table->integer('id_extension')->unsigned();
            $table->integer('id_usuario')->unsigned();

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
        Schema::drop('usuario_extensiones');
    }
}
