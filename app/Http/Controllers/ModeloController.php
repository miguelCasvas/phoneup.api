<?php

namespace App\Http\Controllers;

use App\Http\Requests\Modelo\StoreRequest;
use App\Models\Modelo;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\CreateRegisterLog;

class ModeloController extends Controller
{
    use CreateRegisterLog;

    private $modelModelo = Modelo::class;

    function __construct()
    {
        $this->modelModelo = new Modelo();
    }

    public function index()
    {
        # Validar permisos
        $this->validarPermisos($this->modelModelo->getTable(), 2);

        $response = response()->json(['data' => $this->modelModelo->all()]);
        $this->CreateRegisterLog($response);
        return $response;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        # Validar permisos
        $this->validarPermisos($this->modelModelo->getTable(), 2);

        $response = response()->json(['data' => $this->modelModelo->find($id)]);
        $this->CreateRegisterLog($response);

        return $response;
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        # Validar permisos
        $this->validarPermisos($this->modelModelo->getTable(), 1);

        $this->modelModelo->nombre_modelo = $request->get('nombreModelo');
        $this->modelModelo->save();

        $response = response()->json(['data' => $this->modelModelo]);
        $this->CreateRegisterLog($response);

        return $response;
    }

    /**
     * @param StoreRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreRequest $request, $id)
    {
        # Validar permisos
        $this->validarPermisos($this->modelModelo->getTable(), 3);

        $this->modelModelo = $this->modelModelo->find($id);

        if ($this->modelModelo == null)
            abort(400, trans('errors.901'));

        return $this->store($request);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        # Validar permisos
        $this->validarPermisos($this->modelModelo->getTable(), 4);

        $this->modelModelo = $this->modelModelo->find($id);

        if ($this->modelModelo == null)
            abort(400, trans('errors.901'));

        $this->modelModelo->delete();

        $response = response()->json(['data' => $id]);
        $this->CreateRegisterLog($response);

        return $response;
    }
}
