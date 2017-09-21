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
            'idMarcado' => ['required', 'numeric', 'exists:marcados,id_marcado'],
            'idNotificacion' => ['required', 'numeric', 'exists:notificaciones,id_notificacion'],
        ];
    }
}
