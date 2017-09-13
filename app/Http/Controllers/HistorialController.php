<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CreateRegisterLog;
use App\Http\Requests\Historial\StoreRequest;
use App\Models\Historial;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class HistorialController extends Controller
{
    //
    use CreateRegisterLog;
    private $modelHistorial = Historial::class;
    private $userController;

    function __construct(){

        $this->modelHistorial = new Historial();
        $this->userController = new UserController();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->validarPermisos($this->modelHistorial->getTable(), 1);
        $this->modelHistorial->accion    = $request->get('accion');
        // se debe traer de forma automática el usuario actual
        $this->modelHistorial->id_usuario    = Authorizer::getResourceOwnerId();
        $this->modelHistorial->id_usuario_m    = $request->get('idUsuarioM');
        $this->modelHistorial->id_modulo    = $request->get('idModulo');
        $this->modelHistorial->save();

        $response = response()->json(['data'=>$this->modelHistorial]);
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
        $this->validarPermisos($this->modelHistorial->getTable(), 2);
        $data = $this->modelHistorial->find($id);
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
        $this->validarPermisos($this->modelHistorial->getTable(), 2);
        $data = $this->modelHistorial->all();
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
        $this->validarPermisos($this->modelHistorial->getTable(), 3);
        $response = null;
        $this->modelHistorial = $this->modelHistorial->find($id);

        if ($this->modelHistorial == null){
            abort(400, trans('errors.901'));
        }
        else{
            $this->modelHistorial->accion    = $request->get('accion');
            $this->modelHistorial->id_usuario    = Authorizer::getResourceOwnerId();
            $this->modelHistorial->id_usuario_m    = $request->get('idUsuarioM');
            $this->modelHistorial->id_modulo    = $request->get('idModulo');
            $this->modelHistorial->save();
            $response = response()->json(['data'=>$this->modelHistorial]);
        }

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
        $this->validarPermisos($this->modelHistorial->getTable(), 4);
        $response = null;
        $this->modelHistorial = $this->modelHistorial->find($id);

        if ($this->modelHistorial == null){
            abort(400, trans('errors.901'));
        }else {
            $this->modelHistorial->delete();
            $response = response()->json([  'data'=> ['id'=> $id ]]);
        }
        $this->CreateRegisterLog($response);
        return $response;
    }

    public function getMiHistorial($id)
    {
        $idUser = Authorizer::getResourceOwnerId();
        if ($id != $idUser)
            abort(400, trans('errors.902'));

        $response = response()->json(['data' => $this->modelHistorial->where('id_usuario','=',$idUser)->get()]);
        # Creacion en modelo log
        //$this->CreateRegisterLog($response);

        return $response;

    }
}
