<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHistorial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial', function (Blueprint $table) {
            $table->increments('id_historial');
            $table->string('accion', 400);
            $table->timestamp('fecha_hora')->default(DB::raw('CURRENT_TIMESTAMP'));

            # FK
            $table->integer('id_usuario')->unsigned();
            $table->integer('id_usuario_m')->unsigned();
            $table->integer('id_modulo')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('historial');
    }
}
