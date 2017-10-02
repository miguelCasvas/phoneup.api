<?php

namespace App;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'contador_contrasenia', 'is_estado_contrasenia', 'id_usuario'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Encriptacion de contraseña antes de generar Insercion o actualizacion de registro
     *
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function errorContrasenia()
    {
        //$model = user::find($id);
        $this->contador_contrasenia = $this->contador_contrasenia + 1;
        $this->save();

        return $this->contador_contrasenia;
    }

    public function busquedaPorEmail($email)
    {
        $model = user::where('email', $email);

        if ($model != null)
            return $model;
        else
            return false;
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

        $infoUsuarioQuery = \DB::table('users')
            ->join('usuarios','users.id_usuario','=','usuarios.id_usuario')
            # LeftJoin [usuarios -- usuario_extensiones]
            ->leftJoin('usuario_extensiones','usuario_extensiones.id_usuario','=','usuarios.id_usuario')
            # LeftJoin [usuario_extensiones -- extensiones]
            ->leftJoin('extensiones','usuario_extensiones.id_extension','=','extensiones.id_extension')
            # leftJoin [conjuntos - extensiones]
            ->leftJoin('conjuntos','extensiones.id_conjunto','=','conjuntos.id_conjunto')
            # Join [usuarios -- roles]
            ->join('roles','usuarios.id_rol','=','roles.id_rol')
            # LeftJoin [roles -- permisos_por_rol]
            ->leftJoin('permisos_por_rol','permisos_por_rol.id_rol','=','roles.id_rol')
            # Join [permisos_por_rol -- permisos]
            ->join('permisos','permisos.id_permiso','=','permisos_por_rol.id_permiso')
            # Join [permisos_por_rol -- modelo]
            ->leftJoin('modelos','modelos.id_modelo','=','permisos_por_rol.id_modelo')
            # Campos a retornar
            ->select(
                'users.id As id_user',
                'users.password',
                # Info. usuarios
                'usuarios.id_usuario',
                'usuarios.nombres',
                'usuarios.apellidos',
                'usuarios.email',
                'usuarios.identificacion',
                'usuarios.fecha_nacimiento',
                # Info. usuario_extensiones
                'usuario_extensiones.id_usuario_extension',
                # Info extensiones
                'extensiones.id_extension',
                'extensiones.extension',
                # Info conjuntos
                'conjuntos.id_conjunto',
                'conjuntos.nombre_conjunto',
                'conjuntos.direccion',
                'conjuntos.telefono',
                # Info. permisos_por_rol
                'permisos_por_rol.id_permisos_por_rol',
                # Info. roles
                'roles.id_rol',
                'roles.nombre_rol',
                # Info. permisos
                'permisos.id_permiso',
                'permisos.nombre_permiso',
                # Info modelos
                'modelos.id_modelo',
                'modelos.nombre_modelo'
            )
            ->where('users.id', '=', $idUser);

        return $infoUsuarioQuery;
    }

    /**
     * @param $idUser
     * @return mixed
     */
    public function infoGlobalUsuario($idUser)
    {
        $infoUsuarioQuery = $this->queryInfoUsuario($idUser)->get();
        //dd($infoUsuarioQuery->toSql());

        $infoUsuario = new Collection();

        $infoUsuario->put('id_user', $infoUsuarioQuery->first()->id_user);
        $infoUsuario->put('id_usuario', $infoUsuarioQuery->first()->id_usuario);
        $infoUsuario->put('password', $infoUsuarioQuery->first()->password);
        $infoUsuario->put('nombres', $infoUsuarioQuery->first()->nombres);
        $infoUsuario->put('apellidos', $infoUsuarioQuery->first()->apellidos);
        $infoUsuario->put('email', $infoUsuarioQuery->first()->email);
        $infoUsuario->put('identificacion', $infoUsuarioQuery->first()->identificacion);
        $infoUsuario->put('fecha_nacimiento', $infoUsuarioQuery->first()->fecha_nacimiento);
        $infoUsuario->put('id_rol', $infoUsuarioQuery->first()->id_rol);
        $infoUsuario->put('nombre_rol', $infoUsuarioQuery->first()->nombre_rol);

        # Extensiones
        $infoUsuario->put('extensiones', new Collection());
        # Conjunto
        $infoUsuario->put('id_conjunto', $infoUsuarioQuery->first()->id_conjunto);
        $infoUsuario->put('nombre_conjunto', $infoUsuarioQuery->first()->nombre_conjunto);
        $infoUsuario->put('direccion', $infoUsuarioQuery->first()->direccion);
        $infoUsuario->put('telefono', $infoUsuarioQuery->first()->telefono);
        # Permisos
        $infoUsuario->put('permisos', new Collection());

        # Adicion de Extensiones
        $infoUsuarioQuery->each(function ($register) use($infoUsuario){

            if ($register->id_extension != null){
                $extension['id_usuario_extension'] = $register->id_usuario_extension;
                $extension['id_extension'] = $register->id_extension;
                $extension['extension'] = $register->extension;

                $infoUsuario->get('extensiones')->put($register->id_extension, $extension);
            }
        });

        # Adicion de Permisos
        $infoUsuarioQuery->each(function ($register) use($infoUsuario){

            if ($register->id_permisos_por_rol != null){

                $permisos = collect([
                    'id_permisos_por_rol' => $register->id_permisos_por_rol,
                    'id_rol' => $register->id_rol,
                    'id_permiso' => $register->id_permiso,
                    'nombre_permiso' => $register->nombre_permiso,
                    'id_modelo' => $register->id_modelo,
                    'nombre_modelo' => $register->nombre_modelo
                ]);

                $extension['id_permisos_por_rol'] = $register->id_permisos_por_rol;
                $extension['id_rol'] = $register->id_rol;
                $extension['nombre_rol'] = $register->nombre_rol;
                $extension['id_permiso'] = $register->id_permiso;
                $extension['nombre_permiso'] = $register->nombre_permiso;
                $extension['id_modelo'] = $register->id_modelo;
                $extension['nombre_modelo'] = $register->nombre_modelo;

                $infoUsuario->get('permisos')->push($permisos);
            }
        });

        return $infoUsuario;
    }
}
