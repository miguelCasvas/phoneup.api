<?php

namespace App\Http\Requests\PermisosRol;

use App\Http\Requests\FormRequestToAPI\FormRequestToAPI;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequestToAPI
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'idRol' => ['required','numeric','exists:roles,id_rol'],
            'idPermiso' => ['required', 'numeric', 'exists:permisos,id_permiso'],
            'idModelo' => ['required', 'numeric', 'exists:modelos,id_modelo'],
        ];
    }
}
