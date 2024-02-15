<?php

namespace App\Http\Controllers;

use App\Models\buscaModel;
use App\Models\conversaModel;
use App\Models\mensagemModel;
use App\Models\publicacaoModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PaginasController extends Controller
{
    protected function inicialPagina () {
        $user = User::select('usuario', 'nome', 'sobrenome', 'foto_perfil', 'id_usuario')->where('id_usuario', Auth::id())->first();

        $posts = new publicacaoModel;
        $publis = $posts->postsUsuarios();

        $c = new conversaModel;
        $cvs = $c->buscaConversas(Auth::id());

        return view("inicial", compact('user', 'publis', 'cvs'));
    }

    protected function busca(){
        $search = new buscaModel;
        $s = $search->buscaUsuarios();

        return response()->json($s);
    }

    protected function mensagensBusca($id, $usuario){
        $msg = new mensagemModel;
        try {
            $m = $msg->mensagensChat($id, $usuario);
        } catch (\Exception $e) {
            $m = null;
        }
        
        return response()->json($m);
    }
    

    protected function loginPagina (){
        return view("auth/login");
    }

    protected function registroPagina (){
        return view("auth/registro");
    }

    protected function msgPagina($id, $usuario){
        $user = User::select('usuario', 'nome', 'sobrenome', 'foto_perfil', 'id_usuario')->where('id_usuario', $id)->first();
        $u = User::select('id_usuario', 'usuario', 'nome', 'sobrenome', 'foto_perfil')->where('usuario', $usuario)->first();
        $c = new conversaModel;
        $chat = $c->chat($id, $usuario);

        return view("mensagem", compact('user', 'u', 'chat'));
    }

    protected function conversasBusca($id){
        $cvs = new conversaModel;
        $c = $cvs->buscaConversas($id);

        return response()->json($c);
    }

    protected function perfilPagina ($usuario){

        $u = User::select('id_usuario', 'usuario', 'nome', 'sobrenome', 'foto_perfil')->where('usuario', $usuario)->first();

        $posts = new publicacaoModel;
        $publis = $posts->postUsuario($u->usuario);

        $user = User::select('usuario', 'foto_perfil')->where('id_usuario', Auth::id())->first();

        $c = new conversaModel;
        $cvs = $c->buscaConversas(Auth::id());

        return view("perfil", compact('user', 'publis', 'u', 'cvs'));
    }
}
