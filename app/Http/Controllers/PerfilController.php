<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

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
            $this->alterarNome($request->nomeUsuario);
        }

        if ($request->sobrenomeUsuario != null){
            $this->alterarSobrenome($request->sobrenomeUsuario);
        }

        if ($request->foto_perfil != null){
            $this->addFotoPerfil($request->foto_perfil);
        }

        if ($request->capa_perfil != null){

        }

        if($request->has('epi')){
            return Redirect::route('inicial');
        }

        $usuario['usuario'] = User::where('id_usuario', Auth::id())->value('usuario');
        return Redirect::route('perfil', ['usuario' => $usuario['usuario']]);
    }

    protected function addFotoPerfil($imagem){
        $arq = User::where('id_usuario', Auth::id())->value('foto_perfil');
        Storage::disk('public')->delete($arq);

        $img = $imagem;
        $nomeImg = Auth::user()->usuario . '_' . time() . '.' . $img->getClientOriginalExtension();
        $caminhoImg = 'users/' . Auth::user()->usuario;

        $img->storeAs($caminhoImg, $nomeImg, 'public');
        $caminhoImagem = $caminhoImg . '/' . $nomeImg;

        User::where('id_usuario', Auth::id())->update(['foto_perfil' => $caminhoImagem]);;
    }

    public function getImagemPerfil(Request $request){

        $u = User::select('foto_perfil')->where('usuario', $request->usuario)->first();
        $caminhoImagem = $u['foto_perfil'];

        return response()->file(storage_path("app/public/{$caminhoImagem}"));
    }

    public function alterarNome($nome){
        User::where('id_usuario', Auth::id())->update(['nome' => $nome]);
    }

    public function alterarSobrenome($sobrenome){
        User::where('id_usuario', Auth::id())->update(['sobrenome' => $sobrenome]);
    }
}
