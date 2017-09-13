<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFkUbicacionCatalogos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ubicacion_catalogos', function (Blueprint $table) {
            $table->foreign('id_catalogo','ubicacion_catalogos_fk_catalogos')->references('id_catalogo')->on('catalogos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ubicacion_catalogos', function (Blueprint $table) {
            $table->dropForeign('ubicacion_catalogos_fk_catalogos');
        });
    }
}
