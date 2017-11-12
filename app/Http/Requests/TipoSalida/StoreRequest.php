<?php

namespace App\Http\Requests\TipoSalida;

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
            'nombreTipoSalida' => ['required'],
            'idCanal' => ['required', 'numeric', 'exists:canal_comunicaciones,id_canal'],
            //'idNotificacion' => ['required', 'numeric', 'exists:notificaciones,id_notificacion'],
        ];
    }
}
