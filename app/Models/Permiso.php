<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    //
    protected $table = 'permisos';

    protected $primaryKey = 'id_permiso';

    protected $fillable = ['nombre_permiso', 'id_roles', 'id_estado'];
}
