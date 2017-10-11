<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
/**
 * Creación de CONJUNTOS para cargue en BD
 */
$factory->define(App\Models\Conjunto::class, function(Faker\Generator $faker){
    return [
        'nombre_conjunto' => $faker->unique()->name,
        'direccion' => $faker->address,
        'email' => $faker->unique()->safeEmail,
        'telefono' => $faker->phoneNumber,
        'id_ciudad' => rand(1, 1006)
    ];
});


/**
 * Creación de EXTENSIONES para cargue en BD
 */
$factory->define(App\Models\Extension::class, function(Faker\Generator $faker){
   return [
       'extension' => rand(1100, 1999),
       'id_conjunto' => 1,
       'id_estado' => 1
   ];
});

/**
 * Creacion de Catalogos para carguen en BD
 */
$factory->state(App\Models\Catalogo::class, 'Apto', function($faker){return ['nombre_catalogo' => 'Apartamento'];});
$factory->state(App\Models\Catalogo::class, 'Int', function($faker){return ['nombre_catalogo' => 'Interior'];});
$factory->state(App\Models\Catalogo::class, 'Mz', function($faker){return ['nombre_catalogo' => 'Manzana'];});
$factory->state(App\Models\Catalogo::class, 'Blq', function($faker){return ['nombre_catalogo' => 'Bloque'];});


$factory->define(App\Models\Catalogo::class, function(Faker\Generator $faker){
    return [
        'id_conjunto' => 1
    ];
});

/**
 * Creacion de canales de comunicacion para cargue en BD
 */
$factory->state(App\Models\CanalComunicacion::class, 'fij', function($faker){return ['canal' => 'Fijo'];});
$factory->state(App\Models\CanalComunicacion::class, 'mov', function($faker){return ['canal' => 'Movil'];});
$factory->state(App\Models\CanalComunicacion::class, 'what', function($faker){return ['canal' => 'WhatsApp'];});
$factory->state(App\Models\CanalComunicacion::class, 'correo', function($faker){return ['canal' => 'Correo'];});

$factory->define(App\Models\CanalComunicacion::class, function (Faker\Generator $faker){
    return [
        'indicativo' => '(' . $faker->numberBetween(50, 100) . ')',
        'id_conjunto' => 1
    ];
});
