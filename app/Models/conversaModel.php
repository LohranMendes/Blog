<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    
}
