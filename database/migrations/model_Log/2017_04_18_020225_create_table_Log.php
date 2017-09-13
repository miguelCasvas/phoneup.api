<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id_log');

            $table->string('end_point',200);

            // Almacena metodo PUT | POST | DELETE | GET
            $table->string('accion', 10);
            // url que genera la peticion
            $table->string('request', 150);
            $table->string('log',4000);
            $table->timestamp('fecha_hora')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();

            # FK
            $table->integer('id_usuario')->unsigned();
            $table->string('id_cliente', 150);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('logs');
    }
}
