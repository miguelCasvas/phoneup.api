<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexConjunto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conjunto', function(Blueprint $table){
            $table->index('id_catalogo','index_Conjunto_Catalogo');
            $table->index('id_ciudad','index_Conjunto_Ciudad');
            $table->index('id_usuario','index_Conjunto_Usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conjunto', function(Blueprint $table){
            $table->dropIndex('index_Conjunto_Catalogo');
            $table->dropIndex('index_Conjunto_Ciudad');
            $table->dropIndex('index_Conjunto_Usuario');
        });
    }
}
