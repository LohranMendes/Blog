<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaginasController extends Controller
{
    public function inicialPagina () {
        return view("inicial");
    }

    public function loginPagina (){
        return view("auth/login");
    }

    public function registroPagina (){
        return view("auth/registro");
    }
}
