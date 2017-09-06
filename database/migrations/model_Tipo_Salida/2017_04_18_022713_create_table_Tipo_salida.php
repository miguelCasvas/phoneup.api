<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTipoSalida extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_salida', function (Blueprint $table) {
            $table->increments('id_tipo_salida');
            $table->string('nombre_tipo_salida', 50);

            # FK
            $table->integer('id_marcado')->unsigned();
            $table->integer('id_notificacion')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tipo_salida');
    }
}
