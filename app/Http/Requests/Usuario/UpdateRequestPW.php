<?php

namespace App\Http\Requests\Usuario;

use App\Http\Requests\FormRequestToAPI\FormRequestToAPI;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestPW extends FormRequestToAPI
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'contrasenia' => ['required','min:8','confirmed'],
        ];
    }
}
