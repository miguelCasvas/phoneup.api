<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Passport\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = "usuarios";

    protected $primaryKey = "id_usuario";

    protected $fillable = ["nombres", "apellidos", "email", "identificacion", "fecha_nacimiento", "id_rol", "id_conjunto", "password"];

    /**
     * Relacion con modelo canal_comunicaciones Uno a Muchos [usuarios(1) --fk--> canal_comunicaciones(*)]
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function canalComunicacion()
    {
        return $this->hasMany(\App\Models\CanalComunicacion::class, 'id_usuario', 'id_usuario');
    }

    /**
     * @param      $idRol
     * @param null $id
     *
     * @return $this|array|\Illuminate\Database\Eloquent\Collection|Model|null|static|static[]
     */
    public function getFiltrado($idRol,$id=null)
    {
        $dataR = [];

        if ($idRol == 1){
            if ($id == null)
                $dataR = Usuario::all();
            else
                $dataR = Usuario::find($id);
        }
        else{
            $condiciones[0] = ['id_rol','!=',1];

            if ($id != null)
                $condiciones[1] = ['id_usuario','=',$id];

            $dataR = Usuario::where($condiciones)->get();
        }

        return $dataR;
    }

    /**
     * Genera la sql para la lectura de toda la información relacionada a un usuario
     *
     * @param $idUser
     *
     * @return mixed
     */
    private function queryInfoUsuario($idUser)
    {

        $infoUsuarioQuery = $this->select(
                'usuarios.id_usuario',
                'usuarios.nombres',
                'usuarios.apellidos',
                'usuarios.email',
                'usuarios.identificacion',
                'usuarios.fecha_nacimiento',
                'usuarios.id_conjunto',
                'roles.id_rol',
                'roles.nombre_rol'
            )
            ->join('roles', 'usuarios.id_rol', '=', 'roles.id_rol')
            ->where('usuarios.id_usuario', '=', $idUser);

        $idUsuario = $infoUsuarioQuery->first()->id_usuario;
        $idRol = $infoUsuarioQuery->first()->id_rol;


        # Consulta de Conjunto
        $infoConjuntoQuery =
            \DB::table('conjuntos')
                ->select(
                    'nombre_conjunto',
                    'direccion',
                    'telefono'
                )
                ->where('id_conjunto', $infoUsuarioQuery->first()->id_conjunto);

        # Consulta de extensiones relacionadas al (usuario - conjuntos)
        $infoExtensionesQuery =
            \DB::table('usuario_extensiones')
                ->select(
                    'usuario_extensiones.id_usuario_extension',
                    'extensiones.id_extension',
                    'extensiones.extension',
                    'conjuntos.id_conjunto',
                    'conjuntos.nombre_conjunto',
                    'conjuntos.direccion',
                    'conjuntos.email',
                    'conjuntos.telefono'
                )
                ->join('extensiones', 'usuario_extensiones.id_extension', '=', 'extensiones.id_extension')
                ->join('conjuntos', 'extensiones.id_conjunto', '=', 'conjuntos.id_conjunto')
                ->where('usuario_extensiones.id_usuario', $idUsuario);

        # Consulta de permisos del usuario
        $infoPermisosQuery =
            \DB::table('permisos_por_rol')
                ->select(
                    'permisos_por_rol.id_permisos_por_rol',
                    'roles.id_rol',
                    'roles.nombre_rol',
                    'permisos.id_permiso',
                    'permisos.nombre_permiso',
                    'modelos.id_modelo',
                    'modelos.nombre_modelo'
                )
                ->join('permisos', 'permisos_por_rol.id_permiso', '=', 'permisos.id_permiso')
                ->join('roles', 'permisos_por_rol.id_rol', '=', 'roles.id_rol')
                ->join('modelos', 'permisos_por_rol.id_modelo', '=', 'modelos.id_modelo')
                ->where('permisos_por_rol.id_rol', $idRol);

        return $collectionQuerys =
            collect(
                [
                    'usuarios'    => $infoUsuarioQuery,
                    'conjuntos'   => $infoConjuntoQuery,
                    'extensiones' => $infoExtensionesQuery,
                    'permisos'    => $infoPermisosQuery
                ]
            );
    }

    /**
     * @param $idUser
     * @return mixed
     */
    public function infoGlobalUsuario($idUser)
    {
        $infoUsuarioQueries = $this->queryInfoUsuario($idUser);

        $usuario = $infoUsuarioQueries->get('usuarios');
        $conjunto = $infoUsuarioQueries->get('conjuntos');
        $extensiones = $infoUsuarioQueries->get('extensiones')->get();
        $permisos = $infoUsuarioQueries->get('permisos')->get();

        $infoUsuario = new Collection();

        $infoUsuario->put('id_usuario', $usuario->first()->id_usuario);
        $infoUsuario->put('nombres', $usuario->first()->nombres);
        $infoUsuario->put('apellidos', $usuario->first()->apellidos);
        $infoUsuario->put('email', $usuario->first()->email);
        $infoUsuario->put('identificacion', $usuario->first()->identificacion);
        $infoUsuario->put('fecha_nacimiento', $usuario->first()->fecha_nacimiento);
        $infoUsuario->put('id_rol', $usuario->first()->id_rol);
        $infoUsuario->put('nombre_rol', $usuario->first()->nombre_rol);
        $infoUsuario->put('id_conjunto', $usuario->first()->id_conjunto);

        #Conjuntos
        $infoUsuario->put('nombre_conjunto', $conjunto->first()->nombre_conjunto);
        $infoUsuario->put('direccion', $conjunto->first()->direccion);
        $infoUsuario->put('telefono', $conjunto->first()->telefono);


        # Extensiones
        $infoUsuario->put('extensiones', new Collection());

        # Adicion de Extensiones
        $extensiones->each(function ($registro) use(&$infoUsuario){

            $extension['id_usuario_extension'] = $registro->id_usuario_extension;
            $extension['id_extension'] = $registro->id_extension;
            $extension['extension'] = $registro->extension;
            $extension['id_conjunto'] = $registro->id_conjunto;
            $extension['nombre_conjunto'] = $registro->nombre_conjunto;
            $extension['direccion'] = $registro->direccion;
            $extension['email'] = $registro->email;
            $extension['telefono'] = $registro->telefono;
            $infoUsuario->get('extensiones')->push($extension);
        });

        # Permisos
        $infoUsuario->put('permisos', new Collection());

        # Adicion de Permisos
        $permisos->each(function ($register) use(&$infoUsuario){

            $permiso['id_permisos_por_rol'] = $register->id_permisos_por_rol;
            $permiso['id_rol'] = $register->id_rol;
            $permiso['nombre_rol'] = $register->nombre_rol;
            $permiso['id_permiso'] = $register->id_permiso;
            $permiso['nombre_permiso'] = $register->nombre_permiso;
            $permiso['id_modelo'] = $register->id_modelo;
            $permiso['nombre_modelo'] = $register->nombre_modelo;

            $infoUsuario->get('permisos')->push($permiso);
        });

        return $infoUsuario;
    }

}
