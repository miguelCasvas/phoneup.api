<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class logController extends Controller
{

    private $modelLog = Log::class;

    function __construct()
    {
        $this->modelLog = new Log();

    }

    /**
     * Insercion de datos en el log del sistem
     *
     * @param array $data
     */
    public function create(array $data)
    {
        $this->modelLog->create($data);
    }
}
