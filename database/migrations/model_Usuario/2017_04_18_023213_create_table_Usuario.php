<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id_usuario');
            $table->string('nombre_usuario', 200);
            $table->string('apellidos',200);
            $table->string('email', 200);
            $table->string('identificacion', 50);
            $table->timestamp('fecha_nacimiento');
            # FK
            $table->integer('id_role')->unsigned();
            $table->integer('id_conjunto')->unsigned();
            $table->integer('id_canal')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usuarios');
    }
}
