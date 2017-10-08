<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CreateRegisterLog;
use App\Http\Requests\Departamento\StoreRequest;
use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    use CreateRegisterLog;

    /**
     * @var Departamento
     */
    private $modelDepartamento = Departamento::class;

    function __construct()
    {
        $this->modelDepartamento = new Departamento();
    }

    public function index()
    {
        $this->validarPermisos($this->modelDepartamento->getTable(), 2);

        $data = $this->modelDepartamento->all();
        $response = response()->json([ 'data' => $data ]);

        # Creacion en modelo log
        $this->CreateRegisterLog($response);
        return $response;
    }

    public function show($id)
    {
        # Validar permisos
        $this->validarPermisos($this->modelDepartamento->getTable(), 2);

        $data = $this->modelDepartamento->find($id);
        $response = response()->json([ 'data' => $data ]);

        # Creacion en modelo log
        $this->CreateRegisterLog($response);
        return $response;
    }

    public function store(StoreRequest $request)
    {
        $this->validarPermisos($this->modelDepartamento->getTable(), 1);
        $this->modelDepartamento->nombre_departamento = $request->get('nombreDepartamento');
        $this->modelDepartamento->id_pais = $request->get('idPais');
        $this->modelDepartamento->save();

        $response = response()->json($this->modelDepartamento);

        # Creacion en modelo log
        $this->CreateRegisterLog($response);
        return $response;
    }

    public function update(StoreRequest $request, $id)
    {
        $this->validarPermisos($this->modelDepartamento->getTable(), 3);
        $this->modelDepartamento = $this->modelDepartamento->find($id);

        if ($this->modelDepartamento == null)
            abort(400, trans('error.901'));

        $this->modelDepartamento->nombre_departamento = $request->get('nombreDepartamento');
        $this->modelDepartamento->id_pais = $request->get('idPais');
        $this->modelDepartamento->save();

        $response = response()->json($this->modelDepartamento);

        # Creacion en modelo log
        $this->CreateRegisterLog($response);
        return $response;
    }

    public function destroy(Request $request, $id)
    {
        $this->validarPermisos($this->modelDepartamento->getTable(), 4);
        $this->modelDepartamento = $this->modelDepartamento->find($id);

        if ($this->modelDepartamento == null)
            abort(400, trans('errors.901'));

        $response = response()->json(['data' => $id]);
        $this->modelDepartamento->delete();
        $this->CreateRegisterLog($response);

        return $response;
    }

    /**
     * Generar listado segun filtros enviados por parametro URL
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function departamentosFiltrado(Request $request)
    {
        # Validar permisos
        $this->validarPermisos($this->modelDepartamento->getTable(), 2);

        $columns = array_flip($this->modelDepartamento->getFillable());

        $filtrosEnviados = array_intersect_key($request->all(), $columns);
        $filtros = [];

        foreach ($filtrosEnviados as $columnaFiltro => $vlr) {
            $filtros[] = [$columnaFiltro, $vlr];
        }

        if (empty($filtros))
            return response()->json(['data' => []]);


        $data = $this->modelDepartamento->where($filtros)->get();

        return response()->json(['data' => $data]);
    }
}
