<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFkMarcados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marcados', function (Blueprint $table) {
            $table->foreign('id_tipo_salida','marcados_fk_tipo_salidas')->references('id_tipo_salida')->on('tipo_salidas');
            $table->foreign('id_extension','marcados_fk_extensiones')->references('id_extension')->on('extensiones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marcados', function (Blueprint $table) {
            $table->dropForeign('marcados_fk_tipo_salidas');
            $table->dropForeign('marcados_fk_extensiones');
        });
    }
}
