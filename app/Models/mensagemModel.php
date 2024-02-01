<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class mensagemModel extends Model
{
    use HasFactory;

    protected $table = 'mensagens';

    protected $primaryKey = 'id_mensagem';

    protected $fillable = [
        'id_mensagem',
        'id_chat',
        'id_usuario',
        'text',
        'created_at',
    ];

    public function mensagensChat($de_usuario, $para_usuario) {
        $usuarios = [$de_usuario, $para_usuario];
        sort($usuarios); 
        $chat = conversaModel::where(['de_id_usuario' => $usuarios[0], 'para_id_usuario' => $usuarios[1]])->value('id_chat');
        
        $result = DB::select("SELECT c.id_chat, m.id_usuario as id_de, u.usuario as de,  m.text as mensagem
        from blog.conversas c
        join blog.mensagens m on m.id_chat = c.id_chat and m.id_chat = " . $chat . "
        join blog.usuarios u on u.id_usuario = m.id_usuario
        order by m.created_at ASC");

        return $result;
    }
}
