<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
