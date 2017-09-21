<?php

namespace App\Http\Requests\Extension;

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
            'extension'=>['required','numeric'],
            'idConjunto'=>['required','numeric','exists:conjuntos,id_conjunto'],
            'idEstado'=>['required','numeric','exists:estados,id_estado']
        ];
    }
}
