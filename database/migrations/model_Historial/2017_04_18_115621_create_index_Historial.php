<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexHistorial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('historial',function(Blueprint $table){
            $table->index('id_usuario','index_Historial_Usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('historial', function(Blueprint $table){
           $table->dropIndex('index_Historial_Usuario');
        });
    }
}
