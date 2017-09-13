<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    protected $table = "catalogos";

    protected $primaryKey = "id_catalogo";

    protected $fillable = ["nombre_Catalogo", "id_conjunto"];
}
