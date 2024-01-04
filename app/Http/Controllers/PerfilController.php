<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class PerfilController extends Controller
{
    protected function editarPerfil(Request $request) {

        $request->validate([
            'nomeUsuario' => 'nullable',
            'sobrenomeUsuario' => 'nullable',
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'capa_perfil' => 'nullable'
        ]);

        if ($request->nomeUsuario != null){

        }

        if ($request->sobrenomeUsuario != null){

        }

        if ($request->foto_perfil != null){
            $this->addFotoPerfil($request->foto_perfil);
        }

        if ($request->capa_perfil != null){

        }

        $usuario['usuario'] = User::where('id_usuario', Auth::id())->value('usuario');
        return Redirect::route('perfil', ['usuario' => $usuario['usuario']]);
    }

    protected function addFotoPerfil($imagem){
        $img = $imagem;
        $nomeImg = Auth::user()->usuario . '_' . time() . '.' . $img->getClientOriginalExtension();
        $caminhoImg = 'storage/users/' . Auth::user()->usuario;

        if (!File::exists($caminhoImg)) {
            File::makeDirectory($caminhoImg, $mode = 0755, true, true);
        }

        $img->storeAs($caminhoImg, $nomeImg);
        $caminhoImagem = $caminhoImg . '/' . $nomeImg;

        User::where('id_usuario', Auth::id())->update(['foto_perfil' => $caminhoImagem]);;

        //$this->redimensionarImagem($caminhoImagem . '/' . $nomeImagem);
    }

}
