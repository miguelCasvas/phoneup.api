<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CreateRegisterLog;
use App\Http\Requests\Extension\StoreRequest;
use App\models\Extension;
use App\Models\Extensions_Asterisk;
use App\Models\IaxBuddies;
use Illuminate\Http\Request;

class ExtensionController extends Controller
{
    use CreateRegisterLog;
    private $modelExtension = Extension::class;
    private $modelExtensions_Asterisk = Extensions_Asterisk::class;
    private $usuarioController;

    function __construct(){

        $this->modelExtension  = new Extension();
        $this->usuarioController = new usuarioController();
        $this->modelExtensions_Asterisk = new Extensions_Asterisk();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $this->validarPermisos($this->modelExtension->getTable(), 1);

        foreach ($request->all() as $input => $vlr) {
            $column = snake_case($input);

            if (in_array($column, $this->modelExtension->getFillable())){
                $this->modelExtension->{$column} = $vlr;
            }
        }

        try{
            $this->modelExtension->save();
        }
        catch (\Exception $e){
            # Control de error Duplicidad de extension por columnas
            # extension | id_conjunto del modelo
            if($e->getCode() == 23000){
                $errors = ['extDupli' => 'Extension '.$request->get('extension').' asignada!'];
                return response()->json(['error' => trans('errors.903'), 'message' => $errors], 400);
            }

            abort($e->getCode(), $e->getMessage());
        }

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

    /**
     * @param Request $request
     * @param $idConjunto
     * @return \Illuminate\Http\JsonResponse
     */
    public function extensionesPorConjunto(Request $request, $idConjunto)
    {
        $porPagina = $request->get('porPagina') ?: 15;
        $data = $this->modelExtension->where('id_conjunto', $idConjunto)->paginate($porPagina);
        return response()->json($data);
    }

    /**
     * Creación del plan de marcado por extension
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function crearPlanDeMarcado(Request $request)
    {

        $this->modelExtensions_Asterisk =
            $this->modelExtensions_Asterisk->create([
                'context' => $request->get('context'),
                'exten' => $request->get('exten'),
                'app' => $request->get('app'),
                'appdata' => $request->get('appdata'),
            ]);

        return response()->json(['data' => $this->modelExtensions_Asterisk->toArray()]);

    }

    public function planDeMarcadoPorExtension(Request $request)
    {
        $data =
            $this
                ->modelExtensions_Asterisk
                ->where('extensions.exten', $request->get('extension'))
                ->orderBy('priority')
                ->get();

        return response()->json(['data' => $data]);
    }

    public function generarOrdenMarcado(Request $request, $idMarcado)
    {
        $this->modelExtensions_Asterisk =
            $this->modelExtensions_Asterisk->find($idMarcado);

        $this->modelExtensions_Asterisk->priority = $request->get('orden');
        $this->modelExtensions_Asterisk->save();

    }
}
