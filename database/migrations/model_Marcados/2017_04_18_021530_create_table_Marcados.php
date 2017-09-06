<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMarcados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marcados', function (Blueprint $table) {
            $table->increments('id_marcado');
            $table->integer('secuencia_marcado');
            # FK
            $table->integer('id_canal')->unsigned();
            $table->integer('id_tipo_salida')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('marcados');
    }
}
