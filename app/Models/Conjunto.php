<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conjunto extends Model
{
    protected $table = "conjuntos";
    protected $primaryKey = "id_conjunto";
    protected $fillable = ["nombre_conjunto", "direccion", "email", "telefono", "complemento", "imagen", "id_ciudad"];


    protected static function boot()
    {
        parent::boot();

        //static::addGlobalScope(new ConsultaPersonalizada());

    }

    public function conjuntos_ft_usuarios_catalogos()
    {
        $query =
            $this->select(\DB::raw(
                'conjuntos.id_conjunto,' .
                'conjuntos.nombre_conjunto,' .
                'conjuntos.direccion,' .
                '(SELECT COUNT(id_canal) FROM canal_comunicaciones WHERE id_conjunto = conjuntos.id_conjunto) AS catalogos_comunicacion,' .
                '(SELECT COUNT(id_catalogo) FROM catalogos WHERE id_conjunto = conjuntos.id_conjunto) AS catalogos,' .
                '(SELECT COUNT(id_extension) FROM extensiones WHERE id_conjunto = conjuntos.id_conjunto) AS extensiones'));

        return $query;
    }

    public function conjunto_ft_ciudad_departamento_pais($idConjunto = null)
    {
        $campos[] = 'ciudades.id_ciudad';
        $campos[] = 'ciudades.nombre_ciudad';
        $campos[] = 'departamentos.id_departamento';
        $campos[] = 'departamentos.nombre_departamento';
        $campos[] = 'paises.id_pais';
        $campos[] = 'paises.nombre_pais';

        $query =
            $this->select($campos)
                ->join('ciudades', 'conjuntos.id_ciudad', '=', 'ciudades.id_ciudad')
                ->join('departamentos', 'ciudades.id_departamento', '=', 'departamentos.id_departamento')
                ->join('paises', 'departamentos.id_pais', '=', 'paises.id_pais');

        if (empty($idConjunto) == false)
            $query->where('conjuntos.id_conjunto', $idConjunto);

        return $query;
    }

    public function conjunto_ft_extensiones(array $filtros = null)
    {
        $campos[] = 'conjuntos.id_conjunto';
        $campos[] = 'conjuntos.nombre_conjunto';
        $campos[] = 'extensiones.id_extension';
        $campos[] = 'extensiones.extension';

        $query =
            $this->select($campos)
            ->join('extensiones', 'conjuntos.id_conjunto', '=', 'extensiones.id_conjunto');

        if (empty($filtros) == false){
            $query->where($filtros);
        }

        return $query;
    }

    public function conjunto_ft_Rel_extensionUsuario(array $filtros = null)
    {
        $campos[] = 'id_usuario_extension';
        $campos[] = 'usuarios.id_usuario';
        $campos[] = 'usuarios.nombres';

        $query = $this->conjunto_ft_extensiones($filtros);

        $query
            ->addSelect($campos)
            ->leftJoin('usuario_extensiones', 'extensiones.id_extension', '=', 'usuario_extensiones.id_extension')
            ->leftJoin('usuarios', 'usuario_extensiones.id_usuario', '=', 'usuarios.id_usuario');

        return $query;
    }
}
