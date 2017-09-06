<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    protected $table = "catalogo";
    protected $primaryKey = "id_catalogo";
    public $timestamps = false;

    protected $fillable = ["nombre_Catalogo", "id_conjunto"];
}
