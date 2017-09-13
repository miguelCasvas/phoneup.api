<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class Log extends Model
{
    protected $table = "logs";

    protected $primaryKey = "id_log";

    protected $fillable = ["end_point", "accion", "request", "log", "id_usuario", "id_cliente"];

}
