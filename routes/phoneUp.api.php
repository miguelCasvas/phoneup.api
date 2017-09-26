<?php

Route::group(['middleware' => 'auth:api'], function()
{

    # USUARIO
    Route::resource('usuarios', 'usuarioController');

    Route::get('miusuario','usuarioController@getMiUsuario');

    Route::put('edicionmiusuario/{idUser}','usuarioController@edicionMiUsuario');

    # EXTENSION DE USUARIO
    Route::resource('usuarioextension', 'UsuarioExtensionController');

    # UBICACION DE CATALOGO
    Route::resource('ubicacioncatalogo', 'UbicacionCatalogoController');

    # TIPO SALIDA
    Route::resource('tiposalida','TipoSalidaController');

    # NOTIFICACIONES
    Route::resource('notificacion','NotificacionController');

    # CONJUNTO
    Route::resource('conjunto', 'ConjuntoController');

    # PERMISOS
    Route::resource('permisos', 'PermisoController');

    # ROL
    Route::resource('roles', 'RolController');

    # ESTADOS
    Route::resource('estado', 'EstadoController');

    # EXTENSIONES
    Route::resource('extension', 'ExtensionController');

    # CANAL DE COMUNICACION
    Route::resource('canalcomunicacion', 'CanalComunicacionController');

    # CATALOGO
    Route::resource('catalogo', 'CatalogoController');

    # CIUDAD
    Route::resource('ciudad', 'CiudadController');

    # HISTORIAL
    Route::resource('historial', 'HistorialController');
    Route::get('mihistorial/{idUser}','HistorialController@getMiHistorial');

    # MODULO
    Route::resource('modulo', 'ModuloController');

    # MODELO
    Route::resource('modelo', 'ModeloController');

    # LOG
    Route::resource('log', 'LogController');

    # MARCADO
    Route::resource('marcado','MarcadoController');

    # PERMISO POR ROL
    Route::resource('permisorol','PermisosRolController');

});