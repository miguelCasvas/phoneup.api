<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ConsultaPersonalizada implements Scope
{

    const PALABRAS_RESERVADAS = ['fields', 'sort', 'embebed', 'offset', 'limit'];

    /**
     * @var
     */
    private $model;

    /**
     * @var \Illuminate\Database\Eloquent\Builder
     */
    private $builder;

    /**
     * @var array
     */
    private $columnas = [];

    /**
     * @var array
     */
    private $condiciones = [];

    /**
     * @var array
     */
    private $ordenar = [];

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $paramsURL = request()->all();
        $this->builder = $builder;

        $this->ubicarParametros($paramsURL, $model);

        # Se definen campos a select si vienen por parametro url
        if (count($this->columnas) > 0)
            $this->builder->Select($this->columnas);

        # Se agrega condicionales si vienen por parametro url
        $this->builder->where( $this->condiciones );

        # Recorrido e insercion de campos con los que ordenar los
        # resultados de la consulta
        foreach ( $this->ordenar as $column => $tpoOrden ) {
            $this->builder->orderBy($column, $tpoOrden);
        }

    }

    private function ubicarParametros(array $params, Model $model)
    {
        $params = $this->camposParticulares($params);
        $params = $this->camposOrden($params);
        $params = $this->camposDeFiltro($model, $params);

    }

    /**
     * Realiza la busqueda del parametro fields dentro de la url
     * para indicar a la SQL las columnas que se quieren retornar
     *
     * @param array $paramsURL
     * @return array
     */
    private function camposParticulares(array $paramsURL = [])
    {
        $this->columnas = [];

        if (array_key_exists('fields', $paramsURL)){
            $this->columnas = explode(',', $paramsURL['fields']);
            unset($paramsURL['fields']);
        }

        return $paramsURL;
    }

    /**
     * Realiza la busqueda del parametro sort para generar el orden personalizado
     *
     * @param array $paramsURL
     * @return array
     */
    private function camposOrden(array $paramsURL = [])
    {
        $this->ordenar = [];

        if (array_key_exists('sort', $paramsURL)){
            $columnasOrden = explode(',', $paramsURL['sort']);


            foreach ($columnasOrden as $columna) {
                $columna = trim($columna);

                if (preg_match('/^\-[a-zA-Z0-9]/', $columna)){
                    $columna = substr($columna, 1, strlen($columna));
                    $this->ordenar[$columna] = 'desc';
                }
                else
                    $this->ordenar[$columna] = 'asc';

            }

            unset($paramsURL['sort']);
        }

        return $paramsURL;
    }

    /**
     * @param Builder $builder
     */
    private function consultasEmbebidas(Builder $builder, array $paramsURL = [])
    {
        if (array_key_exists('embebed' ,$paramsURL)){

            $recursosEmbebidos = $paramsURL['embebed'];
            $recursosEmbebidos = explode(',', $recursosEmbebidos);

            foreach ($recursosEmbebidos as $modeloColumna){

            }


        }
    }

    /**
     * Genera busqueda de cualquier filtro enviado por url como parametro
     * para filtrar la busqueda
     *
     * @param Model $model
     * @param array $paramsURL
     * @return array
     */
    private function camposDeFiltro(Model $model, array $paramsURL)
    {

        if (empty($paramsURL) == false){
            # Se obtiene un arreglo con los campos validos en el modelo
            $columnasModelo = array_flip($model->getFillable());
            # Se agrega el id del modelo
            $columnasModelo[$model->getKeyName()] = 'keyModel';

            $paramsValidos = array_intersect_key($paramsURL, $columnasModelo);

            foreach ($paramsValidos as $columna => $vlr){

                # Verifica si se trata de la llave primaria del modelo
                if ($vlr == 'keyModel')
                    $columna = $model->getTable() . '.' . $columna;

                # Verifica si se esta validando mayor que
                if (preg_match('/^>[0-9]/', $vlr)){
                    $vlr = substr($vlr, 1, strlen($vlr));
                    $this->condiciones[] = [$columna, '>', $vlr];
                }
                # Verifica si se esta validando mayor o igual que
                elseif (preg_match('/^\>=[0-9]/', $vlr)){
                    $vlr = substr($vlr, 2, strlen($vlr));
                    $this->condiciones[] = [$columna, '>=', $vlr];
                }
                # Verifica si se esta validando menor que
                elseif (preg_match('/^\<[0-9]/', $vlr)){
                    $vlr = substr($vlr, 1, strlen($vlr));
                    $this->condiciones[] = [$columna, '<', $vlr];
                }
                # Verifica si se esta validando menor o igual que
                elseif (preg_match('/^\<=[0-9]/', $vlr)){
                    $vlr = substr($vlr, 2, strlen($vlr));
                    $this->condiciones[] = [$columna, '<=', $vlr];
                }
                else
                    $this->condiciones[] = [$columna, '=', $vlr];

            }

        }

        return $paramsURL;
    }

}