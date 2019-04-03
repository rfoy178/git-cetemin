<?php

namespace App\Http\Controllers;

use App\Entidad\Area;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Sunat\Sunat;

class UsuariosController extends Controller
{
 

    public function sunat(Request $request){
         $cliente = new  Sunat();
        print_r ( $cliente->search( $request->dni ) );

    }
public function form_nuevo_usuario(){
    //carga el formularios para agregar un nuevo usuario
    $roles=Role::with("users")->get();

     $jefes = User::join('role_user', 'users.id', '=', 'role_user.user_id')
         ->where('role_user.role_id',3)
        ->get();
     $area=Area::all();

     return view("formularios.form_nuevo_usuario")->with("roles",$roles)->with("area",$area)->with("jefes",$jefes);

}


public function form_nuevo_rol(){
    //carga el formularios para agregar un nuevo rol
    $roles=Role::all();
    return view("formularios.form_nuevo_rol")->with("roles",$roles);
}

public function form_nuevo_permiso(){
    //carga el formularios para agregar un nuevo permiso
     $roles=Role::all();
     $permisos=Permission::all();
    return view("formularios.form_nuevo_permiso")->with("roles",$roles)->with("permisos", $permisos);
}



public function listado_usuarios(){
    //presenta un listado de usuarios paginados de 100 en 100
	$usuarios=User::paginate(100);
	return view("listados.listado_usuarios")->with("usuarios",$usuarios);
}





public function crear_usuario(Request $request){
    //crea un nuevo usuario en el sistema

	$reglas=[  'password' => 'required|min:8',
	             'email' => 'required|email|unique:users', ];
	 
	$mensajes=[  'password.min' => 'El password debe tener al menos 8 caracteres',
	             'email.unique' => 'El email ya se encuentra registrado en la base de datos', ];
	  
	$validator = Validator::make( $request->all(),$reglas,$mensajes );
	if( $validator->fails() ){ 
	  	return view("mensajes.mensaje_error")->with("msj","...Existen errores...")
	  	                                    ->withErrors($validator->errors());         
	}

	$usuario=new User;
	$usuario->name=strtoupper( $request->input("nombres")." ".$request->input("apellidos") ) ;
	$usuario->nombres=strtoupper( $request->input("nombres") ) ;
    $usuario->apellidos=strtoupper( $request->input("apellidos") ) ;
	$usuario->telefono=$request->input("telefono");
    $usuario->jefe=$request->input("jefe");
    $usuario->area=$request->input("area");

    $usuario->email=$request->input("email");
	$usuario->password= bcrypt( $request->input("password") ); 
 
            
    if($usuario->save())
    {

  
      return view("mensajes.msj_usuario_creado")->with("msj","Usuario agregado correctamente") ;
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ;...") ;
    }

}



public function crear_rol(Request $request){

   $rol=new Role;
   $rol->name=$request->input("rol_nombre") ;
   $rol->slug=$request->input("rol_slug") ;
   $rol->description=$request->input("rol_descripcion") ;
    if($rol->save())
    {
        return view("mensajes.msj_rol_creado")->with("msj","Rol agregado correctamente") ;
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ;...") ;
    }
}




public function crear_permiso(Request $request){

  
   $permiso=new Permission;
   $permiso->name=$request->input("permiso_nombre") ;
   $permiso->slug=$request->input("permiso_slug") ;
   $permiso->description=$request->input("permiso_descripcion") ;
    if($permiso->save())
    {
        return view("mensajes.msj_permiso_creado")->with("msj","Permiso creado correctamente") ;
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ;...") ;
    }


}

public function asignar_permiso(Request $request){

     $roleid=$request->input("rol_sel");
     $idper=$request->input("permiso_rol");
     $rol=Role::find($roleid);
     $rol->assignPermission($idper);
    
    if($rol->save())
    {
        return view("mensajes.msj_permiso_creado")->with("msj","Permiso asignado correctamente") ;
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ;...") ;
    }



}



public function form_editar_usuario($id){
    $usuario=User::find($id);
    $roles=Role::all();
    return view("formularios.form_editar_usuario")->with("usuario",$usuario)
	                                              ->with("roles",$roles);                                 
}

public function editar_usuario(Request $request){
          
    $idusuario=$request->input("id_usuario");
    $usuario=User::find($idusuario);
    $usuario->name=strtoupper( $request->input("nombres") ) ;
    $usuario->apellidos=strtoupper( $request->input("apellidos") ) ;
    $usuario->telefono=$request->input("telefono");
    
     if($request->has("rol")){
	    $rol=$request->input("rol");
	    $usuario->revokeAllRoles();
	    $usuario->assignRole($rol);
     }
	 
    if( $usuario->save()){
		return view("mensajes.msj_usuario_actualizado")->with("msj","Usuario actualizado correctamente")
	                                                   ->with("idusuario",$idusuario) ;
    }
    else
    {
		return view("mensajes.mensaje_error")->with("msj","..Hubo un error al agregar ; intentarlo nuevamente..");
    }
}


public function buscar_usuario(Request $request){
	$dato=$request->input("dato_buscado");
	$usuarios=User::where("name","like","%".$dato."%")->orwhere("apellidos","like","%".$dato."%")                                              ->paginate(100);
	return view('listados.listado_usuarios')->with("usuarios",$usuarios);
      }




public function borrar_usuario(Request $request){
        $idusuario=$request->input("id_usuario");
        $usuario=User::find($idusuario);
    
        if($usuario->delete()){
             return view("mensajes.msj_usuario_borrado")->with("msj","Usuario borrado correctamente") ;
        }
        else
        {
            return view("mensajes.mensaje_error")->with("msj","..Hubo un error al agregar ; intentarlo nuevamente..");
        }
        
     
}

public function editar_acceso(Request $request){
         $idusuario=$request->input("id_usuario");
         $usuario=User::find($idusuario);
         $usuario->email=$request->input("email");
         $usuario->password= bcrypt( $request->input("password") ); 
          if( $usuario->save()){
        return view("mensajes.msj_usuario_actualizado")->with("msj","Usuario actualizado correctamente")->with("idusuario",$idusuario) ;
         }
          else
          {
        return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ; intentarlo nuevamente ...") ;
          }
}



public function asignar_rol($idusu,$idrol){

        $usuario=User::find($idusu);
        $usuario->assignRole($idrol);
        $usuario=User::find($idusu);
        $rolesasignados=$usuario->getRoles();
        return json_encode ($rolesasignados);


}


public function quitar_rol($idusu,$idrol){

    $usuario=User::find($idusu);
    $usuario->revokeRole($idrol);
    $rolesasignados=$usuario->getRoles();
    return json_encode ($rolesasignados);


}


public function form_borrado_usuario($id){
  $usuario=User::find($id);
  return view("confirmaciones.form_borrado_usuario")->with("usuario",$usuario);

}


public function quitar_permiso($idrole,$idper){ 
    
    $role = Role::find($idrole);
    $role->revokePermission($idper);
    $role->save();

    return "ok";
}


public function borrar_rol($idrole){

    $role = Role::find($idrole);
    $role->delete();
    return "ok";
}


