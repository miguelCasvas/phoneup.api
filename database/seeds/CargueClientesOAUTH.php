<?php

use Illuminate\Database\Seeder;
use Symfony\Component\Console\Output\BufferedOutput;

class CargueClientesOAUTH extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "\n\n\n";
        echo "=======================================================================\n";
        echo "|                                                                     |\n";
        echo "|                  CARGUE EN BASE DE DATOS CLIENTES API               |\n";
        echo "|                                                                     |\n";
        echo "=======================================================================\n";

        $output = new BufferedOutput;
        Artisan::call('passport:install', [], $output);

        echo "ID'S DE CLIENTES PARA CONEXION API: \n";
        echo "===> " . $output->fetch() . "\n";
    }
}
