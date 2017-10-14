<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CreateRegisterLog;
use App\Http\Requests\Extension\StoreRequest;
use App\models\Extension;
use Illuminate\Http\Request;

class ExtensionController extends Controller
{
    use CreateRegisterLog;
    private $modelExtension = Extension::class;
    private $usuarioController;

    function __construct(){

        $this->modelExtension  = new Extension();
        $this->usuarioController = new usuarioController();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->validarPermisos($this->modelExtension->getTable(), 1);
        $this->modelExtension->extension    = $request->get('extension');
        $this->modelExtension->id_conjunto    = $request->get('idConjunto');
        $this->modelExtension->id_estado    = $request->get('idEstado');
        $this->modelExtension->save();

        $response = response()->json(['data'=>$this->modelExtension]);
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
        $this->validarPermisos($this->modelExtension->getTable(), 2);
        $data = $this->modelExtension->find($id);
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
        $this->validarPermisos($this->modelExtension->getTable(), 2);
        $data = $this->modelExtension->all();
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
        $this->validarPermisos($this->modelExtension->getTable(), 3);
        $response = null;
        $this->modelExtension = $this->modelExtension->find($id);

        if ($this->modelExtension == null){
            abort(400, trans('errors.901'));
        }
        else{
            $this->modelExtension->extension    = $request->get('extension');
            $this->modelExtension->id_conjunto    = $request->get('idConjunto');
            $this->modelExtension->id_estado    = $request->get('idEstado');
            $this->modelExtension->save();
            $response = response()->json(['data'=>$this->modelExtension]);
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
        $this->validarPermisos($this->modelExtension->getTable(), 4);
        $response = null;
        $this->modelExtension = $this->modelExtension->find($id);

        if ($this->modelExtension == null){
            abort(400, trans('errors.901'));
        }else {
            $this->modelExtension->delete();
            $response = response()->json([  'data'=> ['id'=> $id ]]);
        }
        $this->CreateRegisterLog($response);
        return $response;
    }

    public function extensionesPorConjunto_usuario()
    {

    }
}
