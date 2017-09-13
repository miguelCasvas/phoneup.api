<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFkExtensiones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('extensiones', function (Blueprint $table) {
            $table->foreign('id_estado','extensiones_fk_estados')->references('id_estado')->on('estados');
            $table->foreign('id_conjunto','extensiones_fk_conjuntos')->references('id_conjunto')->on('conjuntos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('extensiones', function (Blueprint $table) {
            $table->dropForeign('extensiones_fk_estados');
            $table->dropForeign('extensiones_fk_conjuntos');
        });
    }
}
