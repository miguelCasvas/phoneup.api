<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoSalida extends Model
{
    //
    protected $table = 'tipo_salidas';

    protected $primaryKey = 'id_tipo_salida';

    protected $fillable = ['nombre_tipo_salida', 'id_canal', 'id_notificacion'];
}
