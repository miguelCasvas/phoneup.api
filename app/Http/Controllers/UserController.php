<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CreateRegisterLog;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class UserController extends Controller
{
    use CreateRegisterLog;

    private $modelUser = User::class;


    function __construct()
    {
        $this->modelUser = new User();
    }


    public function store(Request $request, $idUsuario = null)
    {

        $this->modelUser->name = $request->get('userName');
        $this->modelUser->email = $request->get('correo');
        $this->modelUser->password = $request->get('contrasenia');
        $this->modelUser->is_estado_contrasenia = 1;
        $this->modelUser->id_usuario = $idUsuario;

        $this->modelUser->save();

        return $this->modelUser;
    }

    public function validarLogin(Request $request)
    {

        $response = Response::json(Authorizer::issueAccessToken());

        if($response->error == "invalid_credentials"){
            $this->modelUser = $this->modelUser->busquedaPorEmail($response->get('username'));

            if ($this->modelUser != false){
                $this->modelUser->errorContrasenia();
            }

        }

        return $response;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function contrasenia(Request $request)
    {
        $response = null;
        $contrasenia = trim($request->get('contrasenia'));
        $confirmarContrasenia = trim($request->get('confirmarContrasenia'));

        $idUser = Authorizer::getResourceOwnerId();
        $this->modelUser = $this->modelUser->find($idUser);

        if ( empty($contrasenia) && ($this->validarContrasenia($contrasenia ,$confirmarContrasenia))){
            $numError = 400;
            $response = response()->json([ 'status'=>  $numError, 'message'=> trans('errors.'.$numError ) ], $numError);
        }
        else{
            $this->modelUser->password = $contrasenia;
            $this->modelUser->save();
            $response = response()->json(['success' => 'OK']);
        }

        $this->CreateRegisterLog($response);
        return $response;
    }

    public function validarContrasenia ($contrasenia, $confirmarContrasenia){
        return ($contrasenia != $confirmarContrasenia);
    }
}
