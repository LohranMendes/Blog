<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class conversaModel extends Model
{
    use HasFactory;

    protected $table = 'conversas';

    protected $primaryKey = 'id_chat';

    protected $fillable = [
        'id_chat',
        'de_id_usuario',
        'para_id_usuario',
        'created_at',
        'updated_at',
    ];

    public function chat($id, $usuario){
        $outroId = User::where('usuario', $usuario)->value('id_usuario');
        $usuarios = [$id, $outroId];
        sort($usuarios); 
        $chat = conversaModel::where(['de_id_usuario' => $usuarios[0], 'para_id_usuario' => $usuarios[1]])->value('id_chat');

        return $chat;
    }

    public function buscaConversas($id){
        $result = DB::select("SELECT DISTINCT id_chat, 
                    CASE
                        WHEN c.de_id_usuario = $id THEN u_para.usuario
                        ELSE u_de.usuario
                    END AS u,
                    CASE
                        WHEN c.de_id_usuario = $id THEN u_para.foto_perfil
                        ELSE u_de.foto_perfil
                    END AS fp,
                    c.updated_at AS up
            FROM blog.conversas c
            JOIN blog.usuarios u_de ON c.de_id_usuario = u_de.id_usuario
            JOIN blog.usuarios u_para ON c.para_id_usuario = u_para.id_usuario
            WHERE $id IN (c.de_id_usuario, c.para_id_usuario)
            order by c.updated_at desc");

        return $result;
    }
}
