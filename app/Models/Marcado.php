<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marcado extends Model
{
    //
    protected $table = 'marcados';

    protected $primaryKey = 'id_marcado';

    protected $fillable = ['secuencia_marcado', 'id_extension', 'id_tipo_salida'];
}
