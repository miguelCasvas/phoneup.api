<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearColumnas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipo_salidas', function (Blueprint $table) {
            $table->string('metodo_params', 150)->after('nombre_tipo_salida')->nullable();
            $table->string('metodo', 150)->after('nombre_tipo_salida')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipo_salidas', function (Blueprint $table) {
            $table->dropColumn('metodo');
            $table->dropColumn('metodo_params');
        });
    }
}
