<?php

use Illuminate\Database\Seeder;

class CargueUsuarios extends Seeder
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
        echo "|          CARGUE EN BASE DE DATOS USUARIOS POR DEFECTO               |\n";
        echo "|                 [SUPERADMIN | ADMIN | ESTANDAR]                     |\n";
        echo "|                                                                     |\n";
        echo "=======================================================================\n";

        $this->cargueUsuarioSuperAdministrador();
        $this->cargueUsuarioAdministrador();
        $this->cargueUsuarioEstandar();
    }

    private function cargueUsuarioSuperAdministrador()
    {
        $datos['nombres'] = 'usuario Super Admin';
        $datos['apellidos'] = 'apellidos usuario Super Admin';
        $datos['email'] = 'superadmin@demo.com';
        $datos['id_rol'] = 1;

        factory(App\Models\Usuario::class, 1)->create($datos);
        echo "CARGUE DE USUARIO SUPER ADMINISTRADOR\n";

    }

    private function cargueUsuarioAdministrador()
    {
        $datos['nombres'] = 'usuario Admin';
        $datos['apellidos'] = 'apellidos usuario Admin';
        $datos['email'] = 'admin@demo.com';
        $datos['id_rol'] = 2;

        factory(App\Models\Usuario::class, 1)->create($datos);
        echo "CARGUE DE USUARIO ADMINISTRADOR\n";

    }

    private function cargueUsuarioEstandar()
    {
        $datos['nombres'] = 'usuario Estandar';
        $datos['apellidos'] = 'apellidos usuario Estandar';
        $datos['email'] = 'estandar@demo.com';
        $datos['id_rol'] = 3;

        factory(App\Models\Usuario::class, 1)->create($datos);
        echo "CARGUE DE USUARIO ESTANDAR\n";

    }
}
