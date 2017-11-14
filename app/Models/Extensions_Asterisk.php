<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use MongoDB\Driver\Query;

class Extensions_Asterisk extends Model
{
    protected $table = 'extensions';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'context',
        'exten',
        'priority',
        'app',
        'appdata',
        'data_visual'
    ];

    /**
     * @return $this
     */
    public function planDeMarcadoExtension()
    {
        $query =
            $this
                ->select('extensions.*')
                ->join('extensiones', 'extensions.exten', '=', 'extensiones.extension');

        return $query;
    }

}
