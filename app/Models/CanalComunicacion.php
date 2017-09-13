<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CanalComunicacion extends Model
{
    protected $table = 'canal_comunicaciones';

    protected $primaryKey = 'id_canal';

    protected $fillable = ['indicativo', 'canal', 'id_conjunto'];


}
