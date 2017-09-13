<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexTipoSalidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipo_salidas', function (Blueprint $table) {
            $table->index('id_notificacion','IXFK_Tipo_salida_Notificaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipo_salidas', function (Blueprint $table) {
            $table->dropIndex('IXFK_Tipo_salida_Notificaciones');
        });
    }
}
