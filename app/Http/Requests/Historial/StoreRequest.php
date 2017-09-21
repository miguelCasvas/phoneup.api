<?php

namespace App\Http\Requests\Historial;

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
            'accion'=>['required'],
            'idModulo'=>['required','numeric','exists:modulos,id_modulo'],
            'idUsuarioM'=>['required','numeric','exists:usuarios,id_usuario']
        ];
    }
}
