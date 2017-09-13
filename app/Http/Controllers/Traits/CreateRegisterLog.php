<?php
namespace App\Http\Controllers\Traits;

use App\Models\Log;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

trait CreateRegisterLog
{
    public function CreateRegisterLog($response)
    {
        if (env('API_LOG', false) == true){

            $data =
                [
                    'end_point' => get_class($this),
                    'accion' => request()->getMethod(),
                    'request' => request()->fullUrl(),
                    'log' => $response,
                    'id_usuario' => Authorizer::getResourceOwnerId(),
                    'id_cliente' => Authorizer::getClientId()
                ];

            Log::create($data);

        }
    }
}