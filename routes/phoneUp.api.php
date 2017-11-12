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


    # RUTAS VERSION 1
    Route::group(['prefix' => 'v1'], function()
    {
        # CONJUNTOS
        Route::group(['prefix' => 'conjuntos'], function(){

            Route::get('{idConjunto}/extensiones', 'ExtensionController@extensionesPorConjunto');
            Route::get('datosgenerales_1', 'ConjuntoController@datos1_Conjunto');
            //Route::get('datosgenerales_3', 'ConjuntoController@datos3_Conjunto');
            Route::get('datosgenerales_4', 'ConjuntoController@datos4_Conjunto');

            # Catalogos por conjunto
            Route::get('{idConjunto}/catalogos', 'CatalogoController@catalogosPorConjunto');

            # Canales de comunicacion por conjunto
            Route::get('canalesComunicacion', 'CanalComunicacionController@canalesPorConjunto');
            Route::get('canalesComunicacion/tipoSalida', 'TipoSalidaController@listadoRelacionado_ft_Conjunto');

            Route::resource('/', 'ConjuntoController');

        });

        # CATALOGO
        Route::group(['prefix' => 'catalogos'], function(){
            Route::post('orden', 'CatalogoController@generarOrden');
        });
        Route::resource('catalogos', 'CatalogoController');

        # TIPO SALIDA
        Route::group(['prefix' => 'tiposalida'], function(){
            Route::get('listado', 'TipoSalidaController@listadoRelacionado_ft_canal');
        });
        Route::resource('tiposalida','TipoSalidaController');

        # EXTENSIONES
        Route::resource('extensiones', 'ExtensionController');

        # USUARIO
        Route::group(['prefix' => 'usuarios'], function(){
            # Crear extension para usuario
            Route::post('{idUsuario}/extensiones', 'UsuarioExtensionController@crearExtensionParaUsuario');

            # Actualizacion de contraseña
            Route::put('{idUsuairo}/cambioContrasenia', 'usuarioController@cambioContrasenia');

        });

        # Resource usuarios
        Route::resource('usuarios', 'usuarioController');

        # EXTENSION DE USUARIO
        Route::group(['prefix' => 'usuarioextension'], function(){
            Route::resource('/', 'UsuarioExtensionController');
        });

        # UBICACION DE CATALOGO
        Route::resource('ubicacioncatalogo', 'UbicacionCatalogoController');
        Route::get('ubicacioncatalogofiltrado', 'UbicacionCatalogoController@listadoUbicacionCatalogoFiltrado');

        # EXTENSIONES
        Route::resource('extensiones', 'ExtensionController');

    });


});
