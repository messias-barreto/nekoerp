<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VariacaoProduto extends Model
{
    protected $table = 'variacao_produtos';
    protected $fillable = [
        'name',
        'produto_id'
    ];
}
