<?php

namespace App\Http\Controllers;

use App\Models\publicacaoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PublicacaoController extends Controller
{
    protected function publiPost (Request $request){

        $request->validate([
            'publi' => 'required' 
        ]);

        $banco = [];

        $banco['text'] = $request->publi;
        $banco['id_usuario'] = Auth::id();

        publicacaoModel::create($banco);

        return Redirect::route('inicial');
    }
}
