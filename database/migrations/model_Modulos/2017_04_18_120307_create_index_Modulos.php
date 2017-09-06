<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexModulos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('modulos', function(Blueprint $table){
            $table->index('id_estado','index_Modulos_Estados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('modulos', function(Blueprint $table){
            $table->dropIndex('index_Modulos_Estados');
        });
    }
}
