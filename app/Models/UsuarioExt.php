<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioExt extends Model
{
    //
    protected $table = 'usuario_extensiones';

    protected $primaryKey = 'id_usuario_extension';

    protected $fillable = ['id_extension', 'id_usuario'];
    
    
}
