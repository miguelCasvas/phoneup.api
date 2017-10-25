<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CreateRegisterLog;
use App\Http\Requests\Conjunto\StoreRequest;
use App\Models\Conjunto;
use Illuminate\Http\Request;

class ConjuntoController extends ApiController
{
    use CreateRegisterLog;

    /**
     * @var Usuario
     */
    private $modelConjunto = Conjunto::class;

    function __construct()
    {
        $this->modelConjunto = new Conjunto();
    }

    /**
     * Store a newly created resource in storage. craete conjunto
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $this->validarPermisos($this->modelConjunto->getTable(), 1);
        $this->modelConjunto->nombre_conjunto     = $request->get('nombreConjunto');
        $this->modelConjunto->direccion     = $request->get('direccion');
        $this->modelConjunto->email     = $request->get('correo');
        $this->modelConjunto->telefono     = $request->get('telefono');
        $this->modelConjunto->complemento     = $request->get('complemento');
        $this->modelConjunto->imagen     = $request->get('imagen');
        $this->modelConjunto->id_ciudad     = $request->get('idCiudad');
        $this->modelConjunto->save();
        $response = response()->json($this->modelConjunto);
        # Creacion en modelo log
        $this->CreateRegisterLog($response);
        return $response;
    }

    /**
     * @SWG\Get(
     *     path="/conjuntos/{id}",
     *     summary="Busqueda de conjunto por id",
     *     description="Retorna listado de conjuntos.",
     *     operationId="api.conjuntos.index",
     *     produces={"application/json"},
     *     tags={"CONJUNTOS"},
     *     @SWG\Parameter(
     * 			name="id",
     * 			in="path",
     * 			required=true,
     * 			type="string",
     * 			description="Id del conjunto a buscar",
     * 		),
     *     @SWG\Parameter(
     *         name="sort",
     *         in="query",
     *         description="Etiqueta para ordenamiento <br>(-) Descendente <br>Ascendente <br>del listado Ej. -nombre_conjunto,direccion",
     *         required=false,
     *         type="string",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Si la peticion es correcta devolvera un listado de los conjuntons del sistema"
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized Unauthenticated.",
     *     ),
     *     security={
     *       {"acceso_bearer": {}}
     *     }
     * )
     */

    /**
     * Display the specified resource. get conjunto
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        //
        $this->validarPermisos($this->modelConjunto->getTable(), 2);
        $data = $this->modelConjunto->find($id);
        $response = response()->json([ 'data'=> $data ]);
        # Creacion en modelo log
        //$this->CreateRegisterLog($response);
        return $response;
    }

    /**
     * @SWG\Get(
     *     path="/conjuntos",
     *     summary="Lectura Conjuntos activos del sistema",
     *     description="Retorna listado de conjuntos.",
     *     operationId="api.conjuntos.index",
     *     produces={"application/json"},
     *     tags={"CONJUNTOS"},
     *     @SWG\Parameter(
     *         name="fields",
     *         in="query",
     *         description="Parametro para seleccion de campos a retornar <br> Ej. id_conjunto, nombre_conjunto",
     *         required=false,
     *         type="string",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="sort",
     *         in="query",
     *         description="Etiqueta para ordenamiento <br>(-) Descendente <br>Ascendente <br>del listado <br>Ej. -nombre_conjunto,direccion",
     *         required=false,
     *         type="string",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="id_conjunto",
     *         in="query",
     *         description="Parametro Ejemplo de filtrado, el vlr puede iniciar por <br>(> May| < Men| >= | <=)",
     *         required=false,
     *         type="string",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="page",
     *         in="query",
     *         description="Parametro que indica la hoja de la paginacion",
     *         required=false,
     *         type="integer",
     *         @SWG\Items(type="integer"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="porPagina",
     *         in="query",
     *         description="Parametro que indica la cantidad de registros por hoja en la paginación",
     *         required=false,
     *         type="integer",
     *         @SWG\Items(type="integer"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Parameter(
     *         name="embebed",
     *         in="query",
     *         description="...",
     *         required=false,
     *         type="string",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Si la peticion es correcta devolvera un listado de los conjuntos del sistema"
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized Unauthenticated.",
     *     ),
     *     security={
     *       {"acceso_bearer": {}}
     *     }
     * )
     */

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function index(Request $request)
    {
        $this->validarPermisos($this->modelConjunto->getTable(), 2);
        $porPagina = $request->get('porPagina') ?: 15;
        $data = $this->modelConjunto->paginate($porPagina);
        return response()->json($data);
    }

    /**
     * @SWG\Put(
     *     path="/conjuntos/{id}",
     *     tags={"CONJUNTOS"},
     *     operationId="updateConjunto",
     *     summary="Actualiza conjunto por Id",
     *     description="",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     * 			name="id",
     * 			in="path",
     * 			required=true,
     * 			type="string",
     * 			description="Id del conjunto a editar",
     * 		),
     *      @SWG\Response(
     *         response=200,
     *         description="Si la peticion es correcta devolvera un objeto tipo JSON"
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Invalid ID supplied",
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Not found",
     *     ),
     *     @SWG\Response(
     *         response=405,
     *         description="Validation exception",
     *     ),
     *     security={{"acceso_bearer":{}}}
     * )
     */

