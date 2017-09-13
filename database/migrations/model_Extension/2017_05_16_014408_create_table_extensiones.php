<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableExtensiones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extensiones', function (Blueprint $table) {
            $table->increments('id_extension');
            $table->string('extension', 50);

            # FK
            $table->integer('id_conjunto')->unsigned();
            $table->integer('id_estado')->unsigned();

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
        Schema::dropIfExists('extensiones');
    }
}
