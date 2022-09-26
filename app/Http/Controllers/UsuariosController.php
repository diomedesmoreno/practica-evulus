<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as Controller;
use App\Models\User;
use App\Models\Niveles;
use App\Models\UsuariosReferidos;
use Validator;

class UsuariosController extends Controller
{
    public function index(){

        $usuarios = User::orderBy('id', 'DESC')->get();

        return $this->ok("Todos los usuarios",["usuarios" => $usuarios]);
    }

    public function show(User $user,$id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return $this->sendError('Usuario no encontrado.');
        }

        return $this->ok("Detalles del usuario",["user"=>$user]); 
    }

    public function store(Request $request){

        $validator =\Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'monto_actual'=> 'required|numeric'
        ]);

        if($validator->fails()){
            return $this->sendError('Error de validacion.', $validator->errors());       
        }

        $usuario = new User;
        $insert  = '';

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->monto_actual = $request->monto_actual;
        $usuario->codigo_referido_de = !empty($request->codigo_referido_de) ? $request->codigo_referido_de: null;

        // $usuario->nivel_id = 1;//$nivel->id;
        $usuario->mi_codigo_referido = $this->getCodigo();

        $usuario->save();

        if (!empty($request->codigo_referido_de)){

            $mi_codigo_referido = User::where('mi_codigo_referido',$request->codigo_referido_de)->first();
            $datos_usuario_referidor = UsuariosReferidos::where('usuario_referido_id',$mi_codigo_referido->id)->first();
          
            $usuario_referido = new UsuariosReferidos();

            $usuario_referido->usuario_referido_id = $usuario->id;
            $usuario_referido->usuario_referidor_id = $mi_codigo_referido->id;
            $usuario_referido->save();

            // nuevos datos
            $usuario_id = $usuario->id;
            $usuario_referido_id = $usuario_referido->id;
            $usuario_referido = UsuariosReferidos::where('id',$usuario_referido_id)->first();
            
            if (empty($datos_usuario_referidor->id_rastro)){
                if (empty($datos_usuario_referidor)){
                    $insert = $usuario_referido->usuario_referidor_id.','.$usuario_referido->usuario_referido_id;
                } else {
                    $insert = $datos_usuario_referidor->usuario_referido_id.','.$usuario_referido->usuario_referido_id;
                }
            } else {
                $insert = $datos_usuario_referidor->id_rastro.','.$usuario_referido->usuario_referido_id;
            }

            $usuario_referido->id_rastro = $insert;
            $usuario_referido->save();
            //  nuevos datos
        }

        return $this->ok("Usuario creado",["usuario" => $usuario]);
    }

    public function update(Request $request, $id){

        $validator =\Validator::make($request->all(),[
            'name' => 'required',
            'monto_actual'=> 'required|numeric'
        ]);

        if($validator->fails()){
            return $this->sendError('Error de validacion.', $validator->errors());       
        }
        // dd($request->name);
        $usuario = User::find($id);

        $usuario->name = $request->name;
        $usuario->monto_actual = $request->monto_actual;

        $usuario->save();

        return $this->ok("Usuario creado",["usuario" => $usuario]);
    }

    public function getCodigo(){

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($permitted_chars), 0, 10);
         
    }
}
