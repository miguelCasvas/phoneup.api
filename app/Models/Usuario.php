<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = "usuarios";

    protected $primaryKey = "id_usuario";

    protected $fillable = ["nombres", "apellidos", "email", "identificacion", "fecha_nacimiento", "id_rol", "id_conjunto"];

    /**
     * Relacion con modelo canal_comunicaciones Uno a Muchos [usuarios(1) --fk--> canal_comunicaciones(*)]
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function canalComunicacion()
    {
        return $this->hasMany(\App\Models\CanalComunicacion::class, 'id_usuario', 'id_usuario');
    }

    public function getFiltrado($idRol,$id=null)
    {
        $dataR = [];

        if ($idRol == 1){
            if ($id == null)
                $dataR = Usuario::all();
            else
                $dataR = Usuario::find($id);
        }
        else{
            $condiciones[0] = ['id_rol','!=',1];

            if ($id != null)
                $condiciones[1] = ['id_usuario','=',$id];

            $dataR = Usuario::where($condiciones);
        }

        return $dataR;
    }
}
