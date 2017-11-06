<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreteColumnVlrExtesion extends Migration
{
    /**
     * Se realiza la creación de la columna valor_extension
     * en la que se define el vlr a ser insertado en la creación de la extensión
     *
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ubicacion_catalogos', function (Blueprint $table) {
            $table->string('valor_extension', 50)->after('nombre_ubicacion_catalogo');
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
            $table->dropColumn('valor_extension');
        });
    }
}
