<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CreateRegisterLog;
use App\Http\Requests\Marcado\StoreRequest;
use App\Models\Marcado;
use Illuminate\Http\Request;

class MarcadoController extends Controller
{
    //
    use CreateRegisterLog;
    private $modelMarcado = Marcado::class;
    private $userController;

    function __construct(){

        $this->modelMarcado = new Marcado();
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
        $this->validarPermisos($this->modelMarcado->getTable(), 1);
        $this->modelMarcado->secuencia_marcado    = $request->get('secuenciaMarcado');
        $this->modelMarcado->id_extension    = $request->get('idExtension');
        $this->modelMarcado->id_tipo_salida    = $request->get('idTipoSalida');
        $this->modelMarcado->save();

        $response = response()->json(['data'=>$this->modelMarcado]);
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
        $this->validarPermisos($this->modelMarcado->getTable(), 2);
        $data = $this->modelMarcado->find($id);
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
        $this->validarPermisos($this->modelMarcado->getTable(), 2);
        $data = $this->modelMarcado->all();
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
        $this->validarPermisos($this->modelMarcado->getTable(), 3);
        $response = null;
        $this->modelMarcado = $this->modelMarcado->find($id);

        if ($this->modelMarcado == null){
            abort(400, trans('errors.901'));
        }
        else{
            $this->modelMarcado->secuencia_marcado    = $request->get('secuenciaMarcado');
            $this->modelMarcado->id_extension    = $request->get('idExtension');
            $this->modelMarcado->id_tipo_salida    = $request->get('idTipoSalida');
            $this->modelMarcado->save();
            $response = response()->json(['data'=>$this->modelMarcado]);
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
        $this->validarPermisos($this->modelMarcado->getTable(), 4);
        $response = null;
        $this->modelMarcado = $this->modelMarcado->find($id);

        if ($this->modelMarcado == null){
            abort(400, trans('errors.901'));
        }else {
            $this->modelMarcado->delete();
            $response = response()->json([  'data'=> ['id'=> $id ]]);
        }
        $this->CreateRegisterLog($response);
        return $response;
    }
}
