<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CreateRegisterLog;
use App\Models\Conjunto;
use Illuminate\Http\Request;

class ConjuntoController extends Controller
{
    use CreateRegisterLog;
    /**
     * @var Usuario
     */
    private $modelConjunto = Conjunto::class;
    //private $conjuntoController;
    function __construct()
    {
        $this->modelConjunto = new Conjunto();
        //$this->userController = new UserController();
    }

    /**
     * Store a newly created resource in storage. craete conjunto
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->modelConjunto->nombre_conjunto     = $request->get('nombreConjunto');
        $this->modelConjunto->direccion     = $request->get('direccion');
        $this->modelConjunto->email     = $request->get('correo');
        $this->modelConjunto->telefono     = $request->get('telefono');
        $this->modelConjunto->complemento     = $request->get('complemento');
        $this->modelConjunto->imagen     = $request->get('imagen');
        $this->modelConjunto->id_ciudad     = $request->get('id_ciudad');
        $this->modelConjunto->id_catalogo     = $request->get('id_catalogo');
        $this->modelConjunto->id_usuario     = $request->get('id_usuario');
        $this->modelConjunto->save();
        $response = response()->json($this->modelConjunto);
        # Creacion en modelo log
        $this->CreateRegisterLog($response);
        return $response;
    }

    /**
     * Display the specified resource. get conjunto
     *
     * @param  \App\Models\Conjunto  $conjunto
     * @return \Illuminate\Http\Response
     */
    public function show(Conjunto $conjunto)
    {
        //
    }



    /**
     * Update the specified resource in storage. put conjunto
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conjunto  $conjunto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conjunto $conjunto)
    {
        //
    }

    /**
     * Remove the specified resource from storage. delete conjunto
     *
     * @param  \App\Models\Conjunto  $conjunto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conjunto $conjunto)
    {
        //
    }
}
