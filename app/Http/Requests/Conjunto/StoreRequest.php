<?php

namespace App\Http\Requests\Conjunto;

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
            'idCiudad'=>['required', 'numeric','exists:ciudades,id_ciudad'],
            'nombreConjunto' => ['required'],
            'direccion' => ['required'],
            'correo' => ['required'],
            'telefono' => ['required','numeric']
        ];
    }
}
