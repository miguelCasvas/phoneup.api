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
        Schema::create('tipo_salidas', function (Blueprint $table) {
            $table->increments('id_tipo_salida');
            $table->string('nombre_tipo_salida', 50);
            $table->timestamps();

            # FK
            $table->integer('id_canal')->unsigned();
            $table->integer('id_notificacion')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tipo_salidas');
    }
}
