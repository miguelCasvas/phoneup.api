<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CreateRegisterLog;
use App\Http\Requests\Ciudad\StoreRequest;
use App\Models\Ciudad;
use Illuminate\Http\Request;

class CiudadController extends Controller
{
    //
    use CreateRegisterLog;
    private $modelCiudad = Ciudad::class;
    private $usuarioController;

    function __construct(){

        $this->modelCiudad = new Ciudad();
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
        $this->validarPermisos($this->modelCiudad->getTable(), 1);
        $this->modelCiudad->nombre_ciudad    = $request->get('nombreCiudad');
        $this->modelCiudad->id_departamento    = $request->get('idDepartamento');
        $this->modelCiudad->save();

        $response = response()->json(['data'=>$this->modelCiudad]);
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
        $this->validarPermisos($this->modelCiudad->getTable(), 2);
        $data = $this->modelCiudad->find($id);
        $response = response()->json([ 'data'=> $data ]);
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
        $this->validarPermisos($this->modelCiudad->getTable(), 2);
        $data = $this->modelCiudad->all();
        return response()->json([ "data"=> $data ]);
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
        $this->validarPermisos($this->modelCiudad->getTable(), 3);
        $response = null;
        $this->modelCiudad = $this->modelCiudad->find($id);

        if ($this->modelCiudad == null){
            abort(400, trans('errors.901'));
        }
        else{
            $this->modelCiudad->nombre_ciudad    = $request->get('nombreCiudad');
            $this->modelCiudad->save();
            $response = response()->json(['data'=>$this->modelCiudad]);
        }

        //$this->CreateRegisterLog($response);
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
        $this->validarPermisos($this->modelCiudad->getTable(), 4);
        $response = null;
        $this->modelCiudad = $this->modelCiudad->find($id);

        if ($this->modelCiudad == null){
            abort(400, trans('errors.901'));
        }else {
            $this->modelCiudad->delete();
            $response = response()->json([  'data'=> ['id'=> $id ]]);
        }
        //$this->CreateRegisterLog($response);
        return $response;
    }

    /**
     * Generar listado segun filtros enviados por parametro URL
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ciudadFiltrado(Request $request)
    {
        # Validar permisos
        $this->validarPermisos($this->modelCiudad->getTable(), 2);

        $columns = array_flip($this->modelCiudad->getFillable());

        $filtrosEnviados = array_intersect_key($request->all(), $columns);
        $filtros = [];

        foreach ($filtrosEnviados as $columnaFiltro => $vlr) {
            $filtros[] = [$columnaFiltro, $vlr];
        }

        if (empty($filtros))
            return response()->json(['data' => []]);


        $data = $this->modelCiudad->where($filtros)->get();

        return response()->json(['data' => $data]);
    }
}