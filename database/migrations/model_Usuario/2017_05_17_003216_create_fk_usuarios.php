<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFkUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->foreign('id_rol','usuarios_fk_roles')->references('id_rol')->on('roles');
            $table->foreign('id_conjunto', 'usuarios_fk_conjuntos')->references('id_conjunto')->on('conjuntos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropForeign('usuarios_fk_roles');
            $table->dropForeign('usuarios_fk_conjuntos');
        });
    }
}
