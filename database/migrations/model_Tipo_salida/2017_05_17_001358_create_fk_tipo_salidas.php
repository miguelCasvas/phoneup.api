<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFkTipoSalidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipo_salidas', function (Blueprint $table) {
            $table->foreign('id_canal', 'tipo_salidas_fk_canal_comunicaciones')->references('id_canal')->on('canal_comunicaciones');
            $table->foreign('id_notificacion', 'tipo_salidas_fk_notificaciones')->references('id_notificacion')->on('notificaciones');
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
            $table->dropForeign('tipo_salidas_fk_canal_comunicaciones');
            $table->dropForeign('tipo_salidas_fk_notificaciones');
        });
    }
}
