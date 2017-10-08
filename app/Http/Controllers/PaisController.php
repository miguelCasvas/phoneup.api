<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CreateRegisterLog;
use App\Http\Requests\Pais\StoreRequest;
use App\Models\Pais;
use Illuminate\Http\Request;

class PaisController extends Controller
{
    use CreateRegisterLog;

    /**
     * @var Departamento
     */
    private $modelPais = Pais::class;

    function __construct()
    {
        $this->modelPais = new Pais();
    }

    public function index()
    {
        $this->validarPermisos($this->modelPais->getTable(), 2);

        $data = $this->modelPais->select('*')->orderBy('nombre_pais', 'asc')->get();
        $response = response()->json([ 'data' => $data ]);

        # Creacion en modelo log
        $this->CreateRegisterLog($response);
        return $response;
    }
    
    public function store(StoreRequest $request)
    {
        $this->validarPermisos($this->modelPais->getTable(), 1);

        $this->modelPais->nombre_pais = $request->get('nombrePais');
        $this->modelPais->nombre_oficial_pais = $request->get('nombreOficialPais');
        $this->modelPais->iso3 = $request->get('iso3');
        $this->modelPais->iso2 = $request->get('iso2');
        $this->modelPais->faostat = $request->get('faostat');
        $this->modelPais->gaul = $request->get('gaul');
        $this->modelPais->codDian = $request->get('codDian');

        $this->modelPais->save();
        $response = response()->json($this->modelPais);

        # Creacion en modelo log
        $this->CreateRegisterLog($response);
        return $response;
    }

    public function update(StoreRequest $request, $id)
    {
        $this->validarPermisos($this->modelPais->getTable(), 3);
        $this->modelPais = $this->modelPais->find($id);

        if ($this->modelPais == null)
            abort(400, trans('error.901'));

        $this->modelPais->nombre_pais = $request->get('nombrePais');
        //$this->modelPais->nombre_oficial_pais = $request->get('nombreOficialPais');
        $this->modelPais->iso3 = $request->get('iso3');
        $this->modelPais->iso2 = $request->get('iso2');
        $this->modelPais->faostat = $request->get('faostat');
        $this->modelPais->gaul = $request->get('gaul');
        $this->modelPais->codDian = $request->get('codDian');

        $this->modelPais->save();
        $response = response()->json($this->modelPais);

        # Creacion en modelo log
        $this->CreateRegisterLog($response);
        return $response;

    }

    public function destroy(Request $request, $id)
    {
        $this->validarPermisos($this->modelPais->getTable(), 4);
        $this->modelPais = $this->modelPais->find($id);

        if ($this->modelPais == null)
            abort(400, trans('errors.901'));

        $response = response()->json(['data' => $id]);
        $this->modelPais->delete();
        $this->CreateRegisterLog($response);

        return $response;
    }
}
