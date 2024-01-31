<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
