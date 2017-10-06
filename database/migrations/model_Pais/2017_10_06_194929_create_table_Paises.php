<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePaises extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paises', function (Blueprint $table) {

            $table->increments('id_pais');
            $table->string('nombre_pais', 80);
            $table->string('nombre_oficial_pais', 100);
            $table->string('iso3',80)->nullable();
            $table->string('iso2',80)->nullable();
            $table->string('faostat',80)->nullable();
            $table->string('gaul', 80)->nullable();
            $table->string('codDian', 80)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paises');
    }
}
