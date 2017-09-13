<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Extension extends Model
{
    //
    protected $table = 'extensiones';

    protected $primaryKey = 'id_extension';

    protected $fillable = ['extension', 'id_conjunto', 'id_estado'];
}
