<?php

namespace App\Http\Requests\Catalogo;

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
            'nombreCatalogo' => ['required'],
            'idConjunto' => ['required', 'numeric','exists:conjuntos,id_conjunto']
        ];
    }
}