    public function postPassword()
    {
        $rules = array(
            'pass_actual' => 'required',
            'pass_nueva' => 'required|min:5',
            'pass_nueva_2' => 'required|same:pass_nueva'
        );

        $messages = array(
            'required' => 'El campo :attribute es obligatorio.',
            'min' => 'El campo :attribute no puede tener menos de :min carácteres.'
        );

        $validation = Validator::make(Input::all(), $rules, $messages);


        if ($validation->fails())
        {

            $this->response['error'] = true;
            $this->response['data'] = $validation->errors();
            $this->response['msg'] = "Validación incorrecta";
            return response()->json($this->response);


        }
        else{
            if (Hash::check(Input::get('pass_actual'), Auth::user()->password))
            {
                $cliente = new User();
                $cliente = Auth::user();
                $cliente->Password = Hash::make(Input::get('pass_nueva'));
                $cliente->save();


                if($cliente->save()){


                    $this->response['error'] = false;
                    $this->response['msg'] = "La contraseña de guardo correctamente";
                    return response()->json($this->response);

                }
                else
                {

                    $this->response['error'] = true;
                    $this->response['msg'] = "No se cambio la contraseña";
                    return response()->json($this->response);

                }
            }
            else
            {

                $this->response['error'] = true;
                $this->response['msg'] = "La contraseña actual no es correcta";
                return response()->json($this->response);


            }

        }
    }
}
