<?php

namespace App\Http\Requests\Modelo;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\FormRequestToAPI\FormRequestToAPI;

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
            'nombreModelo' => ['required']
        ];
    }
}
