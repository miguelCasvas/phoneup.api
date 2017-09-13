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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->validarPermisos($this->modelLog->getTable(), 2);
        $data = $this->modelLog->all();
        return response()->json([ "data"=> $data ]);
    }

    /**
     * Insercion de datos en el log del sistem
     *
     * @param array $data
     */
    public function create(array $data)
    {
        $this->validarPermisos($this->modelLog->getTable(), 1);
        $this->modelLog->create($data);
    }
}
