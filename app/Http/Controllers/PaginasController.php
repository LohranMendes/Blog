<?php

namespace App\Http\Controllers;

use App\Models\publicacaoModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaginasController extends Controller
{
    protected function inicialPagina () {
        $user = User::select('usuario', 'foto_perfil')->where('id_usuario', Auth::id())->first();

        $posts = new publicacaoModel;

        $publis = $posts->postsUsuarios();

        return view("inicial", compact('user', 'publis'));
    }

    protected function loginPagina (){
        return view("auth/login");
    }

    protected function registroPagina (){
        return view("auth/registro");
    }

    protected function perfilPagina ($usuario){
        $this->verificaImagem();

        $u = User::select('id_usuario', 'usuario', 'nome', 'sobrenome', 'foto_perfil')->where('usuario', $usuario)->first();

        $posts = new publicacaoModel;

        $publis = $posts->postUsuario($u->id_usuario);

        $user = User::select('usuario', 'foto_perfil')->where('id_usuario', Auth::id())->first();

        return view("perfil", compact('user', 'publis', 'u'));
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
        $caminhoImagem = 'img/foto-de-perfil-de-usuario.jpg';

        DB::table('usuarios')
            ->where('id_usuario', Auth::id())
            ->update([
                'foto_perfil' => url($caminhoImagem),
            ]);
    }
}
