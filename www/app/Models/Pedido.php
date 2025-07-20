<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'valor_pedido',
        'client_name',
        'client_email',
        'cep',
        'logradouro',
        'complemento',
        'bairro',
        'localidade',
        'uf',
        'estado',
        'regiao',
        'status'
    ];
}
