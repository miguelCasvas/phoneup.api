<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermisosRol extends Model
{
    protected $table = 'permisos_por_rol';
    protected $primaryKey = 'id_permisos_por_rol';
    protected $fillable = ['id_rol', 'id_permiso', 'id_modelo'];
}
