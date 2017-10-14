<?php

Route::group(['middleware' => 'auth:api'], function()
{

    # USUARIO Y
    Route::resource('usuarios', 'usuarioController');

    Route::get('miusuario','usuarioController@getMiUsuario');

    Route::put('edicionmiusuario/{idUser}','usuarioController@edicionMiUsuario');

    # EXTENSION DE USUARIO
    Route::resource('usuarioextension', 'UsuarioExtensionController');

    # UBICACION DE CATALOGO
    Route::get('ubicacioncatalogofiltrado', 'UbicacionCatalogoController@listadoUbicacionCatalogoFiltrado');
    Route::resource('ubicacioncatalogo', 'UbicacionCatalogoController');

    # TIPO SALIDA
    Route::resource('tiposalida','TipoSalidaController');

    # NOTIFICACIONES
    Route::resource('notificacion','NotificacionController');

    # CONJUNTO
    Route::get('conjuntos/datosgenerales_1', 'ConjuntoController@datos1_Conjunto');
    Route::get('conjuntos/datosgenerales_2', 'ConjuntoController@datos2_Conjunto');
    Route::get('conjuntos/datosgenerales_3', 'ConjuntoController@datos3_Conjunto');# Extensiones
    Route::get('conjuntos/datosgenerales_4', 'ConjuntoController@datos4_Conjunto');# Extensiones Rel Usuario
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
    Route::get('canalcomunicacion/conjuntos', 'CanalComunicacionController@canalesPorConjunto');
    Route::resource('canalcomunicacion', 'CanalComunicacionController');

    # CATALOGO
    Route::resource('catalogo', 'CatalogoController');

    # CIUDAD
    Route::get('ciudadfiltrado', 'CiudadController@ciudadFiltrado');
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

    # PAISES
    Route::resource('pais', 'PaisController');

    # DEPARTAMENTOS
    Route::get('departamentofiltrado', 'DepartamentoController@departamentosFiltrado');
    Route::resource('departamento', 'DepartamentoController');

});