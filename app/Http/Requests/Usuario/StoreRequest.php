<?php

namespace App\Http\Requests\Usuario;

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
            'fechaNacimiento' => ['required', 'date_format:Y-m-d'],
            'identificacion' => ['required', 'min:7'],
            'nombres' => ['required'],
            'apellidos' => ['required'],
            'userName' => ['required'],
            'correo' => ['required', 'email'],
            'contrasenia' => ['required', 'confirmed'],
            'idRol' => ['required', 'numeric', 'exists:roles,id_rol'],
            'idConjunto' => ['required', 'numeric','exists:conjuntos,id_conjunto'],
        ];
    }

}
