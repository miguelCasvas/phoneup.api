<?php

namespace App\Http\Requests\Departamento;

use App\Http\Requests\FormRequestToAPI\FormRequestToAPI;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequestToAPI
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombreDepartamento' => ['required'],
            'idPais' => ['required', 'numeric', 'exists:paises,id_pais']
        ];
    }
}
