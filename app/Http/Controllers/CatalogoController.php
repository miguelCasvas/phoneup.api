<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CreateRegisterLog;
use App\Http\Requests\Catalogo\StoreRequest;
use App\Models\Catalogo;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    use CreateRegisterLog;

    /**
     * @var Catalogo|string
     */
    private $modelCatalogo = Catalogo::class;
    private $usuarioController;

    function __construct()
    {
        $this->modelCatalogo = new Catalogo();
        $this->usuarioController = new usuarioController();
    }

    /**
     * Creacion de registro Catalogo
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->validarPermisos($this->modelCatalogo->getTable(), 1);
        $this->modelCatalogo->nombre_Catalogo = $request->get('nombreCatalogo');
        $this->modelCatalogo->id_conjunto = $request->get('idConjunto');
        $this->modelCatalogo->save();

        $response = response()->json($this->modelCatalogo);
        $this->CreateRegisterLog($response);
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catalogo  $catalogo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->validarPermisos($this->modelCatalogo->getTable(), 2);
        $data = $this->modelCatalogo->find($id);
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
        $this->validarPermisos($this->modelCatalogo->getTable(), 2);
        $data = $this->modelCatalogo->all();
        return response()->json([ "data"=> $data ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalogo  $catalogo
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, $id)
    {
        $this->validarPermisos($this->modelCatalogo->getTable(), 3);
        $response = null;
        $this->modelCatalogo = $this->modelCatalogo->find($id);

        if ($this->modelCatalogo == null){
            abort(400, trans('errors.901'));
        }
        else{
            $this->modelCatalogo->nombre_Catalogo = $request->get('nombreCatalogo');
            $this->modelCatalogo->id_conjunto = $request->get('idConjunto');
            $this->modelCatalogo->save();
            $response = response()->json(['data'=>$this->modelCatalogo]);
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
        $this->validarPermisos($this->modelCatalogo->getTable(), 4);
        $response = null;
        $this->modelCatalogo = $this->modelCatalogo->find($id);

        if ($this->modelCatalogo == null){
            abort(400, trans('errors.901'));
        }else {
            $this->modelCatalogo->delete();
            $response = response()->json([  'data'=> ['id'=> $id ]]);
        }
        $this->CreateRegisterLog($response);
        return $response;
    }


}
