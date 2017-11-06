<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CreateRegisterLog;
use App\Http\Requests\Usuario\StoreRequest;
use App\Http\Requests\Usuario\UpdateRequest;
use App\Http\Requests\Usuario\UpdateRequestPW;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class usuarioController extends Controller
{

    use CreateRegisterLog;

    /**
     * @var Usuario
     */
    private $modelUsuario = Usuario::class;

    function __construct(){
        $this->modelUsuario = new Usuario();
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
        $this->validarPermisos($this->modelUsuario->getTable(), 1);

        $this->modelUsuario->nombres            = $request->get('nombres');
        $this->modelUsuario->apellidos          = $request->get('apellidos');
        $this->modelUsuario->identificacion     = $request->get('identificacion');
        $this->modelUsuario->fecha_nacimiento   = $request->get('fechaNacimiento');
        $this->modelUsuario->email              = $request->get('correo');
        $this->modelUsuario->id_rol             = $request->get('idRol');
        $this->modelUsuario->id_conjunto        = $request->get('idConjunto');
        $this->modelUsuario->password           = bcrypt($request->get('identificacion'));
        $this->modelUsuario->save();

        $response = response()->json($this->modelUsuario);

        # Creacion en modelo log
        $this->CreateRegisterLog($response);

        return $response;
    }

    /**
     * Busqueda de usuario por id
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # Validar permisos
        $this->validarPermisos($this->modelUsuario->getTable(), 2);

        $busqueda = $this->modelUsuario->getFiltrado($this->miUsuario->get('id_rol'))->all();
        $data = ['data' => $busqueda];
        $response = response()->json($data);

        $this->CreateRegisterLog($response);
        return $response;
    }

    /**
     * Busqueda de usuario por id
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        # Validar permisos
        $this->validarPermisos($this->modelUsuario->getTable(), 2);
        $busqueda = $this->modelUsuario->infoGlobalUsuario($id);

        if ($busqueda == null)
            $data = ['data' => ''];
        else
            $data = ['data' => $busqueda];


        $response = response()->json($data);

        $this->CreateRegisterLog($response);
        return $response;
    }

    private function updateModelUsuario(Request $request, $id)
    {
        $this->modelUsuario = $this->modelUsuario->find($id);

        $this->modelUsuario->nombres            = $request->get('nombres');
        $this->modelUsuario->apellidos          = $request->get('apellidos');
        $this->modelUsuario->email              = $request->get('correo');
        $this->modelUsuario->identificacion     = $request->get('identificacion');
        $this->modelUsuario->fecha_nacimiento   = $request->get('fechaNacimiento');
        $this->modelUsuario->id_rol             = $request->get('idRol');
        $this->modelUsuario->id_conjunto        = $request->get('idConjunto');

        if (empty($request->get('password')) == false)
            $this->modelUsuario->password = $request->get('password');

        $this->modelUsuario->save();

        $response = response()->json($this->modelUsuario);
        $this->CreateRegisterLog($response);

        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        # Validar permisos
        $response = null;
        $this->validarPermisos($this->modelUsuario->getTable(), 3);

        return
            $this->updateModelUsuario($request, $id);
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
        $this->validarPermisos($this->modelUsuario->getTable(), 4);

        $this->modelUsuario = $this->modelUsuario->find($id);

        if ($this->modelUsuario == null){
            abort(400, trans('errors.901'));
        }

        $this->modelUsuario->delete();

        $response = response()->json([  'data'=> ['id'=> $id ]]);

        $this->CreateRegisterLog($response);
        return $response;
    }

    public function getMiUsuario()
    {
        # Validar permisos
        $this->validarPermisos($this->modelUsuario->getTable(), 5);

        $this->setMiUsuario();
        $response = \response()->json(['data' => $this->miUsuario]);

        return $response;
    }

    public function edicionMiUsuario(UpdateRequest $request, $id)
    {
        # Validar permisos
        $this->validarPermisos($this->modelUsuario->getTable(), 6);

        if ($id != \Auth::user()->id_usuario)
            abort(400, trans('errors.902'));

        return
            $this->updateModelUsuario($request, $id);
    }

    /**
     * Actualizacion Contraseña
     *
     * @param Request $request
     * @param $idUsuario
     * @return \Illuminate\Http\JsonResponse
     */
    public function cambioContrasenia(UpdateRequestPW $request, $idUsuario)
    {

        $this->modelUsuario = $this->modelUsuario->find($idUsuario);
        $this->modelUsuario->password = $request->get('contrasenia');
        $this->modelUsuario->save();

        return \response()->json(['data' => $this->modelUsuario]);
    }

}
