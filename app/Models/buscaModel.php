<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class buscaModel extends Model
{
    use HasFactory;

    protected $table = "usuarios";

    public function buscaUsuarios (){
        $r = DB::select("SELECT nome, sobrenome, foto_perfil, usuario
            from usuarios");

        return $r;
    }

}
