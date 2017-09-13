<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFkWithModelos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permisos_por_rol', function (Blueprint $table) {
            $table->integer('id_modelo')->unsigned()->nullable();
            $table->foreign('id_modelo','permisos_por_rol_fk_modelos')->references('id_modelo')->on('modelos');
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
            $table->dropForeign('permisos_por_rol_fk_modelos');
            $table->dropColumn('id_modelo');
        });
    }
}
