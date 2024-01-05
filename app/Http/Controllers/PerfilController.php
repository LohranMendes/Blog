<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManagerStatic as Image;

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

    protected function redimensionarImagem($caminhoImagem){
        
        $imagem = Image::read(storage_path("app/public/{$caminhoImagem}"));
        
        $imagem->resize(5 * 16, 5 * 16); // 1rem = 16 pixels

        
        $imagem->save(storage_path("app/public/{$caminhoImagem}"));
    }

}
