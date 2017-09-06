<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MigrationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->generateUrlMigrations();

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }


    /**
     * Registra todas las rutas de las migraciones para generarlas
     */
    private function generateUrlMigrations()
    {
        $routeMigrations = 'database/migrations/';

        $routesSubMigrations = [

            # MODELO USUARIOS
            $routeMigrations.'model_Canal_comunicacion/',

            $routeMigrations.'model_User/',
            $routeMigrations.'model_Catalogo/',
            $routeMigrations.'model_Ciudad/',
            $routeMigrations.'model_Conjunto/',
            $routeMigrations.'model_Estados/',
            $routeMigrations.'model_Historial/',
            $routeMigrations.'model_Log/',
            $routeMigrations.'model_Login/',
            $routeMigrations.'model_Marcados/',
            $routeMigrations.'model_Modulos/',
            $routeMigrations.'model_Notificacion/',
            $routeMigrations.'model_Permisos/',
            $routeMigrations.'model_Roles/',
            $routeMigrations.'model_Tipo_salida/',
            $routeMigrations.'model_Ubicacion_catalogo/',
            $routeMigrations.'model_Usuario/',
            $routeMigrations.'model_Usuario_ext/',

        ];

        foreach ($routesSubMigrations as $route) {
            $this->loadMigrationsFrom($route);
        }
    }
}
