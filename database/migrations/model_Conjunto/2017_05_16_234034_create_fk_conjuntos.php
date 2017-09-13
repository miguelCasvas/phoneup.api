<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFkConjuntos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conjuntos', function (Blueprint $table) {
            $table->foreign('id_ciudad', 'conjuntos_fk_ciudades')->references('id_ciudad')->on('ciudades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conjuntos', function (Blueprint $table) {
            $table->dropForeign('conjuntos_fk_ciudades');
        });
    }
}
