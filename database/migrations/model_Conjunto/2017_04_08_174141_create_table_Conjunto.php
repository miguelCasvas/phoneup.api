<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableConjunto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conjuntos', function (Blueprint $table) {
            $table->increments('id_conjunto');
            $table->string('nombre_conjunto', 200);
            $table->string('direccion', 200);
            $table->string('email',200);
            $table->string('telefono',10);
            $table->string('complemento',10)->nullable();
            $table->string('imagen',50)->nullable();
            $table->timestamps();

            # FK
            $table->integer('id_ciudad')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('conjuntos');
    }
}
