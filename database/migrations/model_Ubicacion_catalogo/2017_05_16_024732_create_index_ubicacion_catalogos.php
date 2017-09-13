<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexUbicacionCatalogos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ubicacion_catalogos', function (Blueprint $table) {
            $table->index('id_catalogo', 'IXFK_Ubicacion_catalogo_Catalogos');
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
            $table->dropIndex('IXFK_Ubicacion_catalogo_Catalogos');
        });
    }
}
