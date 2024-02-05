<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class publicacaoModel extends Model
{
    use HasFactory;

    protected $table = "publicacao";
    protected $primaryKey = 'id_usuario, id_publi';

    protected $fillable = [
        'id_publi',
        'id_usuario',
        'text',
        'created_at',
    ];

    public function postsUsuarios() {
        $result = DB::select('SELECT u.id_usuario, u.usuario, p.text, u.foto_perfil, p.id_publi
            FROM usuarios u
            JOIN publicacao p ON u.id_usuario = p.id_usuario
            ORDER BY p.created_at DESC
            LIMIT 100');

        return $result;
    }

    public function postUsuario($usuario){
        $result = DB::select("SELECT u.id_usuario, u.usuario, p.text, u.foto_perfil, p.id_publi
        FROM usuarios u
        JOIN publicacao p ON u.id_usuario = p.id_usuario and u.usuario like '$usuario'
        ORDER BY p.created_at DESC
        LIMIT 100;");

        return $result;
    }
}
