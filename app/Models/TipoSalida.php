<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoSalida extends Model
{
    //
    protected $table = 'tipo_salidas';

    protected $primaryKey = 'id_tipo_salida';

    protected $fillable = ['nombre_tipo_salida', 'id_canal', 'id_notificacion', 'metodo', 'metodo_params'];


    public function listadoTposSalidaRelacionadosACanal()
    {
        $query =
            $this
                ->select(
                    'canal_comunicaciones.canal',
                    'tipo_salidas.nombre_tipo_salida',
                    'tipo_salidas.metodo',
                    'tipo_salidas.metodo_params'
                )
                ->join(
                    'canal_comunicaciones',
                    'canal_comunicaciones.id_canal', '=', 'tipo_salidas.id_canal');

        return $query;
    }
}
