<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CreateRegisterLog;
use App\Http\Requests\Modulo\StoreRequest;
use App\Models\Modulo;
use Illuminate\Http\Request;

class ModuloController extends Controller
{
    use CreateRegisterLog;

    private $modelModulo = Modulo::class;

    function __construct()
    {
        $this->modelModulo = new Modulo();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        # Validar permisos
        $this->validarPermisos($this->modelModulo->getTable(), 2);

        $response = response()->json(['data' => $this->modelModulo->all()]);
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
        $this->validarPermisos($this->modelModulo->getTable(), 2);

        $response = response()->json(['data' => $this->modelModulo->find($id)]);
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
        $this->validarPermisos($this->modelModulo->getTable(), 1);

        $this->modelModulo->nombre_modulo = $request->get('nombreModulo');
        $this->modelModulo->save();

        $response = response()->json(['data' => $this->modelModulo]);
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
        $this->validarPermisos($this->modelModulo->getTable(), 3);

        $this->modelModulo = $this->modelModulo->find($id);

        if ($this->modelModulo == null)
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
        $this->validarPermisos($this->modelModulo->getTable(), 4);

        $this->modelModulo = $this->modelModulo->find($id);

        if ($this->modelModulo == null)
            abort(400, trans('errors.901'));

        $this->modelModulo->delete();

        $response = response()->json(['data' => $id]);
        $this->CreateRegisterLog($response);

        return $response;
    }
}
