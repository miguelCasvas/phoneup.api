<?php

namespace App;

use Illuminate\Support\Collection;
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
     * @param $idUser
     * @return mixed
     */
    public function miUsuario($idUser)
    {
        $miUsuarioQuery = \DB::table('users')
            ->join('usuarios','users.id_usuario','=','usuarios.id_usuario')
            # LeftJoin [usuarios -- usuario_extensiones]
            ->leftJoin('usuario_extensiones','usuario_extensiones.id_usuario_extension','=','usuarios.id_usuario')
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
                'users.id',
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
            ->where('users.id', '=', $idUser)->get();
        //dd($miUsuarioQuery->toSql());

        $miUsuario = new Collection();

        $miUsuario->put('id_usuario', $miUsuarioQuery->first()->id_usuario);
        $miUsuario->put('password', $miUsuarioQuery->first()->password);
        $miUsuario->put('nombres', $miUsuarioQuery->first()->nombres);
        $miUsuario->put('apellidos', $miUsuarioQuery->first()->apellidos);
        $miUsuario->put('email', $miUsuarioQuery->first()->email);
        $miUsuario->put('identificacion', $miUsuarioQuery->first()->identificacion);
        $miUsuario->put('fecha_nacimiento', $miUsuarioQuery->first()->fecha_nacimiento);
        $miUsuario->put('id_rol', $miUsuarioQuery->first()->id_rol);
        $miUsuario->put('nombre_rol', $miUsuarioQuery->first()->nombre_rol);

        # Extensiones
        $miUsuario->put('extensiones', new Collection());
        # Conjunto
        $miUsuario->put('id_conjunto', $miUsuarioQuery->first()->id_conjunto);
        $miUsuario->put('nombre_conjunto', $miUsuarioQuery->first()->nombre_conjunto);
        $miUsuario->put('direccion', $miUsuarioQuery->first()->direccion);
        $miUsuario->put('telefono', $miUsuarioQuery->first()->telefono);
        # Permisos
        $miUsuario->put('permisos', new Collection());

        # Adicion de Extensiones
        $miUsuarioQuery->each(function ($register) use($miUsuario){

            if ($register->id_extension != null){
                $extension['id_usuario_extension'] = $register->id_usuario_extension;
                $extension['id_extension'] = $register->id_extension;
                $extension['extension'] = $register->extension;

                $miUsuario->get('extensiones')->put($register->id_extension, $extension);
            }
        });

        # Adicion de Permisos
        $miUsuarioQuery->each(function ($register) use($miUsuario){

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

                $miUsuario->get('permisos')->push($permisos);
            }
        });

        return $miUsuario;
    }
}
