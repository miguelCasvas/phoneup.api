<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            # Creacion de columnas
            $table->integer('contador_contrasenia')->default(0);
            $table->integer('is_estado_contrasenia')->nullable();
            # FK
            $table->integer('id_usuario')->unsigned()->nullable();
            $table->foreign('id_usuario', 'users_fk_usuarios')->references('id_usuario')->on('usuarios');
            # Renombrar columna name
            //$table->renameColumn('name', 'userName');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_fk_usuarios');
            $table->dropColumn(['contador_contrasenia', 'is_estado_contrasenia', 'id_usuario']);
            //$table->renameColumn('name', 'userName');
        });
    }
}
