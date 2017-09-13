<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CreateRegisterLog;
use App\Http\Requests\Rol\StoreRequest;
use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    //
    use CreateRegisterLog;
    private $modelRol = Rol::class;
    private $userController;

    function __construct(){

        $this->modelRol = new Rol();
        $this->userController = new UserController();
    }


    /**
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        # Validar permisos
        $this->validarPermisos($this->modelRol->getTable(), 1);

        $this->modelRol->nombre_rol    = $request->get('nombreRole');
        $this->modelRol->save();

        $response = response()->json(['data' => $this->modelRol]);

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
        $this->validarPermisos($this->modelRol->getTable(), 2);

        $data = $this->modelRol->find($id);
        $response = response()->json([ 'data' => $data ]);
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
        $this->validarPermisos($this->modelRol->getTable(), 2);

        $data = $this->modelRol->all();

        return response()->json(['data' => $data ]);
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
        $this->validarPermisos($this->modelRol->getTable(), 3);

        $response = null;
        $this->modelRol = $this->modelRol->find($id);

        if ($this->modelRol == null){
            abort(400, trans('errors.901'));
        }

        $this->modelRol->nombre_rol    = $request->get('nombreRole');
        $this->modelRol->save();

        $response = response()->json(['data' => $this->modelRol]);

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
        $this->validarPermisos($this->modelRol->getTable(), 4);

        $this->modelRol = $this->modelRol->find($id);

        if ($this->modelRol == null){
            abort(400, trans('errors.901'));
        }

        $this->modelRol->find($id)->delete();
        $response = response()->json(['data'=> ['id'=> $id ]]);

        $this->CreateRegisterLog($response);
        return $response;
    }
}
