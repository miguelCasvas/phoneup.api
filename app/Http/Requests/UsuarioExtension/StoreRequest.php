<?php

namespace App\Http\Requests\UsuarioExtension;

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
            'idExtension' => ['numeric', 'exists:extensiones,id_extension'],
            'idUsuario' => ['numeric', 'exists:usuarios,id_usuario'],
        ];
    }
}
