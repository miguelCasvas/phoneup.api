<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUbicacionCatalogo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubicacion_catalogos', function (Blueprint $table) {
            $table->increments('id_ubicacion_catalogo');
            $table->string('nombre_ubicacion_catalogo', 200);
            $table->timestamps();

            # Fk
            $table->integer('id_catalogo')->unsigned();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ubicacion_catalogos');
    }
}
