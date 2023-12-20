<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaginasController extends Controller
{
    protected function inicialPagina () {
        $usuario['usuario'] = User::where('id_usuario', Auth::id())->value('usuario');

        return view("inicial", compact('usuario'));
    }

    protected function loginPagina (){
        return view("auth/login");
    }

    protected function registroPagina (){
        return view("auth/registro");
    }

    protected function perfilPagina (Request $request){
        $this->verificaImagem();

        $usuario = User::select('usuario', 'nome', 'sobrenome', 'foto_perfil')->where('id_usuario', Auth::id())->first();

        return view("perfil", compact('usuario'));
    }

    private function verificaImagem () {
        $resultado = DB::table('usuarios')
            ->select('foto_perfil')
            ->where('id_usuario', Auth::id())
            ->first();

        if (empty($resultado->foto_perfil)) {
            $this->imagemPadrao();
        }
    }

    private function imagemPadrao (){
        $caminhoImagem = asset('img\foto-de-perfil-de-usuario.jpg');

        DB::table('usuarios')
            ->where('id_usuario', Auth::id())
            ->update([
                'foto_perfil' => $caminhoImagem,
            ]);
    }
}
