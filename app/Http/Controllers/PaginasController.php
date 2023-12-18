<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaginasController extends Controller
{
    public function inicialPagina () {
        $usuario['nome'] = User::where('id_usuario', Auth::id())->value('nome');

        return view("inicial", compact('usuario'));
    }

    public function loginPagina (){
        return view("auth/login");
    }

    public function registroPagina (){
        return view("auth/registro");
    }
}
