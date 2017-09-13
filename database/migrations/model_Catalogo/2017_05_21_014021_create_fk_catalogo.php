<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFkCatalogo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catalogos', function (Blueprint $table) {
            $table->foreign('id_conjunto', 'catalogos_fk_conjuntos')->references('id_conjunto')->on('conjuntos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('catalogos', function (Blueprint $table) {
            $table->dropForeign('catalogos_fk_conjuntos');
        });
    }
}
