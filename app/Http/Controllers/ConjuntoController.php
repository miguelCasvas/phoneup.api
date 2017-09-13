<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CreateRegisterLog;
use App\Http\Requests\Conjunto\StoreRequest;
use App\Models\Conjunto;
use Illuminate\Http\Request;

class ConjuntoController extends Controller
{
    use CreateRegisterLog;
    /**
     * @var Usuario
     */
    private $modelConjunto = Conjunto::class;

    //private $conjuntoController;
    function __construct()
    {
        $this->modelConjunto = new Conjunto();
    }

    /**
     * Store a newly created resource in storage. craete conjunto
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->validarPermisos($this->modelConjunto->getTable(), 1);
        $this->modelConjunto->nombre_conjunto     = $request->get('nombreConjunto');
        $this->modelConjunto->direccion     = $request->get('direccion');
        $this->modelConjunto->email     = $request->get('correo');
        $this->modelConjunto->telefono     = $request->get('telefono');
        $this->modelConjunto->complemento     = $request->get('complemento');
        $this->modelConjunto->imagen     = $request->get('imagen');
        $this->modelConjunto->id_ciudad     = $request->get('idCiudad');
        $this->modelConjunto->save();
        $response = response()->json($this->modelConjunto);
        # Creacion en modelo log
        $this->CreateRegisterLog($response);
        return $response;
    }

    /**
     * Display the specified resource. get conjunto
     *
     * @param  \App\Models\Conjunto  $conjunto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $this->validarPermisos($this->modelConjunto->getTable(), 2);
        $data = $this->modelConjunto->find($id);
        $response = response()->json([ 'data'=> $data ]);
        # Creacion en modelo log
        //$this->CreateRegisterLog($response);
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
        $this->validarPermisos($this->modelConjunto->getTable(), 2);
        $data = $this->modelConjunto->all();
        return response()->json([ "data"=> $data ]);
    }


    /**
     * Update the specified resource in storage. put conjunto
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conjunto  $conjunto
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, $id)
    {
        //
        $this->validarPermisos($this->modelConjunto->getTable(), 3);
        $response = null;
        $this->modelConjunto = $this->modelConjunto->find($id);
//
        if ($this->modelConjunto == null ){
            abort(400, trans('errors.901'));
        }
        else{
            $this->modelConjunto->nombre_conjunto     = $request->get('nombreConjunto');
            $this->modelConjunto->direccion     = $request->get('direccion');
            $this->modelConjunto->email     = $request->get('correo');
            $this->modelConjunto->telefono     = $request->get('telefono');
            $this->modelConjunto->complemento     = $request->get('complemento');
            $this->modelConjunto->imagen     = $request->get('imagen');
            $this->modelConjunto->id_ciudad     = $request->get('idCiudad');
            $this->modelConjunto->save();
            $response = response()->json(['data'=>$this->modelConjunto]);
        }

        //$this->CreateRegisterLog($response);
        return $response;
    }

    /**
     * Remove the specified resource from storage. delete conjunto
     *
     * @param  \App\Models\Conjunto  $conjunto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->validarPermisos($this->modelConjunto->getTable(), 4);
        $response = null;
        $this->modelConjunto = $this->modelConjunto->find($id);

        if ($this->modelConjunto == null){
            abort(400, trans('errors.901'));
        }else {
            $this->modelConjunto->delete();
            $response = response()->json([  'data'=> ['id'=> $id ]]);
        }
        //$this->CreateRegisterLog($response);
        return $response;
    }


}
