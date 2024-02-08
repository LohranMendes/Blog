<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class MensagemController extends Controller
{
    protected function msgPost(Request $request){
        $u = $request->usuario;

        return Redirect::route('msg', 'u');
    }
}
