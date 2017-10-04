<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkIdConjuntoCanalComunicaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('canal_comunicaciones', function (Blueprint $table) {
            $table->foreign('id_conjunto', 'canal_comunicaciones_fk_conjuntos')->references('id_conjunto')->on('conjuntos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('canal_comunicaciones', function (Blueprint $table) {
            $table->dropForeign('canal_comunicaciones_fk_conjuntos');
        });
    }
}
