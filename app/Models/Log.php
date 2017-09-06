<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class Log extends Model
{
    protected $table = "log";
    protected $primaryKey = "id_log";
    public $timestamps = false;

    protected $fillable = ["ip", "end_point", "accion", "request", "log", "id_usuario", "id_client"];

}
