<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $miUsuario;

    function __construct()
    {
    }

    protected function  setMiUsuario()
    {

        $objUser = new Usuario();
        $this->miUsuario = $objUser->infoGlobalUsuario(\Auth::user()->id_usuario);

        return $this;
    }

    protected function validarPermisos($modelo, $idPermiso)
    {
        # Cargue de informacion del usuario
        $this->setMiUsuario();
        $acceso = false;

        # Consulta de permisos del usuario sobre la accion
        $this->miUsuario->get('permisos')->each(function($arrPermiso) use($modelo, $idPermiso, &$acceso){

            if ($arrPermiso['id_permiso'] == $idPermiso &&
                $arrPermiso['nombre_modelo'] == $modelo){
                $acceso = true;
            }

        });

        if ($acceso === false)
            abort(400, trans('errors.902'));
    }
}
