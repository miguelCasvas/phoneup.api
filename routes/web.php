<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('demo', function(){

    dd(bcrypt(12345678));
    $obj = new \App\models\Extension();

   $newRequest = [
       'extension' => '10101',
       'id_conjunto' => 1,
       'id_ubicacion_catalogo_1' => 1,
       'id_ubicacion_catalogo_2' => 2,
       'id_estado' => 1
   ];
    $obj->create($newRequest);

});
