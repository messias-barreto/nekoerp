<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupom extends Model
{
    protected $fillable = [
        'name',
        'valor',
        'quantidade',
        'data_expiracao'
    ];
}
