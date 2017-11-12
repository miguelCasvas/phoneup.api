<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoSalida extends Model
{
    //
    protected $table = 'tipo_salidas';

    protected $primaryKey = 'id_tipo_salida';

    protected $fillable = ['nombre_tipo_salida', 'id_canal', 'id_notificacion', 'metodo', 'metodo_params'];

    /**
     * Realiza busqueda de tipos de solicitudes ligadas a un canal
     *
     * @return $this
     */
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
                    'tipo_salidas.id_canal', '=', 'canal_comunicaciones.id_canal');

        return $query;
    }

    /**
     * Realiza busqueda de tipos de solicitudes ligadas a un canal y dicho canal a un conjunto
     *
     * @return $this
     */
    public function listadoTposSalidaRelacionadosCanal_Conjuntos(array $filtros = [])
    {

        $query =
            $this
                ->listadoTposSalidaRelacionadosACanal()
                ->join('conjuntos', 'canal_comunicaciones.id_conjunto', '=', 'conjuntos.id_conjunto');

        if (empty($filtros) == false)
            $query = $query->where($filtros);

        return $query;
    }
}
