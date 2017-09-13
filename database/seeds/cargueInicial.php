<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class cargueInicial extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ##################### CARGUE DE ROLES ####################
        # necesarios para definirlos en los modelos:
        # * usuarios
        DB::table('roles')->insert(['nombre_rol' => 'superadmin']);
        DB::table('roles')->insert(['nombre_rol' => 'admin']);
        DB::table('roles')->insert(['nombre_rol' => 'default']);
        DB::table('roles')->insert(['nombre_rol' => 'anonimus']);

    }
}
