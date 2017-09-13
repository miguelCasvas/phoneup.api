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
            $table->string('nombres', 200);
            $table->string('apellidos',200);
            $table->string('email', 200)->nullable();
            $table->string('identificacion', 50);
            $table->timestamp('fecha_nacimiento')->nullable();
            $table->timestamps();
            # FK
            $table->integer('id_rol')->unsigned();
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
        Schema::drop('usuarios');
    }
}
