<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


/**
 * Class ApiController
 *
 * @package App\Http\Controllers
 *
 * @SWG\Swagger(
 *     basePath="/v1",
 *     host=API_HOST_L5_SWAGGER,
 *     schemes={"http"},
 *     @SWG\Info(
 *         version="1.0.0",
 *         title=APP_NAME,
 *         description="Manual para consumo del API",
 *         @SWG\Contact(
 *              name="SOPORTE API",
 *              url="http://phoneup.estecnologia.co/soporte",
 *              email="soporte@phoneup.estecnologia.co"
 *         ),
 *     ),
 *     @SWG\Definition(
 *         definition="Error",
 *         required={"code", "message"},
 *         @SWG\Property(
 *             property="code",
 *             type="integer",
 *             format="int32"
 *         ),
 *         @SWG\Property(
 *             property="message",
 *             type="string"
 *         )
 *     ),
 *     @SWG\SecurityScheme(
 *       securityDefinition="acceso_bearer",
 *       type="apiKey",
 *       in="header",
 *       name="Authorization"
 *     ),
 *     @SWG\SecurityScheme(
 *       securityDefinition="Oauth2",
 *       type="oauth2",
 *       authorizationUrl="http://phoneup.api.com:8080/login",
 *       flow="implicit",
 *       scopes={}
 *     ),
 * )
 */
class ApiController extends Controller
{
    public function columnasSelect(array $params)
    {
        $columnasSelect = '*';

        if (array_key_exists('fields', $params)){
            $columnasSelect = explode(',', $params['fields']);
        }

        return $columnasSelect;
    }
}
