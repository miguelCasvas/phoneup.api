<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermisosRol\StoreRequest;
use App\Models\PermisosRol;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\CreateRegisterLog;

class PermisosRolController extends Controller
{
    use CreateRegisterLog;

    private $modelPermisoRol;

    function __construct()
    {
        $this->modelPermisoRol = new PermisosRol();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # Validar permisos
        $this->validarPermisos($this->modelPermisoRol->getTable(), 2);

        $data = $this->modelPermisoRol->all();
        $response = response()->json(['data' => $data]);
        //$this->CreateRegisterLog($response);
        return $response;
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
        $this->validarPermisos($this->modelPermisoRol->getTable(), 1);

        $this->modelPermisoRol->id_rol = $request->get('idRol');
        $this->modelPermisoRol->id_permiso = $request->get('idPermiso');
        $this->modelPermisoRol->id_modelo = $request->get('idModelo');

        $response = response()->json(['data' => $this->modelPermisoRol]);
        $this->CreateRegisterLog($response);

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        # Validar permisos
        $this->validarPermisos($this->modelPermisoRol->getTable(), 2);

        $data = $this->modelPermisoRol->find($id);
        $response = response()->json(['data' => $data]);
        $this->CreateRegisterLog($response);
        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, $id)
    {
        # Validar permisos
        $this->validarPermisos($this->modelPermisoRol->getTable(), 3);

        $this->modelPermisoRol = $this->modelPermisoRol->find($id);

        if ($this->modelPermisoRol == null)
            abort(400, trans('errors.901'));

        return $this->store($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        # Validar permisos
        $this->validarPermisos($this->modelPermisoRol->getTable(), 4);

        $this->modelPermisoRol = $this->modelPermisoRol->find($id);

        if ($this->modelPermisoRol == null)
            abort(400, trans('errors.901'));

        $this->modelPermisoRol->delete();

        $response = response()->json(['data' => $id]);
        $this->CreateRegisterLog($response);

        return $response;
    }
}
