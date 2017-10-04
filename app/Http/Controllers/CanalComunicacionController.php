<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CreateRegisterLog;
use App\Http\Requests\CanalComunicacion\StoreRequest;
use App\Models\CanalComunicacion;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;


class CanalComunicacionController extends Controller
{
    //
    use CreateRegisterLog;
    private $modelCanalComunicacion = CanalComunicacion::class;
    private $conjuntoController;
    private $usuarioController;

    function __construct(){

        $this->modelCanalComunicacion = new CanalComunicacion();
        $this->usuarioController = new usuarioController();
        $this->conjuntoController = new ConjuntoController();
    }

    /**
     * Store a newly created resource in storage for model CanalComunicacion.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        # Validar permisos
        $this->validarPermisos($this->modelCanalComunicacion->getTable(), 1);
        $response = null;

        $this->modelCanalComunicacion->indicativo    = $request->get('indicativo');
        $this->modelCanalComunicacion->canal    = $request->get('canal');
        $this->modelCanalComunicacion->id_conjunto    = $request->get('idConjunto');
        $this->modelCanalComunicacion->save();

        // $conjunto;
        //$this->modelCanalComunicacion->nombre_conjunto    = $conjunto;
        $response = response()->json(['data'=>$this->modelCanalComunicacion]);

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
        $this->validarPermisos($this->modelCanalComunicacion->getTable(), 2);
        $data = $this->modelCanalComunicacion->find($id);
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
        $this->validarPermisos($this->modelCanalComunicacion->getTable(), 2);
        $data = $this->modelCanalComunicacion->all();
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
        $this->validarPermisos($this->modelCanalComunicacion->getTable(), 3);
        $this->modelCanalComunicacion = $this->modelCanalComunicacion->find($id);
//
        if ($this->modelCanalComunicacion == null ){
            abort(400, trans('errors.901'));
        }
        else{
            $this->modelCanalComunicacion->indicativo    = $request->get('indicativo');
            $this->modelCanalComunicacion->canal    = $request->get('canal');
            $this->modelCanalComunicacion->id_conjunto    = $request->get('idConjunto');
            $this->modelCanalComunicacion->save();
            $response = response()->json(['data'=>$this->modelCanalComunicacion]);
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
        $this->validarPermisos($this->modelCanalComunicacion->getTable(), 4);
        $this->modelCanalComunicacion = $this->modelCanalComunicacion->find($id);

        if ($this->modelCanalComunicacion == null){
            abort(400, trans('errors.901'));
        }else {
            $this->modelCanalComunicacion->delete();
            $response = response()->json([  'data'=> ['id'=> $id ]]);
        }
        $this->CreateRegisterLog($response);
        return $response;
    }

    public function canalesPorConjunto(Request $request)
    {
        $filtros = array();

        foreach ($request->all() as $campo => $vlr) {

            if ($campo == 'id_conjunto')
                $campo = 'conjuntos.' . $campo;

            $filtros[] = [$campo, $vlr];
        };

        $data = $this->modelCanalComunicacion->canalesPorConjunto($filtros)->get()->toArray();
        return response()->json(["data" => $data]);
    }
}
