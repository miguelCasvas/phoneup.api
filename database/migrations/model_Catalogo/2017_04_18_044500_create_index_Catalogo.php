<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexCatalogo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catalogo', function(Blueprint $table){
            $table->index('id_conjunto', 'index_catalogo_conjunto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('catalogo', function(Blueprint $table){
            $table->dropIndex('index_catalogo_conjunto');
        });
    }
}
