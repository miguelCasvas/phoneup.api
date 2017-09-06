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
        Schema::create('ubicacion_catalogo', function (Blueprint $table) {
            $table->increments('id_ubicacioncatalogo');
            $table->string('nombre_ubicacioncatalogo', 200);

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
        Schema::drop('ubicacion_catalogo');
    }
}
