<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFkUsuarioExt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuario_extensiones', function (Blueprint $table) {
            $table->foreign('id_extension','usuario_extensiones_fk_extensiones')->references('id_extension')->on('extensiones');
            $table->foreign('id_usuario','usuario_extensiones_fk_usuarios')->references('id_usuario')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuario_extensiones', function (Blueprint $table) {
            $table->dropForeign('usuario_extensiones_fk_extensiones');
            $table->dropForeign('usuario_extensiones_fk_usuarios');
        });
    }
}
