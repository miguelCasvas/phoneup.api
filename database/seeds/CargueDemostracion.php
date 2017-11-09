<?php

use Illuminate\Database\Seeder;

class CargueDemostracion extends Seeder
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
        echo "|                     CARGUE EN BASE DE DATOS                         |\n";
        echo "|                 [[[ datos para demostracion  ]]]                    |\n";
        echo "=======================================================================\n";

        $this->cargueConjuntos_ft_exten_catalogo_canalesComunicacion();
    }

    /**
     * Cargue de datos demo para pruebas de:
     * * 20 CONJUNTOS
     * * 200 EXTENSIONES POR CONJUNTO CREADO
     * * 4 ITEMS DE CATALOGO POR CONJUNTO CREADO
     * * 4 ITEMS DE CANALES DE COMUNICACION POR CONJUNTO CREADO
     */
    private function cargueConjuntos_ft_exten_catalogo_canalesComunicacion()
    {
        $extension = 1100;

        # CREACION DE 20 CONJUNTOS
        factory(App\Models\Conjunto::class, 1)->create()->each(function($u) use(&$extension){

            $datos['extension'] = $extension;
            $datos['id_conjunto'] = $u->id_conjunto;

            # CREACION DE EXTENSIONES DESDE 1100 - 1200 POR CADA CONJUNTO
            factory(App\Models\Extension::class, 200)->create($datos)->each(function ($u2) use(&$extension){
                $u2->extension = $extension;
                $u2->save();
                $extension++;
            });

            $extension = 1100;

            # CREACION DE 4 TIPOS DE CATALOGOS POR CADA CONJUNTO [APARTAMENTO 1| INTERIOR | MANZANA | BLOQUE]
            $datos = array('id_conjunto' => $u->id_conjunto);
            factory(App\Models\Catalogo::class, 1)->states('Apto')->create($datos);
            factory(App\Models\Catalogo::class, 1)->states('Int')->create($datos);
            factory(App\Models\Catalogo::class, 1)->states('Mz')->create($datos);
            factory(App\Models\Catalogo::class, 1)->states('Blq')->create($datos);

            # CREACION DE 4 CANALES DE COMUNICACION POR CONJUNTO [FIJO | MOVIL | WHATSAPP | CORREO]
            factory(App\Models\CanalComunicacion::class, 1)->states('fij')->create($datos);
            factory(App\Models\CanalComunicacion::class, 1)->states('mov')->create($datos);
            factory(App\Models\CanalComunicacion::class, 1)->states('what')->create($datos);
            factory(App\Models\CanalComunicacion::class, 1)->states('correo')->create($datos);

        });

        echo "CARGUE DE CONJUNTOS FINALIZADA\n";
        echo "CARGUE DE EXTENSIONES FINALIZADA\n";
        echo "CARGUE DE CATALOGOS FINALIZADA\n";
        echo "CARGUE DE CANALES DE COMUNICACION FINALIZADA\n";

    }
}
