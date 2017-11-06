<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSegmentosExtension extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('extensiones', function (Blueprint $table) {

            $table->unique(['extension', 'id_conjunto']);

            $table->integer('id_ubicacion_catalogo_8')->after('id_conjunto')->nullable()->unsigned();
            $table->integer('id_ubicacion_catalogo_7')->after('id_conjunto')->nullable()->unsigned();
            $table->integer('id_ubicacion_catalogo_6')->after('id_conjunto')->nullable()->unsigned();
            $table->integer('id_ubicacion_catalogo_5')->after('id_conjunto')->nullable()->unsigned();
            $table->integer('id_ubicacion_catalogo_4')->after('id_conjunto')->nullable()->unsigned();
            $table->integer('id_ubicacion_catalogo_3')->after('id_conjunto')->nullable()->unsigned();
            $table->integer('id_ubicacion_catalogo_2')->after('id_conjunto')->nullable()->unsigned();
            $table->integer('id_ubicacion_catalogo_1')->after('id_conjunto')->nullable()->unsigned();


            $table->foreign('id_ubicacion_catalogo_8')->references('id_ubicacion_catalogo')->on('ubicacion_catalogos');
            $table->foreign('id_ubicacion_catalogo_7')->references('id_ubicacion_catalogo')->on('ubicacion_catalogos');
            $table->foreign('id_ubicacion_catalogo_6')->references('id_ubicacion_catalogo')->on('ubicacion_catalogos');
            $table->foreign('id_ubicacion_catalogo_5')->references('id_ubicacion_catalogo')->on('ubicacion_catalogos');
            $table->foreign('id_ubicacion_catalogo_4')->references('id_ubicacion_catalogo')->on('ubicacion_catalogos');
            $table->foreign('id_ubicacion_catalogo_3')->references('id_ubicacion_catalogo')->on('ubicacion_catalogos');
            $table->foreign('id_ubicacion_catalogo_2')->references('id_ubicacion_catalogo')->on('ubicacion_catalogos');
            $table->foreign('id_ubicacion_catalogo_1')->references('id_ubicacion_catalogo')->on('ubicacion_catalogos');

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

            $table->dropUnique(['extension', 'id_conjunto']);

            $table->dropForeign(['id_ubicacion_catalogo_8']);
            $table->dropForeign(['id_ubicacion_catalogo_7']);
            $table->dropForeign(['id_ubicacion_catalogo_6']);
            $table->dropForeign(['id_ubicacion_catalogo_5']);
            $table->dropForeign(['id_ubicacion_catalogo_4']);
            $table->dropForeign(['id_ubicacion_catalogo_3']);
            $table->dropForeign(['id_ubicacion_catalogo_2']);
            $table->dropForeign(['id_ubicacion_catalogo_1']);

            $table->dropColumn([
                'id_ubicacion_catalogo_8',
                'id_ubicacion_catalogo_7',
                'id_ubicacion_catalogo_6',
                'id_ubicacion_catalogo_5',
                'id_ubicacion_catalogo_4',
                'id_ubicacion_catalogo_3',
                'id_ubicacion_catalogo_2',
                'id_ubicacion_catalogo_1',
            ]);
        });
    }
}
