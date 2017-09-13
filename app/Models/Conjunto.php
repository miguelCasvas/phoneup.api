<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conjunto extends Model
{
    protected $table = "conjuntos";
    protected $primaryKey = "id_conjunto";
    protected $fillable = ["nombre_conjunto", "direccion", "email", "telefono", "complemento", "imagen", "id_ciudad"];

}
