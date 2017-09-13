<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CreateRegisterLog;
use App\Models\Login;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class LoginController extends Controller
{
    use CreateRegisterLog;

    private $modelLogin = Login::class;


    function __construct()
    {
        $this->modelLogin = new Login();
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
        $idLogin = Authorizer::getResourceOwnerId();
        $this->modelLogin = $this->modelLogin->find($idLogin);

        if ( empty($contrasenia) && ($contrasenia != $confirmarContrasenia)){
            $numError = 400;
            $response = response()->json([ 'status'=>  $numError, 'message'=> trans('errors.'.$numError ) ], $numError);
        }
        else{
            $this->modelLogin->contrasenia = $contrasenia;
            $this->modelLogin->save();
            $response = response()->json(['success' => 'OK']);
        }

        //$this->CreateRegisterLog($response);
        return $response;
    }

}
