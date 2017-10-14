<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Extension extends Model
{
    //
    protected $table = 'extensiones';

    protected $primaryKey = 'id_extension';

    protected $fillable = ['extension', 'id_conjunto', 'id_estado'];

    /**
     * Filtrado de extensiones por estado
     *
     * @param $query
     * @param int $estado [inicializaco en 1 Activo]
     * @return mixed
     */
    public function scopeEstado($query, $estado = 1)
    {
        return $query->where('id_estado', $estado);
    }

    /**
     * Busqueda relacional con tabla usuario_extensiones
     * para verificar usuarios con extension asignada
     *
     * @param $query
     * @return mixed
     */
    public function scopeExtensionesDisponibles($query)
    {
        return $query->leftJoin('usuario_extensiones', 'extensiones.id_extension', '=', 'usuario_extensiones.id_extension');
    }

}
