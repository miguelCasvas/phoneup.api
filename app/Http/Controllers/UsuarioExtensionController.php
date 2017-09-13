<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CreateRegisterLog;
use App\Http\Requests\UsuarioExtension\StoreRequest;
use App\Models\UsuarioExt;
use Illuminate\Http\Request;

class UsuarioExtensionController extends Controller
{

    use CreateRegisterLog;
    private $modelUsuarioExtensiones = UsuarioExt::class;
    private $userController;

    function __construct(){
        $this->modelUsuarioExtensiones = new UsuarioExt();
        $this->userController = new UserController();
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        # Validar permisos
        $this->validarPermisos($this->modelUsuarioExtensiones->getTable(), 1);

        $data = $this->modelUsuarioExtensiones->all();
        return response()->json([ "data"=> $data ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        # Validar permisos
        $this->validarPermisos($this->modelUsuarioExtensiones->getTable(), 2);

        $data = ['data' => $this->modelUsuarioExtensiones->find($id)];
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
        $this->validarPermisos($this->modelUsuarioExtensiones->getTable(), 1);

        $this->modelUsuarioExtensiones->id_extension = $request->get('idExtension');
        $this->modelUsuarioExtensiones->id_usuario = $request->get('idUsuario');
        $this->modelUsuarioExtensiones->save();

        $response = response()->json($this->modelUsuarioExtensiones);

        # Creacion en modelo log
        $this->CreateRegisterLog($response);

        return $response;
    }

    /**
     * @param StoreRequest $request
     * @return StoreRequest
     */
    public function update(StoreRequest $request)
    {
        # Validar permisos
        $this->validarPermisos($this->modelUsuarioExtensiones->getTable(), 3);

        $this->modelUsuarioExtensiones = $this->modelUsuarioExtensiones->find($id);

        if ($this->modelUsuarioExtensiones == null){
            abort(400, trans('errors.901'));
        }

        $this->modelUsuarioExtensiones->id_extension = $request->get('idExtension');
        $this->modelUsuarioExtensiones->id_usuario = $request->get('idUsuario');
        $this->modelUsuarioExtensiones->save();

        $response = response()->json($this->modelUsuarioExtensiones);

        # Creacion en modelo log
        $this->CreateRegisterLog($response);
        return $request;
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
        $this->validarPermisos($this->modelUsuarioExtensiones->getTable(), 4);

        $this->modelUsuarioExtensiones = $this->modelUsuarioExtensiones->find($id);

        if ($this->modelUsuarioExtensiones == null){
            abort(400, trans('errors.901'));
        }

        $this->modelUsuarioExtensiones->delete();

        $response = response()->json([  'data'=> ['id'=> $id ]]);

        $this->CreateRegisterLog($response);
        return $response;
    }
}
