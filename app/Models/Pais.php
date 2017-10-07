<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = "paises";
    protected $primaryKey = "id_pais";
    protected $fillable = ["nombre_pais", "nombre_oficial_pais", "iso3", "iso2", "faostat", "gaul", "codDian"];

}
