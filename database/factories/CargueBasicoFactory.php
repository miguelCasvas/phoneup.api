<?php
/**
 *  ******** TABLA ESTADOS ********
 *
 * Define Factory para cargue de vlrs en seeders
 */
$factory->define(App\Models\Estado::class, function ($faker){return [];});

/**
 *  ******** TABLA PERMISOS********
 *
 * Define Factory para cargue de vlrs en seeders
 */
$factory->define(App\Models\Permiso::class, function(){
    return [
        'nombre_permiso' => '',
        'id_roles' => '.',
        'id_estado' => 1
    ];
});

/**
 *  ******** TABLA USUARIOS ********
 *
 * Define Factory para cargue de vlrs en seeders
 */
$factory->define(App\Models\Permiso::class, function(){
    return [
        'nombre_permiso' => '',
        'id_roles' => '.',
        'id_estado' => 1
    ];
});

/**
 *  ******** TABLA MODELOS ********
 *
 * Define Factory para cargue de vlrs en seeders
 */
$factory->define(App\Models\Modelo::class, function(){return ['nombre_modelo' => ''];});

/**
 *  ******** TABLA ROLES ********
 *
 * Define Factory para cargue de vlrs en seeders
 */
$factory->define(App\Models\Rol::class, function(){return ['nombre_rol' => ''];});

/**
 *  ******** TABLA PERMISOS_POR_ROL ********
 *
 * Define Factory para cargue de vlrs en seeders
 */
$factory->define(App\Models\PermisosRol::class, function(){
    return [
        'id_rol' => 1,
        'id_permiso' => 1,
        'id_modelo' => 1,
    ];
});

/**
 *  ******** TABLA USUARIOS  ********
 *
 * Define Factory para cargue de vlrs en seeders
 */
$factory->define(App\Models\Usuario::class, function(Faker\Generator $faker){
    return [
        'nombres' => '',
        'apellidos' => '',
        'email' => '',
        'password' => bcrypt(12345678),
        'identificacion' => $faker->unique()->numberBetween(10000, 20000),
        'fecha_nacimiento' => $faker->unique()->date(),
        'id_rol' => 1,
        'id_conjunto' => 1
    ];
});
