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
    private $userController;

    function __construct(){

        $this->modelTiposSalidas = new TipoSalida();
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
        # Validar permisos
        $this->validarPermisos($this->modelTiposSalidas->getTable(), 1);

        $this->modelTiposSalidas->nombre_tipo_salida    = $request->get('nombreTipoSalida');
        $this->modelTiposSalidas->id_marcado    = $request->get('idMarcado');
        $this->modelTiposSalidas->id_notificacion    = $request->get('idNotificacion');
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
}
