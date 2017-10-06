<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    protected $table = "catalogos";

    protected $primaryKey = "id_catalogo";

    protected $fillable = ["nombre_Catalogo", "id_conjunto"];

    /**
     * Realiza busqueda de los catalogos creados por cada conjunto
     *
     * @return $this
     */
    public function catalogosPorConjunto()
    {
        $query =
            $this
                ->select('catalogos.*', 'conjuntos.nombre_conjunto')
                ->join('conjuntos', 'catalogos.id_conjunto', '=', 'conjuntos.id_conjunto')
                ->orderBy('conjuntos.id_conjunto', 'asc')
                ->orderBy('catalogos.nombre_catalogo', 'asc');

        return $query;
    }

    public function catalogosPor()
    {
        
    }
}
