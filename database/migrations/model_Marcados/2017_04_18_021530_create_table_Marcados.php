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
            $table->timestamps();

            # FK
            $table->integer('id_extension')->unsigned();
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
