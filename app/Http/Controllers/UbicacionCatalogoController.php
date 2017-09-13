<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CreateRegisterLog;
use App\Http\Requests\UbicacionCatalogo\StoreRequest;
use App\Http\Requests\UbicacionCatalogo\UpdateRequest;
use App\Models\UbicacionCatalogo;
use Illuminate\Http\Request;

class UbicacionCatalogoController extends Controller
{
    use CreateRegisterLog;

    /**
     * @var UbicacionCatalogo
     */
    private $modelUbicacionCatalogo = UbicacionCatalogo::class;

    function __construct()
    {
        $this->modelUbicacionCatalogo = new UbicacionCatalogo();
    }


    public function index()
    {
        # Validar permisos
        $this->validarPermisos($this->modelUbicacionCatalogo->getTable(), 2);

        $data = $this->modelUbicacionCatalogo->all();
        return response()->json([ "data"=> $data ]);
    }
    
    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        # Validar permisos
        $this->validarPermisos($this->modelUbicacionCatalogo->getTable(), 2);

        $data = ['data' => $this->modelUbicacionCatalogo->find($id)];
        return response()->json($data);
    }

    /**
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        # Validar permisos
        $this->validarPermisos($this->modelUbicacionCatalogo->getTable(), 1);

        $this->modelUbicacionCatalogo->nombre_ubicacion_catalogo = $request->get('nombreUbicacionCatalogo');
        $this->modelUbicacionCatalogo->id_catalogo = $request->get('idCatalogo');
        $this->modelUbicacionCatalogo->save();

        $response = response()->json($this->modelUbicacionCatalogo);

        # Creacion en modelo log
        $this->CreateRegisterLog($response);

        return $response;
    }

    /**
     * @param UpdateRequest $request
     * @param               $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update( UpdateRequest $request, $id)
    {
        # Validar permisos
        $this->validarPermisos($this->modelUbicacionCatalogo->getTable(), 3);

        $this->modelUbicacionCatalogo = $this->modelUbicacionCatalogo->find($id);

        if ($this->modelUbicacionCatalogo == null){
            abort(400, trans('errors.901'));
        }

        $this->modelUbicacionCatalogo->nombre_ubicacion_catalogo = $request->get('nombreUbicacionCatalogo');
        $this->modelUbicacionCatalogo->id_catalogo = $request->get('idCatalogo');
        $this->modelUbicacionCatalogo->save();

        $response = response()->json($this->modelUbicacionCatalogo);

        # Creacion en modelo log
        $this->CreateRegisterLog($response);

        return $response;
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        # Validar permisos
        $this->validarPermisos($this->modelUbicacionCatalogo->getTable(), 4);

        $this->modelUbicacionCatalogo = $this->modelUbicacionCatalogo->find($id);
        if ($this->modelUbicacionCatalogo == null){
            abort(400, trans('errors.901'));
        }

        $this->modelUbicacionCatalogo->delete();

        $response = response()->json([  'data'=> ['id'=> $id ]]);
        $this->CreateRegisterLog($response);

        return $response;
    }
}
