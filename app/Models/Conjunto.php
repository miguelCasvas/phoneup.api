<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conjunto extends Model
{
    protected $table = "conjunto";
    protected $primaryKey = "id_conjunto";
    public $timestamps = false;

    protected $fillable = ["nombre_conjunto", "direccion", "email", "telefono", "complemento", "imagen", "id_ciudad", "id_catalogo", "id_usuario"];

}