    /**
     * Update the specified resource in storage. put conjunto
     *
     * @param StoreRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|null
     *
    */
    public function update(StoreRequest $request, $id)
    {
        $this->validarPermisos($this->modelConjunto->getTable(), 3);
        $response = null;
        $this->modelConjunto = $this->modelConjunto->find($id);
        if ($this->modelConjunto == null ){
            abort(400, trans('errors.901'));
        }
        else{
            $this->modelConjunto->nombre_conjunto     = $request->get('nombreConjunto');
            $this->modelConjunto->direccion     = $request->get('direccion');
            $this->modelConjunto->email     = $request->get('correo');
            $this->modelConjunto->telefono     = $request->get('telefono');
            $this->modelConjunto->complemento     = $request->get('complemento');
            $this->modelConjunto->imagen     = $request->get('imagen');
            $this->modelConjunto->id_ciudad     = $request->get('idCiudad');
            $this->modelConjunto->save();
            $response = response()->json(['data'=>$this->modelConjunto]);
        }

        //$this->CreateRegisterLog($response);
        return $response;
    }

    /**
     * @SWG\Delete(
     *     path="/conjuntos/{id}",
     *     summary="Eliminación de conjunto por Id",
     *     description="",
     *     operationId="deletePet",
     *     produces={"application/xml", "application/json"},
     *     tags={"CONJUNTOS"},
     *     @SWG\Parameter(
     *         description="Pet id to delete",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="string",
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Id Not Found | Existen extensiones relacionadas | Canales comunicacion asociadas"
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Pet not found"
     *     ),
     *     security={{"acceso_bearer":{}}}
     * )
     */

    /**
     * Remove the specified resource from storage. delete conjunto
     *
     * @param  \App\Models\Conjunto  $conjunto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->validarPermisos($this->modelConjunto->getTable(), 4);
        $response = null;
        $this->modelConjunto = $this->modelConjunto->find($id);

        if ($this->modelConjunto == null){
            abort(400, trans('errors.901'));
        }else {

            try{
                $this->modelConjunto->delete();
            }catch(\Exception $e){

                if ($e->getCode() == 23000)
                    abort(400, 'El conjunto a eliminar tiene extensiones relacionadas o Canales de comunicación asociadas');

            }

            $response = response()->json([  'data'=> ['id'=> $id ]]);
        }
        //$this->CreateRegisterLog($response);
        return $response;
    }

    /**
     * Realiza la busqueda de:
     * * Cantidad de Extensiones
     * * Cantidad de catalogos
     * * Cantidad de Canales
     * Que estas asociados a un conjunto
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function datos1_Conjunto(Request $request)
    {
        $this->validarPermisos($this->modelConjunto->getTable(), 2);
        $data = $this->modelConjunto->conjuntos_ft_usuarios_catalogos()->get();
        return response()->json(['data' => $data]);
    }

    /**
     * Realiza busqueda de:
     * *Pais
     * *Departamento
     * *Ciudad
     * Relacionados al conjunto
     *
     * @param Request $request
     */
    public function datos2_Conjunto(Request $request)
    {

        $this->validarPermisos($this->modelConjunto->getTable(), 2);
        $idConjunto = $request->get('id_conjunto');
        $data = $this->modelConjunto->conjunto_ft_ciudad_departamento_pais($idConjunto)->get();

        return response()->json(['data' => $data]);
    }

    /**
     * Realiza la busqueda de extensiones asociadas a un conjunto
     * Para realizar filtros sobre la consulta se deben enviar como parametros GET
     * Ej. ?id_cojunto = 1&id_extension=1
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function datos3_Conjunto(Request $request)
    {
        $this->validarPermisos($this->modelConjunto->getTable(), 2);

        $callable = function(&$key, &$vlr){

            # Si el parametro es id_conjunto cambia la invocacion
            # de esta columna añadiendo la tabla origen para no crear
            # ambiguedad
            if ($key == 'id_conjunto')
                $key = 'conjuntos.' . $key;
        };

        $filtros = $this->generarFiltros($request->all(), '=', $callable);
        $data = $this->modelConjunto->conjunto_ft_extensiones($filtros)->get();
        return response()->json(['data' => $data]);

    }

    /**
     * Realiza la busqueda de extensiones con relacion a
     * Conjunto
     * Usuario
     * Para realizar filtros sobre la consulta se deben enviar como parametros GET
     * Ej. ?id_cojunto = 1&id_extension=1
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function datos4_Conjunto(Request $request)
    {

        $this->validarPermisos($this->modelConjunto->getTable(), 2);

        $callable = function(&$key, &$vlr){

            # Si el parametro es id_conjunto cambia la invocacion
            # de esta columna añadiendo la tabla origen para no crear
            # ambiguedad
            if ($key == 'id_conjunto')
                $key = 'conjuntos.' . $key;

            if ($key == 'id_extension')
                $key = 'extensiones.' . $key;

            if ($key == 'id_usuario')
                $key = 'usuarios.' . $key;
        };

        $filtros = $this->generarFiltros($request->all(), '=', $callable);
        $data = $this->modelConjunto->conjunto_ft_Rel_extensionUsuario($filtros)->get();

        return response()->json(['data' => $data]);
    }
    
}
