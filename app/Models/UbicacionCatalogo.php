<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UbicacionCatalogo extends Model
{
    //
    protected $table = 'ubicacion_catalogos';

    protected $primaryKey = 'id_ubicacion_catalogo';

    protected $fillable = ['nombre_ubicacion_catalogo', 'id_catalogo'];
}
