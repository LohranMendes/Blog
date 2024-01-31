<?php

namespace App\Http\Controllers;

use App\Models\buscaModel;
use App\Models\publicacaoModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaginasController extends Controller
{
    protected function inicialPagina () {
        $user = User::select('usuario', 'nome', 'sobrenome', 'foto_perfil', 'id_usuario')->where('id_usuario', Auth::id())->first();

        $posts = new publicacaoModel;
        $publis = $posts->postsUsuarios();

        return view("inicial", compact('user', 'publis'));
    }

    protected function busca(){
        $search = new buscaModel;
        $s = $search->buscaUsuarios();

        echo json_encode($s);
    }

    protected function loginPagina (){
        return view("auth/login");
    }

    protected function registroPagina (){
        return view("auth/registro");
    }

    protected function msgPagina($usuario){
        $user = User::select('usuario', 'nome', 'sobrenome', 'foto_perfil', 'id_usuario')->where('id_usuario', Auth::id())->first();
        $u = User::select('id_usuario', 'usuario', 'nome', 'sobrenome', 'foto_perfil')->where('usuario', $usuario)->first();

        return view("mensagem", compact('user', 'u'));
    }

    protected function perfilPagina ($usuario){

        $u = User::select('id_usuario', 'usuario', 'nome', 'sobrenome', 'foto_perfil')->where('usuario', $usuario)->first();

        $posts = new publicacaoModel;
        $publis = $posts->postUsuario($u->id_usuario);

        $user = User::select('usuario', 'foto_perfil')->where('id_usuario', Auth::id())->first();

        return view("perfil", compact('user', 'publis', 'u'));
    }
}
