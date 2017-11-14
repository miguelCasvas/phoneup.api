<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CreateRegisterLog;
use App\Http\Requests\TipoSalida\StoreRequest;
use App\Models\TipoSalida;
use Illuminate\Http\Request;

class TipoSalidaController extends Controller
{
    //
    use CreateRegisterLog;
    private $modelTiposSalidas = TipoSalida::class;
    private $usuarioController;

    function __construct(){

        $this->modelTiposSalidas = new TipoSalida();
        $this->usuarioController = new usuarioController();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        # Validar permisos
        $this->validarPermisos($this->modelTiposSalidas->getTable(), 1);

        $this->modelTiposSalidas->nombre_tipo_salida    = $request->get('nombreTipoSalida');
        $this->modelTiposSalidas->metodo                = $request->get('metodo');
        $this->modelTiposSalidas->metodo_params         = $request->get('metodoParams');
        $this->modelTiposSalidas->id_canal              = $request->get('idCanal');
        $this->modelTiposSalidas->id_notificacion       = $request->get('idNotificacion');
        $this->modelTiposSalidas->comentarios           = $request->get('comentarios');
        $this->modelTiposSalidas->save();

        $response = response()->json($this->modelTiposSalidas);

        # Creacion en modelo log
        $this->CreateRegisterLog($response);

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        # Validar permisos
        $this->validarPermisos($this->modelTiposSalidas->getTable(), 2);

        $data = $this->modelTiposSalidas->find($id);
        $numError = 200;

        $response = response()->json(['data' => $data]);

        # Creacion en modelo log
        $this->CreateRegisterLog($response);

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # Validar permisos
        $this->validarPermisos($this->modelTiposSalidas->getTable(), 2);

        $data = $this->modelTiposSalidas->all();

        return response()->json([ 'data'=> $data ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, $id)
    {
        # Validar permisos
        $this->validarPermisos($this->modelTiposSalidas->getTable(), 3);

        $response = null;
        $this->modelTiposSalidas = $this->modelTiposSalidas->find($id);

        if ($this->modelEstados == null){
            abort(400, trans('errors.901'));
        }

        $this->modelTiposSalidas->nombre_tipo_salida    = $request->get('nombreTipoSalida');
        $this->modelTiposSalidas->id_marcado    = $request->get('idMarcado');
        $this->modelTiposSalidas->id_notificacion    = $request->get('idNotificacion');
        $this->modelTiposSalidas->save();

        $response = response()->json(['data' => $this->modelTiposSalidas]);

        $this->CreateRegisterLog($response);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        # Validar permisos
        $this->validarPermisos($this->modelTiposSalidas->getTable(), 4);

        $this->modelTiposSalidas = $this->modelTiposSalidas->find($id);

        if ($this->modelTiposSalidas == null){
            abort(400, trans('errors.901'));
        }

        $this->modelTiposSalidas->delete();

        $response = response()->json([ 'data'=> ['id'=> $id ]]);

        $this->CreateRegisterLog($response);
        return $response;
    }

    public function listadoRelacionado_ft_canal()
    {
        $data = $this->modelTiposSalidas->listadoTposSalidaRelacionadosACanal();

        return response()->json(['data' => $data->get()->toArray()]);
    }

    /**
     * Genera la busqueda de todos los tipos de salida con relacion:
     * * Canal de comunicion --> ft --> conjunto
     */
    public function listadoRelacionado_ft_Conjunto(Request $request)
    {

        $callable = function(&$key, &$vlr){

            # Si el parametro es id_conjunto cambia la invocacion
            # de esta columna añadiendo la tabla origen para no crear
            # ambiguedad
            if ($key == 'id_conjunto')
                $key = 'conjuntos.' . $key;

            if ($key == 'id_canal')
                $key = 'canal_comunicaciones.' . $key;

            if ($key == 'id_tipo_salida')
                $key = 'tipo_salidas.' . $key;

        };

        $filtros = $this->generarFiltros($request->all(), '=', $callable);
        $data = $this->modelTiposSalidas->listadoTposSalidaRelacionadosCanal_Conjuntos($filtros);
        return response()->json(['data' => $data->get()->toArray()]);

    }
}
