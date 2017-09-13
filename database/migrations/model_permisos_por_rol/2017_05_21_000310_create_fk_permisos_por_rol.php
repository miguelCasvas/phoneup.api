<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFkPermisosPorRol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permisos_por_rol', function (Blueprint $table) {
            $table->foreign('id_rol','permisos_por_rol_fk_roles')->references('id_rol')->on('roles');
            $table->foreign('id_permiso','permisos_por_rol_fk_permisos')->references('id_permiso')->on('permisos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permisos_por_rol', function (Blueprint $table) {
            $table->dropForeign('permisos_por_rol_fk_roles');
            $table->dropForeign('permisos_por_rol_fk_permisos');
        });
    }
}
