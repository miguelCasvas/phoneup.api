<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFkHsitoriales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('historiales', function (Blueprint $table) {
            $table->foreign('id_usuario','historiales_fk_usuarios')->references('id_usuario')->on('usuarios');
            $table->foreign('id_usuario_m','historiales_fk_usuarios_m')->references('id_usuario')->on('usuarios');
            $table->foreign('id_modulo','historiales_fk_modulos')->references('id_modulo')->on('modulos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('historiales', function (Blueprint $table) {
            $table->dropForeign('historiales_fk_usuarios');
            $table->dropForeign('historiales_fk_usuarios_m');
            $table->dropForeign('historiales_fk_modulos');
        });
    }
}
