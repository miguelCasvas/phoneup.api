<?php

namespace App\Http\Requests\UbicacionCatalogo;

use App\Http\Requests\FormRequestToAPI\FormRequestToAPI;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequestToAPI
{
     /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombreUbicacionCatalogo' => ['required'],
            'idCatalogo' => ['required','numeric','exists:catalogos,id_catalogo']
        ];
    }
}
