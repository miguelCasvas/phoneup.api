<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    //
    protected $table = 'historiales';

    protected $primaryKey = 'id_historial';

    protected $fillable = ['accion', 'id_usuario', 'id_usuario_m','id_modulo'];
}
