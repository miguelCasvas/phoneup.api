<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CreateRegisterLog;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class usuarioController extends Controller
{

    use CreateRegisterLog;

    /**
     * @var Usuario
     */
    private $modelUsuario = Usuario::class;
    private $userController;

    public function demo()
    {
        return json_encode(['hola' => 'muno']);
    }

    function __construct(){

        $this->modelUsuario = new Usuario();
        $this->userController = new UserController();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (
            $this->userController->validarContrasenia(
                $request->get('contrasenia'),
                    $request->get('confirmarContrasenia'))
            )
        {
            $numError = 400;
            return response()->json([ 'status'=>  $numError, 'message'=> trans('errors.'.$numError ) ], $numError);
        }

        $this->modelUsuario->nombre_usuario     = $request->get('nombreUsuario');
        $this->modelUsuario->apellidos          = $request->get('apellidos');
        $this->modelUsuario->email              = $request->get('correo');
        $this->modelUsuario->identificacion     = $request->get('identificacion');
        $this->modelUsuario->fecha_nacimiento   = $request->get('fechaNacimiento');
        $this->modelUsuario->id_role            = 1;
        $this->modelUsuario->id_conjunto        = 1;
        $this->modelUsuario->id_canal           = 1;
        $this->modelUsuario->save();

        # Creacion en modelo de user
        $this->userController->store($request, $this->modelUsuario->id_usuario);
        $response = response()->json($this->modelUsuario);

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
        return json_encode($this->modelUsuario->find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = null;
        $this->modelUsuario = $this->modelUsuario->find($id);

        if ($this->modelUsuario == null){
            $numError = 400;

            $response = response()->json([ 'status'=>  $numError, 'message'=> trans('errors.'.$numError ) ], $numError);
        }
        else{
            $this->modelUsuario->nombre_usuario = $request->get('nombreUsuario');
            $this->modelUsuario->apellidos = $request->get('apellidos');
            $this->modelUsuario->email = $request->get('correo');
            $this->modelUsuario->identificacion = $request->get('identificacion');
            $this->modelUsuario->fecha_nacimiento = $request->get('fechaNacimiento');
            $this->modelUsuario->save();

            $response = response()->json($this->modelUsuario);
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
        $this->modelUsuario->find($id)->delete();

        $response = json_encode(['eliminado ' . $id]);

        $this->CreateRegisterLog($response);
        return $response;

    }

}
