<?php

namespace App\Http\Requests\Marcado;

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
            'secuenciaMarcado'=>['required','numeric'],
            'idExtension'=>['required','numeric','exists:extensiones,id_extension'],
            'idTipoSalida'=>['required','numeric','exists:tipo_salidas,id_tipo_salida']
        ];
    }
}
