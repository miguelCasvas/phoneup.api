<?php

use Illuminate\Database\Seeder;

class CargueBasico extends Seeder
{

    const PERMISOS = [
        1 => 'Creacion',
        2 => 'Lectura',
        3 => 'Modificacion',
        4 => 'Eliminacion',
        5 => 'Mi Lectura',
        6 => 'Mi Modificacion'
    ];

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
        echo "|             CARGUE EN BASE DE DATOS POR DEFECTO                     |\n";
        echo "|                                                                     |\n";
        echo "=======================================================================\n";

        $this->call(CargueGeograficos::class);

        $this->cargueEstados();
        $this->carguePermisos();
        $this->cargueModelos();
        $this->cargueRoles();
        $this->carguePermisosPorRol();
    }

    /**
     * Cargue de estados en modelo ESTADOS
     */
    private function cargueEstados()
    {
        $estados = ['Activo', 'Inactivo'];

        foreach ($estados as $estado)
            factory(App\Models\Estado::class, 1)->create(['nombre_estado' => $estado]);

        echo "CARGUE DE ESTADOS FINALIZADA\n";
    }

    /**
     * Cargue de permisos en el modelo PERMISOS
     *
     */
    private function carguePermisos()
    {
        #Permisos Por Defecto
        $permisos = self::PERMISOS;

        foreach ($permisos as $permiso)
            factory(App\Models\Permiso::class, 1)->create(['nombre_permiso' => $permiso]);

        echo "CARGUE DE PERMISOS FINALIZADA\n";
    }

    /**
     * Cargue de modelos existentes en BD
     */
    private function cargueModelos()
    {
        $modelos = self::modelosSuperAdministrador();

        foreach ($modelos as $modelo)
            factory(App\Models\Modelo::class, 1)->create(['nombre_modelo' => $modelo]);

        echo "CARGUE DE MODELOS FINALIZADA\n";
    }

    /**
     * Cargue de roles en modelo ROLES
     */
    private function cargueRoles()
    {
        $roles = self::Roles();

        foreach ($roles as $rol)
            factory(App\Models\Rol::class, 1)->create(['nombre_rol' => $rol]);

        echo "CARGUE DE ROLES FINALIZADA\n";
    }

    private function carguePermisosPorRol()
    {

        $modelos_superAdmin = self::modelosSuperAdministrador();
        $modelos_admin = self::modelosAdministrador();
        $modelos_estandar =  self::modelosUsuarioEstandar();

        foreach (self::PERMISOS as $idPermiso => $PERMISO) {

            foreach ($modelos_superAdmin as $idModelo => $Modelo) {

                if ($idPermiso <=  4) {

                    # Insercion para super Administrador
                    $datos['id_rol'] = 1;
                    $datos['id_permiso'] = $idPermiso;
                    $datos['id_modelo'] = $idModelo;
                    factory(App\Models\PermisosRol::class, 1)->create($datos);

                    # Valida si el id del modelo pertenece al de un admin
                    if (array_key_exists($idModelo, $modelos_admin)){
                        $datos['id_rol']     = 2;
                        $datos['id_permiso'] = $idPermiso;
                        $datos['id_modelo']  = $idModelo;
                        factory(App\Models\PermisosRol::class, 1)->create($datos);
                    }


                }// cierre if $permiso <= 4
                elseif(array_key_exists($idModelo, $modelos_estandar)){

                    foreach (self::Roles() as $idRol => $rol) {

                        if (($idPermiso == 6 && $idModelo == 16) || ($idPermiso == 5)){
                            $datos['id_rol']     = $idRol;
                            $datos['id_permiso'] = $idPermiso;
                            $datos['id_modelo']  = $idModelo;
                            factory(App\Models\PermisosRol::class, 1)->create($datos);
                        }
                        else{
                            break;
                        }

                    }

                }//cierre elseif

            }//cierre 2do foreach

        }//cierre 1er foreach

        echo "CARGUE DE PERMISOS POR ROL FINALIZADA\n";
    }

    /**
     * ROLES ESTANDAR DEL SISTEMA
     *
     * @return array
     */
    public static function Roles()
    {
        return [
            1 => 'SuperAdministrador',
            2 => 'Administrador',
            3 => 'Usuario',
        ];

    }

    /**
     * MODELOS PERMITIDOS PARA UN USUARIO TIPO SUPER ADMINISTRADOR
     * @return array
     */
    public static function modelosSuperAdministrador()
    {
        return
            [
                1 => 'canal_comunicaciones',
                2 => 'catalogos',
                3 => 'ciudades',
                4 => 'conjuntos',
                5 => 'estados',
                6 => 'modelos',
                7 => 'modulos',
                8 => 'permisos',
                9 => 'permisos_por_rol',
                10 => 'roles',
                11 => 'tipo_salidas',
                12 => 'ubicacion_catalogos',
                13 => 'logs',
                14 => 'paises',
                15 => 'departamentos'
            ] + self::modelosAdministrador();

    }

    /**
     * MODELOS PERMITIDOS PARA UN USUARIO TIPO ADMINISTRADOR
     *
     * @return array
     */
    public static function modelosAdministrador()
    {
        return
            [
                16 => 'usuario_extensiones',
                17 => 'extensiones',
            ] + self::modelosUsuarioEstandar();
    }

    /**
     * MODELOS PERMITIDOS PARA UN USUARIO TIPO ESTANDAR
     *
     * @return array
     */
    public static function modelosUsuarioEstandar()
    {
        return
            [
                18 => 'usuarios',
                19 => 'marcados',
                20 => 'historiales',
                21 => 'notificaciones'
            ];
    }

}
