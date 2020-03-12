<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller{

    public function gerarToken(Request $request){

        //valida dados herdar Controller
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //pesquisar email do usuario
        $usuario = User::where('email', $request->email)->first(); 

        //usuario nulo ou senha incorreta
        if( is_null($usuario) || !Hash::check($request->password, $usuario->password)){
            return response()->json('Usuário ou senha inválidos', 401);
        }

        //gerar token colocando email e chave secreta
        $token = JWT::encode(['email' => $request->email], env('JWT_KEY'));
               
        return [
            'access_token' => $token 
        ];

    }
}