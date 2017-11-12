<?php

namespace App\models;

use App\Events\CreacionExtension;
use App\Events\EliminacionExtension;
use Illuminate\Database\Eloquent\Model;

class Extension extends Model
{
    //
    protected $table = 'extensiones';

    protected $primaryKey = 'id_extension';

    protected $fillable = [
        'extension',
        'id_conjunto',
        'id_ubicacion_catalogo_1',
        'id_ubicacion_catalogo_2',
        'id_ubicacion_catalogo_3',
        'id_ubicacion_catalogo_4',
        'id_ubicacion_catalogo_5',
        'id_ubicacion_catalogo_6',
        'id_ubicacion_catalogo_7',
        'id_ubicacion_catalogo_8',
        'id_estado',
    ];

    protected $events = [
        'created' => CreacionExtension::class,
        'deleting' => EliminacionExtension::class,
    ];

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
