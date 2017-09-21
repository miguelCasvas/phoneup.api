<?php

namespace App\Http\Requests\CanalComunicacion;

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
            'indicativo' => ['required'],
            'canal' => ['required'],
            'idConjunto' => ['required', 'numeric','exists:conjuntos,id_conjunto']
        ];
    }
}
