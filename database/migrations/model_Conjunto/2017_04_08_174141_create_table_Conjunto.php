<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableConjunto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conjunto', function (Blueprint $table) {
            $table->increments('id_conjunto');
            $table->string('nombre_conjunto', 200);
            $table->string('direccion', 200);
            $table->string('email',200);
            $table->string('telefono',10);
            $table->string('complemento',10);
            $table->string('imagen',50);
            # FK
            $table->integer('id_ciudad')->unsigned();
            $table->integer('id_catalogo')->unsigned();
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
        Schema::drop('conjunto');
    }
}
