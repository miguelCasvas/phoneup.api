<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Login extends Model
{
    protected $table = "login";
    protected $primaryKey = "id_login";
    public $timestamps = false;

    protected $fillable = ["usuario",  "contrasenia",  "contador_contrasenia",  "is_estado_contrasenia",  "id_usuario",  "id_estado_usuario"];

    /**
     * Encriptacion de contraseña antes de generar Insercion o actualizacion de registro
     *
     * @param $value
     */
    public function setContraseniaAttribute($value)
    {
        $this->attributes['contrasenia'] = Hash::make($value);
    }

}
