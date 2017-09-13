<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexConjuntos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conjuntos', function (Blueprint $table) {
            $table->index('id_ciudad', 'IXFK_Conjunto_Ciudad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conjuntos', function (Blueprint $table) {
            $table->dropIndex('IXFK_Conjunto_Ciudad');
        });
    }
}
