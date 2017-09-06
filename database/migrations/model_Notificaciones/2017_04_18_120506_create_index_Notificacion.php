<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexNotificacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notificacion', function(Blueprint $table){
           $table->index('id_usuario','index_Notificacion_Usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notificacion', function(Blueprint $table){
            $table->dropIndex('index_Notificacion_Usuario');
        });
    }
}
