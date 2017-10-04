<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CanalComunicacion extends Model
{
    protected $table = 'canal_comunicaciones';

    protected $primaryKey = 'id_canal';

    protected $fillable = ['indicativo', 'canal', 'id_conjunto'];

    public function canalesPorConjunto(array $filters = [])
    {

        $query =
            $this
                ->select(
                'canal_comunicaciones.id_canal',
                'canal_comunicaciones.indicativo',
                'canal_comunicaciones.canal',
                'conjuntos.id_conjunto',
                'conjuntos.nombre_conjunto')
                ->join('conjuntos', 'canal_comunicaciones.id_conjunto', '=', 'conjuntos.id_conjunto');

        if (count($filters) > 0)
            $query = $query->where($filters);

        return $query;
    }
}
