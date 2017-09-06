<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexTipoSalida extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipo_salida', function(Blueprint $table){
            $table->index('id_marcado','index_Tipo_salida_Marcado');
            $table->index('id_notificacion','index_Tipo_salida_Notificacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipo_salida', function(Blueprint $table){
            $table->dropIndex('index_Tipo_salida_Marcado');
            $table->dropIndex('index_Tipo_salida_Notificacion');
        });
    }
}
