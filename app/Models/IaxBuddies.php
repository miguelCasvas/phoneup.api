<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IaxBuddies extends Model
{

    protected $table = 'iax_buddies';

    protected $primaryKey = 'name';

    protected $keyType = 'varchar';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'name', 'username', 'type', 'secret', 'md5secret', 'dbsecret', 'notransfer',
        'inkeys','outkey','auth','accountcode','amaflags','callerid','context',
        'defaultip','host','language','mailbox','deny','permit','qualify','disallow',
        'allow','ipaddr','port','regseconds',
    ];

    public function insercionExtension(array $params)
    {

        $parametrosDeInsercion = [
            'name'          => null,
            'username'      => null,
            'type'          => 'friend',
            'secret'        => '12345678+',
            'context'       => 'phoneup-iax',
            'host'          => 'dynamic',
            'ipaddr'        => '127.0.0.1',
            'port'          => '4569',
            'regseconds'    => '1096954152',
        ];

        $parametrosFinales = array_merge($parametrosDeInsercion, $params);

        $this->create($parametrosFinales)->toSql();

        return $this;
    }
}
